@extends('Layout.publiclayout')
@section('title', 'My Cart')

@section('content')
    <section class="py-12 md:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items List -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-md border border-gray-100 overflow-hidden">
                        <div
                            class="hidden md:grid grid-cols-6 gap-4 p-4 border-b border-gray-100 bg-gray-50 text-xs font-bold text-gray-400 uppercase tracking-wider">
                            <div class="col-span-3">Product</div>
                            <div class="text-center">Price</div>
                            <div class="text-center">Quantity</div>
                            <div class="text-right">Total</div>
                        </div>

                        <div class="divide-y divide-gray-100">
                            @forelse($cartItems as $item)
                                <div class="p-4 md:p-6 grid grid-cols-1 md:grid-cols-6 gap-4 items-center">
                                    <!-- Product Info -->
                                    <div class="col-span-3 flex items-center">
                                        <div
                                            class="w-20 h-20 flex-shrink-0 bg-gray-50 rounded-md overflow-hidden border border-gray-100">
                                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-base font-bold text-gray-900">{{ $item['name'] }}</h3>
                                            <p class="text-xs text-gray-400 mt-1">{{ $item['weight'] }}</p>
                                            <button class="text-xs text-red-500 font-bold mt-2 hover:underline">Remove</button>
                                        </div>
                                    </div>

                                    <!-- Mobile-only labels -->
                                    <div class="flex md:block justify-between items-center text-sm">
                                        <span class="md:hidden font-medium text-gray-500">Price:</span>
                                        <div class="md:text-center font-bold text-gray-900">₹{{ $item['price'] }}</div>
                                    </div>

                                    <div class="flex md:block justify-between items-center">
                                        <span class="md:hidden font-medium text-gray-500">Quantity:</span>
                                        <div class="flex items-center border border-gray-200 rounded-md w-fit md:mx-auto">
                                            <button class="px-2 py-1 text-gray-400 hover:text-primary">-</button>
                                            <span class="px-3 text-xs font-bold">1</span>
                                            <button class="px-2 py-1 text-gray-400 hover:text-primary">+</button>
                                        </div>
                                    </div>

                                    <div class="flex md:block justify-between items-center text-sm">
                                        <span class="md:hidden font-medium text-gray-500">Total:</span>
                                        <div class="md:text-right font-bold text-primary">₹{{ $item['price'] }}</div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-12 text-center">
                                    <i class="fas fa-shopping-basket text-4xl text-gray-100 mb-4"></i>
                                    <p class="text-gray-500">Your cart is empty.</p>
                                    <a href="{{ route('items') }}"
                                        class="mt-4 inline-block text-primary font-bold hover:underline">Start Shopping</a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <a href="{{ route('items') }}" class="text-sm font-bold text-gray-500 hover:text-primary">
                            <i class="fas fa-arrow-left mr-2 font-normal"></i> Continue Shopping
                        </a>
                        <button class="text-sm font-bold text-gray-900 hover:text-red-500">Clear Cart</button>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-md border border-gray-100 p-6 sticky top-24">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>

                        <div class="space-y-4 mb-6 border-b border-gray-100 pb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Subtotal</span>
                                <span class="font-bold text-gray-900">₹{{ $cartItems->sum('price') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Shipping</span>
                                <span class="text-green-500 font-bold italic">Calculated at checkout</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Handling Fee</span>
                                <span class="font-bold text-gray-900">₹20</span>
                            </div>
                        </div>

                        <div class="flex justify-between text-lg font-bold text-gray-900 mb-8 font-outfit uppercase">
                            <span>Total Est.</span>
                            <span class="text-primary tracking-tighter">₹{{ $cartItems->sum('price') + 20 }}</span>
                        </div>

                        <a href="{{ route('checkout') }}"
                            class="block w-full bg-primary text-white text-center py-4 rounded-md font-bold hover:bg-green-800 transition-colors shadow-sm">
                            Proceed to Checkout
                        </a>

                        <div class="mt-6 space-y-3">
                            <div class="flex items-center text-xs text-gray-400">
                                <i class="fas fa-shield-alt mr-2"></i> Secure checkout powered by Razorpay
                            </div>
                            <div class="flex items-center text-xs text-gray-400">
                                <i class="fas fa-undo mr-2"></i> 7-day easy return policy
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection