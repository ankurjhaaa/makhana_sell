@extends('Layout.publiclayout')
@section('title', 'My Orders')

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
                    <div class="bg-white p-6 md:p-8 rounded-lg border border-gray-100 shadow-sm mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Order History</h2>
                        <p class="text-gray-400 text-sm mt-1">Manage and track your recent purchases.</p>
                    </div>

                    <div class="space-y-6">
                        @forelse($orders as $order)
                            <div
                                class="bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                                <div class="p-6 md:p-8">
                                    <div
                                        class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                                        <div>
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Order
                                                Placed</p>
                                            <p class="text-sm font-bold text-gray-900">
                                                {{ $order->created_at->format('d M, Y') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Order
                                                #</p>
                                            <p class="text-sm font-bold text-gray-900">{{ $order->id }}</p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total
                                            </p>
                                            <p class="text-sm font-extrabold text-primary">₹{{ $order->total_amount }}</p>
                                        </div>
                                        <div
                                            class="inline-flex items-center space-x-2 bg-green-50 text-primary px-4 py-2 rounded-full text-[10px] font-black uppercase">
                                            <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                            <span>{{ $order->status }}</span>
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap gap-4 items-center">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex -space-x-3">
                                                @foreach($order->items->take(3) as $item)
                                                    <img src="{{ $item->product->mainImage->image_path ?? '' }}"
                                                        class="w-12 h-12 rounded-full border-2 border-white object-cover shadow-sm bg-gray-50">
                                                @endforeach
                                                @if($order->items->count() > 3)
                                                    <div
                                                        class="w-12 h-12 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-400 shadow-sm">
                                                        +{{ $order->items->count() - 3 }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="flex gap-3">
                                            <a href="{{ route('order.detail', $order->id) }}"
                                                class="inline-flex items-center space-x-2 bg-primary text-white px-6 py-2.5 rounded-lg text-sm font-bold hover:bg-green-800 transition-all active:scale-95 transform">
                                                <span>Order Details</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white p-16 rounded-lg border-2 border-dashed border-gray-100 text-center">
                                <div
                                    class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                                    <i class="fas fa-box-open text-3xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">No orders yet</h3>
                                <p class="text-gray-400 text-sm mb-8">Ready to taste the finest makhana?</p>
                                <a href="{{ route('items') }}"
                                    class="inline-flex bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-green-800 transition-all">
                                    Start Shopping
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection