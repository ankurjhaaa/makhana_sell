@extends('Layout.publiclayout')
@section('title', 'Checkout')

@section('content')
    <section class="py-8 md:py-16 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-8 border-l-4 border-primary pl-4">Secure Checkout</h1>

            <form action="{{ route('order.place') }}" method="POST" class="mobile-first-form">
                @csrf
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Checkout Form -->
                    <div class="w-full lg:w-2/3 space-y-6">
                        <!-- Contact Info -->
                        <div class="bg-white p-6 rounded-md border border-gray-100 shadow-sm">
                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6 flex items-center">
                                <span
                                    class="w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center text-[10px] mr-3">1</span>
                                Contact Details
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Full
                                        Name</label>
                                    <input type="text" name="customer_name" value="{{ Auth::user()->name }}" required
                                        class="w-full px-4 py-3 rounded border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-0 outline-none transition-all text-sm">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Email
                                        Address</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}" required
                                        class="w-full px-4 py-3 rounded border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-0 outline-none transition-all text-sm">
                                </div>
                                <div class="space-y-1.5 md:col-span-2">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Phone
                                        Number</label>
                                    <input type="tel" name="phone" placeholder="9876543210" required
                                        class="w-full px-4 py-3 rounded border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-0 outline-none transition-all text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div class="bg-white p-6 rounded-md border border-gray-100 shadow-sm">
                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6 flex items-center">
                                <span
                                    class="w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center text-[10px] mr-3">2</span>
                                Shipping Address
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2 space-y-1.5">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Address Line
                                        1 (Flat, House no, Building)</label>
                                    <input type="text" name="address" required placeholder="e.g. 123, Green Apartments"
                                        class="w-full px-4 py-3 rounded border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-0 outline-none transition-all text-sm">
                                </div>
                                <div class="md:col-span-2 space-y-1.5">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Address Line
                                        2 (Area, Sector, Landmark)</label>
                                    <input type="text" name="address_line2" placeholder="e.g. Sector 5, Near Main Market"
                                        class="w-full px-4 py-3 rounded border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-0 outline-none transition-all text-sm">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">City</label>
                                    <input type="text" name="city" required placeholder="e.g. New Delhi"
                                        class="w-full px-4 py-3 rounded border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-0 outline-none transition-all text-sm">
                                </div>
                                <div class="space-y-1.5">
                                    <label
                                        class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">State</label>
                                    <select name="state" required
                                        class="w-full px-4 py-3 rounded border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-0 outline-none transition-all text-sm appearance-none">
                                        <option value="">Select State</option>
                                        <option value="Delhi">Delhi</option>
                                        <option value="Bihar">Bihar</option>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <!-- Add more states as needed -->
                                    </select>
                                </div>
                                <div class="space-y-1.5">
                                    <label
                                        class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Pincode</label>
                                    <input type="text" name="pincode" required placeholder="110001"
                                        class="w-full px-4 py-3 rounded border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-0 outline-none transition-all text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-white p-6 rounded-md border border-gray-100 shadow-sm">
                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6 flex items-center">
                                <span
                                    class="w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center text-[10px] mr-3">3</span>
                                Payment Method
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label
                                    class="relative flex items-center p-4 rounded-md border-2 border-gray-50 cursor-pointer hover:border-primary transition-all has-[:checked]:border-primary has-[:checked]:bg-green-50 group">
                                    <input type="radio" name="payment_method" value="COD" class="hidden" checked>
                                    <div
                                        class="w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center mr-3 group-has-[:checked]:border-primary group-has-[:checked]:bg-primary">
                                        <div class="w-1.5 h-1.5 rounded-full bg-white"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">Cash on Delivery</span>
                                </label>
                                <label
                                    class="relative flex items-center p-4 rounded-md border-2 border-gray-50 cursor-pointer hover:border-primary transition-all has-[:checked]:border-primary has-[:checked]:bg-green-50 group">
                                    <input type="radio" name="payment_method" value="Pay Online" class="hidden">
                                    <div
                                        class="w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center mr-3 group-has-[:checked]:border-primary group-has-[:checked]:bg-primary">
                                        <div class="w-1.5 h-1.5 rounded-full bg-white"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">Pay Online</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="w-full lg:w-1/3">
                        <div class="bg-primary text-white p-6 rounded-md shadow-lg sticky top-24">
                            <h3 class="text-xs font-bold uppercase tracking-widest mb-6 opacity-80">Order Summary</h3>
                            <div class="space-y-4 mb-6">
                                @foreach($cartItems as $item)
                                    <div class="flex gap-4 items-center">
                                        <div class="w-12 h-12 bg-white/10 rounded overflow-hidden flex-shrink-0">
                                            <img src="{{ $item->product->mainImage->image_path ?? '' }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs font-bold leading-tight">{{ $item->product->name }}</p>
                                            <div class="flex justify-between items-center mt-1">
                                                <p class="text-[10px] opacity-70">Qty: {{ $item->quantity }}</p>
                                                <p class="text-xs font-bold">₹{{ $item->price * $item->quantity }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="space-y-3 pt-6 border-t border-white/10 mb-6">
                                <div class="flex justify-between text-xs opacity-70">
                                    <span>Subtotal</span>
                                    <span>₹{{ $cartItems->sum(fn($i) => $i->price * $i->quantity) }}</span>
                                </div>
                                <div class="flex justify-between text-xs opacity-70">
                                    <span>Delivery</span>
                                    <span class="text-green-300 font-bold italic">FREE</span>
                                </div>
                                <div class="flex justify-between text-lg font-bold pt-3 border-t border-white/20">
                                    <span>TOTAL</span>
                                    <span>₹{{ $cartItems->sum(fn($i) => $i->price * $i->quantity) }}</span>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-white text-primary py-4 rounded-md font-bold hover:bg-green-50 transition-all shadow-md active:scale-95 transform">
                                Complete Purchase
                            </button>
                            <p class="text-[10px] opacity-50 text-center mt-4 tracking-wider">SECURE 256-BIT ENCRYPTION</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection