<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function home()
    {
        $products = Product::with('mainImage')->take(3)->get();
        return view("Public.home", compact('products'));
    }

    public function items(Request $request)
    {
        $query = Product::with('mainImage');

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->get();
        $categories = Category::all();

        return view("Public.items", compact('products', 'categories'));
    }

    public function item($slug)
    {
        $product = Product::with(['category', 'images'])->where('slug', $slug)->firstOrFail();
        return view("Public.item-view", compact('product'));
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $cartItem = CartItem::where([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'type' => 'cart'
        ])->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity ?? 1);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity ?? 1,
                'price' => $product->price,
                'type' => 'cart'
            ]);
        }

        return redirect()->route('cart')->with('success', 'Product added to cart!');
    }

    public function cart()
    {
        $cartItems = CartItem::with('product.mainImage')
            ->where('user_id', Auth::id())
            ->where('type', 'cart')
            ->get();

        return view("Public.cart", compact('cartItems'));
    }

    public function checkout()
    {
        $cartItems = CartItem::with('product.mainImage')
            ->where('user_id', Auth::id())
            ->where('type', 'cart')
            ->get();

        if ($cartItems->isEmpty())
            return redirect()->route('items');

        return view("Public.cheakout", compact('cartItems'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'address_line2' => 'nullable|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'payment_method' => 'required',
        ]);

        $cartItems = CartItem::where('user_id', Auth::id())
            ->where('type', 'cart')
            ->get();

        if ($cartItems->isEmpty())
            return redirect()->route('items');

        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'address_line2' => $request->address_line2,
            'city' => $request->city,
            'state' => $request->state,
            'country' => 'India', // Default for now
            'pincode' => $request->pincode,
            'payment_method' => $request->payment_method,
            'status' => 'pending'
        ]);

        foreach ($cartItems as $item) {
            /** @var \App\Models\CartItem $item */
            $item->update([
                'type' => 'order',
                'order_id' => $order->id
            ]);
        }

        return redirect()->route('success', ['order' => $order->id]);
    }

    public function success(Request $request)
    {
        $order = Order::with('items.product')->findOrFail($request->order);
        return view("Public.success", compact('order'));
    }

    public function updateCartQuantity(Request $request)
    {
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('id', $request->id)
            ->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $request->quantity]);

            $total = CartItem::where('user_id', Auth::id())->where('type', 'cart')->get()->sum(fn($i) => $i->price * $i->quantity);

            return response()->json([
                'success' => true,
                'item_total' => $cartItem->price * $cartItem->quantity,
                'cart_total' => $total
            ]);
        }
        return response()->json(['success' => false], 404);
    }

    public function removeFromCart(Request $request)
    {
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('id', $request->id)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            $total = CartItem::where('user_id', Auth::id())->where('type', 'cart')->get()->sum(fn($i) => $i->price * $i->quantity);
            return response()->json([
                'success' => true,
                'cart_total' => $total,
                'cart_count' => CartItem::where('user_id', Auth::id())->where('type', 'cart')->count()
            ]);
        }
        return response()->json(['success' => false], 404);
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view("Public.orders", compact('orders'));
    }

    public function orderDetail($id)
    {
        $order = Order::with('items.product')->where('user_id', Auth::id())->findOrFail($id);
        return view("Public.order-detail", compact('order'));
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $id
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment
            ]
        );

        return back()->with('success', 'Thank you for your rating!');
    }

    public function profile()
    {
        return view("Public.profile");
    }

    public function account()
    {
        return view("Public.mobile-profile");
    }
}
