@extends('Layout.publiclayout')
@section('title', 'Checkout')

@section('content')
    <section class="py-12 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Checkout Form -->
                <div class="lg:w-2/3">
                    <form action="#" class="space-y-8">
                        <!-- Contact Information -->
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <span
                                    class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm mr-3">1</span>
                                Contact Information
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Full
                                        Name</label>
                                    <input type="text"
                                        class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-sm"
                                        placeholder="e.g. Ankur Jha">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Phone
                                        Number</label>
                                    <input type="tel"
                                        class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-sm"
                                        placeholder="e.g. +91 9876543210">
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <span
                                    class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm mr-3">2</span>
                                Shipping Address
                            </h2>
                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Street
                                        Address</label>
                                    <input type="text"
                                        class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-sm"
                                        placeholder="House No, Building, Street">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="space-y-2">
                                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">City</label>
                                        <input type="text"
                                            class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-sm"
                                            placeholder="City">
                                    </div>
                                    <div class="space-y-2">
                                        <label
                                            class="text-xs font-bold text-gray-400 uppercase tracking-wider">State</label>
                                        <input type="text"
                                            class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-sm"
                                            placeholder="State">
                                    </div>
                                    <div class="space-y-2">
                                        <label
                                            class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pincode</label>
                                        <input type="text"
                                            class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-sm"
                                            placeholder="Pincode">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <span
                                    class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm mr-3">3</span>
                                Payment Method
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label
                                    class="relative flex items-center p-4 border rounded-md border-primary bg-green-50 cursor-pointer transition-all">
                                    <input type="radio" name="payment"
                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary" checked>
                                    <div class="ml-3">
                                        <span class="block text-sm font-bold text-primary">Pay Online</span>
                                        <span class="block text-xs text-green-700">UPI, Cards, Netbanking</span>
                                    </div>
                                    <div class="absolute top-4 right-4 text-primary">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                </label>
                                <label
                                    class="relative flex items-center p-4 border rounded-md border-gray-100 bg-gray-50 cursor-pointer hover:border-primary hover:bg-white transition-all">
                                    <input type="radio" name="payment"
                                        class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                    <div class="ml-3">
                                        <span class="block text-sm font-bold text-gray-900">Cash on Delivery</span>
                                        <span class="block text-xs text-gray-500">Pay when you receive</span>
                                    </div>
                                    <div class="absolute top-4 right-4 text-gray-400">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Side Summary -->
                <div class="lg:w-1/3">
                    <div class="bg-gray-50 rounded-md p-6 border border-gray-100 sticky top-24">
                        <h2 class="text-lg font-bold text-gray-900 mb-6">Order Summary</h2>

                        <div class="space-y-4 mb-6">
                            @foreach($cartItems as $item)
                                <div class="flex items-center justify-between pb-4 border-b border-gray-200 border-dashed">
                                    <div class="flex items-center">
                                        <span class="relative">
                                            <img src="{{ $item['image'] }}" class="w-12 h-12 object-cover rounded shadow-sm">
                                            <span
                                                class="absolute -top-1 -right-1 w-4 h-4 bg-primary text-white text-[10px] rounded-full flex items-center justify-center font-bold">1</span>
                                        </span>
                                        <div class="ml-3">
                                            <p class="text-xs font-bold text-gray-900 truncate max-w-[120px]">
                                                {{ $item['name'] }}</p>
                                            <p class="text-[10px] text-gray-400">{{ $item['weight'] }}</p>
                                        </div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">₹{{ $item['price'] }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="space-y-2 mb-6 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Subtotal</span>
                                <span class="font-bold text-gray-900">₹{{ $cartItems->sum('price') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Shipping</span>
                                <span class="text-primary font-bold">FREE</span>
                            </div>
                            <div class="flex justify-between border-t border-gray-200 mt-4 pt-4 text-lg">
                                <span class="font-bold text-gray-900">Total</span>
                                <span class="font-bold text-primary">₹{{ $cartItems->sum('price') }}</span>
                            </div>
                        </div>

                        <button
                            class="w-full bg-primary text-white py-4 rounded-md font-bold hover:bg-green-800 transition-colors shadow-lg active:scale-95 transform transition-transform">
                            Place Order <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection