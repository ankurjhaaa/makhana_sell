@extends('Layout.publiclayout')
@section('title', 'Order Details')

@section('content')
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-black text-gray-900 mb-8 border-l-4 border-primary pl-4">Account Settings</h1>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar -->
                <aside class="hidden lg:block w-72 flex-shrink-0">
                    @include('Public.Partials.profile-sidebar')
                </aside>

                <!-- Main Content -->
                <div class="flex-1 space-y-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Order #{{ $order->id }}</h2>
                            <p class="text-gray-400 text-sm mt-1">Detailed view of your purchase.</p>
                        </div>
                        <a href="{{ route('my.orders') }}"
                            class="text-xs font-bold text-primary hover:underline flex items-center">
                            <i class="fas fa-chevron-left mr-2"></i> Back to Orders
                        </a>
                    </div>

                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                        <!-- Left Column: Details & Items -->
                        <div class="xl:col-span-2 space-y-6">
                            <!-- Status Tracker -->
                            <div
                                class="bg-white p-6 md:p-8 rounded-lg border border-gray-100 shadow-sm relative overflow-hidden">
                                <div class="absolute top-0 left-0 w-2 h-full bg-primary"></div>
                                <div class="flex justify-between items-start mb-8">
                                    <div>
                                        <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">
                                            Current Status</h4>
                                        <p class="text-lg font-black text-primary uppercase">{{ $order->status }}</p>
                                    </div>
                                    <div class="text-right">
                                        <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">
                                            Expected Delivery</h4>
                                        <p class="text-sm font-bold text-gray-900">
                                            {{ $order->created_at->addDays(5)->format('d M, Y') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="relative pt-1">
                                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-50">
                                        <div style="width:{{ $order->status == 'pending' ? '25' : ($order->status == 'processing' ? '50' : ($order->status == 'shipped' ? '75' : '100')) }}%"
                                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary transition-all duration-1000">
                                        </div>
                                    </div>
                                    <div
                                        class="flex justify-between text-[8px] font-bold text-gray-400 uppercase tracking-tighter">
                                        <span>Placed</span>
                                        <span>Processed</span>
                                        <span>Shipped</span>
                                        <span>Delivered</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Items List -->
                            <div class="bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden">
                                <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                                    <h4 class="text-xs font-bold text-gray-900 uppercase tracking-widest">Order Items
                                        ({{ $order->items->count() }})</h4>
                                </div>
                                <div class="divide-y divide-gray-100">
                                    @foreach($order->items as $item)
                                        <div class="p-6 flex gap-6 items-center">
                                            <div
                                                class="w-16 h-16 rounded-xl overflow-hidden border border-gray-100 flex-shrink-0 bg-gray-50">
                                                <img src="{{ $item->product->mainImage->image_path ?? '' }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div class="flex-1">
                                                <h5 class="text-sm font-extrabold text-gray-900">{{ $item->product->name }}</h5>
                                                <p class="text-[10px] text-gray-400 mt-1 uppercase font-bold tracking-widest">
                                                    {{ $item->product->weight }} Pack
                                                </p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-sm font-bold text-gray-900">₹{{ $item->price * $item->quantity }}
                                                </p>
                                                <p class="text-[10px] text-gray-400">₹{{ $item->price }} x {{ $item->quantity }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Shipping Info -->
                        <div class="space-y-6">
                            <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
                                <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-6">Delivery
                                    Address</h4>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm font-black text-gray-900">{{ $order->customer_name }}</p>
                                        <p class="text-xs text-gray-500 leading-relaxed mt-1">
                                            {{ $order->address }}<br>
                                            {{ $order->address_line2 ? $order->address_line2 . ',' : '' }}<br>
                                            {{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}
                                        </p>
                                    </div>
                                    <div class="pt-4 border-t border-gray-50">
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Phone
                                        </p>
                                        <p class="text-xs font-bold text-gray-900">+91 {{ $order->phone }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-primary text-white p-6 rounded-lg shadow-md">
                                <h4 class="text-[10px] font-bold uppercase tracking-widest mb-6 opacity-70">Payment Summary
                                </h4>
                                <div class="space-y-3 mb-6">
                                    <div class="flex justify-between text-xs opacity-80">
                                        <span>Subtotal</span>
                                        <span>₹{{ $order->total_amount }}</span>
                                    </div>
                                    <div class="flex justify-between text-xs opacity-80">
                                        <span>Tax</span>
                                        <span>₹0.00</span>
                                    </div>
                                    <div class="flex justify-between text-xs opacity-80">
                                        <span>Delivery</span>
                                        <span class="font-bold underline">FREE</span>
                                    </div>
                                </div>
                                <div class="pt-4 border-t border-white/20 flex justify-between items-center">
                                    <span class="text-sm font-bold uppercase tracking-widest">Grand Total</span>
                                    <span class="text-2xl font-black">₹{{ $order->total_amount }}</span>
                                </div>
                                <div class="mt-6 pt-6 border-t border-white/10 flex items-center justify-between">
                                    <span class="text-[10px] font-bold uppercase opacity-60">Method</span>
                                    <span class="text-[10px] font-bold uppercase">{{ $order->payment_method }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection