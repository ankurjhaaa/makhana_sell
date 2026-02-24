@extends('Layout.publiclayout')
@section('title', 'Order Confirmed!')

@section('content')
    <section class="py-12 md:py-24 bg-white min-h-screen flex items-center">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Success Animation/Icon -->
            <div class="mb-8 relative inline-block">
                <div
                    class="w-24 h-24 bg-green-50 rounded-full flex items-center justify-center text-primary shadow-inner border border-green-100">
                    <i class="fas fa-check text-4xl"></i>
                </div>
                <div
                    class="absolute -top-2 -right-2 w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center animate-bounce shadow-lg">
                    <i class="fas fa-heart text-xs"></i>
                </div>
            </div>

            <h1 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 tracking-tight">Woohoo! It's Official.</h1>
            <p class="text-gray-500 text-lg mb-12 max-w-md mx-auto">Order <span
                    class="text-primary font-bold">#{{ $order->id }}</span> is on its way to your doorstep. We'll notify you
                when it's out for delivery.</p>

            <!-- Order Snapshot -->
            <div class="bg-gray-50 rounded-2xl border border-gray-100 p-6 md:p-10 text-left mb-12 overflow-hidden relative">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16"></div>

                <div class="relative z-10">
                    <div class="flex flex-col md:flex-row justify-between gap-8 mb-10">
                        <div class="flex-1">
                            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Shipping To</h4>
                            <p class="text-sm font-extrabold text-gray-900 mb-1">{{ $order->customer_name }}</p>
                            <p class="text-xs text-gray-500 leading-relaxed">{{ $order->address }}, {{ $order->city }},
                                {{ $order->state }} - {{ $order->pincode }}</p>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Order Status</h4>
                            <div
                                class="inline-flex items-center space-x-2 bg-green-100 text-primary px-3 py-1 rounded-full text-[10px] font-black uppercase">
                                <span class="w-1.5 h-1.5 bg-primary rounded-full animate-pulse"></span>
                                <span>{{ $order->status }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 border-t border-gray-200 pt-6">
                        @foreach($order->items as $item)
                            <div class="flex justify-between items-center bg-white p-3 rounded-lg border border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gray-50 rounded overflow-hidden">
                                        <img src="{{ $item->product->mainImage->image_path ?? '' }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-900">{{ $item->product->name }}</p>
                                        <p class="text-[10px] text-gray-400">Qty: {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <p class="text-sm font-bold text-gray-900">₹{{ $item->price * $item->quantity }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 flex justify-between items-center text-primary">
                        <span class="text-xs font-bold uppercase tracking-widest">Total Amount Paid</span>
                        <span class="text-3xl font-black">₹{{ $order->total_amount }}</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('my.orders') }}"
                    class="flex-1 sm:flex-none justify-center inline-flex items-center space-x-3 bg-primary text-white px-10 py-4 rounded-xl font-bold hover:bg-green-800 transition-all shadow-xl active:scale-95 transform">
                    <span>View My Orders</span>
                    <i class="fas fa-list-check text-xs"></i>
                </a>
                <a href="{{ route('home') }}"
                    class="flex-1 sm:flex-none justify-center inline-flex items-center space-x-3 bg-white text-gray-700 border border-gray-200 px-10 py-4 rounded-xl font-bold hover:bg-gray-50 transition-all">
                    <span>Back to Home</span>
                </a>
            </div>

            <p class="mt-12 text-xs text-gray-400 font-medium italic">Need help? WhatsApp us at +91 9876543210</p>
        </div>
    </section>
@endsection