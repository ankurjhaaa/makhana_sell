@extends('Layout.publiclayout')
@section('title', 'My Bag')

@section('content')
    <section class="py-6 md:py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-extrabold text-gray-900 mb-8 border-l-4 border-primary pl-4">My Bag</h1>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items -->
                <div class="w-full lg:w-2/3 space-y-4" id="cart-items-container">
                    @forelse($cartItems as $item)
                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex flex-col sm:flex-row gap-4 items-center relative"
                            id="item-{{ $item->id }}">
                            <div class="w-24 h-24 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0">
                                <img src="{{ $item->product->mainImage->image_path ?? '' }}" alt="{{ $item->product->name }}"
                                    class="w-full h-full object-cover">
                            </div>

                            <div class="flex-1 text-center sm:text-left">
                                <h3 class="font-bold text-gray-900 mb-1">{{ $item->product->name }}</h3>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-2">
                                    {{ $item->product->weight }} Pack
                                </p>
                                <p class="text-primary font-bold">₹{{ $item->price }}</p>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="flex items-center border border-gray-200 rounded-lg bg-gray-50 p-1">
                                    <button onclick="updateQty({{ $item->id }}, -1)"
                                        class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-primary transition-colors">
                                        <i class="fas fa-minus text-[10px]"></i>
                                    </button>
                                    <span id="qty-{{ $item->id }}"
                                        class="w-8 text-center text-sm font-bold text-gray-900">{{ $item->quantity }}</span>
                                    <button onclick="updateQty({{ $item->id }}, 1)"
                                        class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-primary transition-colors">
                                        <i class="fas fa-plus text-[10px]"></i>
                                    </button>
                                </div>

                                <div class="text-right min-w-[80px]">
                                    <p class="text-sm font-extrabold text-gray-900">₹<span
                                            id="sub-{{ $item->id }}">{{ $item->price * $item->quantity }}</span></p>
                                </div>

                                <button onclick="removeItem({{ $item->id }})"
                                    class="absolute top-4 right-4 sm:static text-gray-300 hover:text-red-500 transition-colors p-2">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-12 rounded-xl border border-dashed border-gray-200 text-center">
                            <div
                                class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mx-auto mb-4">
                                <i class="fas fa-shopping-basket text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Your bag is empty</h3>
                            <p class="text-gray-400 text-sm mb-6">Looks like you haven't added any makhana yet.</p>
                            <a href="{{ route('items') }}"
                                class="inline-flex items-center space-x-2 bg-primary text-white px-6 py-3 rounded-lg font-bold hover:bg-green-800 transition-all">
                                <span>Browse Products</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Order Summary -->
                @if($cartItems->isNotEmpty())
                    <div class="w-full lg:w-1/3">
                        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm sticky top-24">
                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6">Order Summary</h3>

                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-sm text-gray-500">
                                    <span>Subtotal</span>
                                    <span class="font-bold text-gray-900">₹<span
                                            id="cart-subtotal">{{ $cartItems->sum(fn($i) => $i->price * $i->quantity) }}</span></span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-500">
                                    <span>Delivery</span>
                                    <span class="text-primary font-bold">FREE</span>
                                </div>
                                <div class="pt-4 border-t border-gray-50 flex justify-between items-center">
                                    <span class="text-lg font-extrabold text-gray-900">Total</span>
                                    <span class="text-2xl font-black text-primary">₹<span
                                            id="cart-total">{{ $cartItems->sum(fn($i) => $i->price * $i->quantity) }}</span></span>
                                </div>
                            </div>

                            <a href="{{ route('checkout') }}"
                                class="w-full bg-primary text-white py-4 rounded-xl font-bold hover:bg-green-800 transition-all shadow-lg active:scale-95 transform flex items-center justify-center space-x-3">
                                <span>Secure Checkout</span>
                                <i class="fas fa-lock text-xs opacity-50"></i>
                            </a>

                            <div class="mt-6 flex items-center justify-center space-x-4 opacity-30">
                                <i class="fab fa-cc-visa text-2xl"></i>
                                <i class="fab fa-cc-mastercard text-2xl"></i>
                                <i class="fab fa-google-pay text-2xl"></i>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <script>
        async function updateQty(id, delta) {
            const qtyEl = document.getElementById(`qty-${id}`);
            let currentQty = parseInt(qtyEl.innerText);
            let newQty = currentQty + delta;

            if (newQty < 1) return;

            try {
                const response = await fetch("{{ route('cart.update') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: id, quantity: newQty })
                });

                const data = await response.json();
                if (data.success) {
                    qtyEl.innerText = newQty;
                    document.getElementById(`sub-${id}`).innerText = data.item_total;
                    document.getElementById('cart-subtotal').innerText = data.cart_total;
                    document.getElementById('cart-total').innerText = data.cart_total;
                }
            } catch (e) {
                console.error(e);
            }
        }

        async function removeItem(id) {
            if (!confirm('Are you sure you want to remove this item?')) return;

            try {
                const response = await fetch("{{ route('cart.remove') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: id })
                });

                const data = await response.json();
                if (data.success) {
                    document.getElementById(`item-${id}`).remove();
                    if (data.cart_count === 0) {
                        location.reload();
                    } else {
                        document.getElementById('cart-subtotal').innerText = data.cart_total;
                        document.getElementById('cart-total').innerText = data.cart_total;
                    }
                }
            } catch (e) {
                console.error(e);
            }
        }
    </script>
@endsection