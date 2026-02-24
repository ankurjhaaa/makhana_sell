<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    protected function getProducts()
    {
        return [
            [
                'id' => 1,
                'name' => 'Premium Phool Makhana',
                'price' => 299,
                'description' => 'Large size, handpicked premium fox nuts. perfect for snacking.',
                'image' => 'https://images.unsplash.com/photo-1620912189865-1e8a33da4c5e?q=80&w=800&auto=format&fit=crop',
                'weight' => '250g',
                'category' => 'Classic'
            ],
            [
                'id' => 2,
                'name' => 'Roasted Peri Peri Makhana',
                'price' => 349,
                'description' => 'Spicy and tangy roasted makhana with authentic Peri Peri spices.',
                'image' => 'https://images.unsplash.com/photo-1599490659223-ef37651c0bb5?q=80&w=800&auto=format&fit=crop',
                'weight' => '150g',
                'category' => 'Spicy'
            ],
            [
                'id' => 3,
                'name' => 'Cheese & Herbs Makhana',
                'price' => 349,
                'description' => 'Creamy cheese flavor with aromatic herbs for a gourmet experience.',
                'image' => 'https://images.unsplash.com/photo-1614735241165-6756e1df61ab?q=80&w=800&auto=format&fit=crop',
                'weight' => '150g',
                'category' => 'Gourmet'
            ],
            [
                'id' => 4,
                'name' => 'Himalayan Salted Makhana',
                'price' => 319,
                'description' => 'Lightly roasted with pure Himalayan pink salt for a healthy crunch.',
                'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=800&auto=format&fit=crop',
                'weight' => '200g',
                'category' => 'Healthy'
            ],
            [
                'id' => 5,
                'name' => 'Caramel Crunch Makhana',
                'price' => 399,
                'description' => 'Sweet and crunchy makhana coated with rich buttery caramel.',
                'image' => 'https://images.unsplash.com/photo-1585184394271-4c0a47dc59c9?q=80&w=800&auto=format&fit=crop',
                'weight' => '150g',
                'category' => 'Sweet'
            ],
        ];
    }

    public function home()
    {
        $products = collect($this->getProducts())->take(3);
        return view("Public.home", compact('products'));
    }

    public function items()
    {
        $products = $this->getProducts();
        return view("Public.items", compact('products'));
    }

    public function item($id)
    {
        $product = collect($this->getProducts())->firstWhere('id', $id);
        if (!$product)
            abort(404);
        return view("Public.item-view", compact('product'));
    }

    public function cart()
    {
        // Using first two products as dummy cart items
        $cartItems = collect($this->getProducts())->take(2);
        return view("Public.cart", compact('cartItems'));
    }

    public function checkout()
    {
        $cartItems = collect($this->getProducts())->take(2);
        return view("Public.cheakout", compact('cartItems'));
    }
}
