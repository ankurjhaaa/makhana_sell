@extends('Layout.publiclayout')
@section('title', 'All Products')

@section('content')
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-12 border-b border-gray-100 pb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Our Collection</h1>
                <p class="text-gray-500">Explore our variety of healthy and crispy Makhana.</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Sidebar Filtes (Desktop) -->
                <aside class="hidden lg:block lg:w-64 flex-shrink-0">
                    <div class="sticky top-24 space-y-8">
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Categories</h4>
                            <div class="space-y-2">
                                <label class="flex items-center text-sm text-gray-600 hover:text-primary cursor-pointer">
                                    <input type="checkbox"
                                        class="rounded border-gray-300 text-primary focus:ring-primary mr-2" checked>
                                    All Products
                                </label>
                                <label class="flex items-center text-sm text-gray-600 hover:text-primary cursor-pointer">
                                    <input type="checkbox"
                                        class="rounded border-gray-300 text-primary focus:ring-primary mr-2">
                                    Classic
                                </label>
                                <label class="flex items-center text-sm text-gray-600 hover:text-primary cursor-pointer">
                                    <input type="checkbox"
                                        class="rounded border-gray-300 text-primary focus:ring-primary mr-2">
                                    Savory
                                </label>
                                <label class="flex items-center text-sm text-gray-600 hover:text-primary cursor-pointer">
                                    <input type="checkbox"
                                        class="rounded border-gray-300 text-primary focus:ring-primary mr-2">
                                    Sweet
                                </label>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Product Grid -->
                <div class="flex-1">
                    <!-- Mobile Filter Toggles -->
                    <div class="lg:hidden flex overflow-x-auto pb-6 gap-2 no-scrollbar">
                        <button
                            class="flex-shrink-0 px-4 py-2 bg-primary text-white rounded-md text-xs font-bold">All</button>
                        <button
                            class="flex-shrink-0 px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-md text-xs font-bold">Classic</button>
                        <button
                            class="flex-shrink-0 px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-md text-xs font-bold">Savory</button>
                        <button
                            class="flex-shrink-0 px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-md text-xs font-bold">Sweet</button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                        @foreach($products as $product)
                            <div class="group">
                                <div class="relative overflow-hidden rounded-md bg-gray-100 mb-4 aspect-square">
                                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <button
                                        class="absolute bottom-4 right-4 w-10 h-10 bg-white shadow-md rounded-full flex items-center justify-center text-primary opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="text-[10px] font-bold text-primary uppercase tracking-widest mb-1">{{ $product['category'] }}</span>
                                    <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-primary transition-colors">
                                        <a href="{{ route('item', $product['id']) }}">{{ $product['name'] }}</a>
                                    </h3>
                                    <div class="flex justify-between items-center mt-auto">
                                        <span class="text-lg font-bold text-gray-900">₹{{ $product['price'] }}</span>
                                        <span class="text-gray-400 text-xs">{{ $product['weight'] }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection