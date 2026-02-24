@extends('Layout.publiclayout')
@section('title', 'All Products')

@section('content')
    <section class="py-5 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-3 border-b border-gray-100  md:pb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Our Collection</h1>
                <p class="text-gray-500">Explore our variety of healthy and crispy Makhana.</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Sidebar Filters (Desktop) -->
                <aside class="hidden lg:block lg:w-64 flex-shrink-0">
                    <div class="sticky top-24 space-y-8">
                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                            <h4
                                class="text-xs font-black text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-200 pb-2">
                                Categories</h4>
                            <div class="space-y-3">
                                <a href="{{ route('items') }}"
                                    class="flex items-center px-4 py-3 rounded-lg text-sm transition-all {{ !request('category') ? 'bg-primary text-white font-bold shadow-md' : 'text-gray-600 hover:bg-white hover:text-primary border border-transparent' }}">
                                    <i class="fas fa-th-large mr-3 text-xs opacity-50"></i>
                                    All Products
                                </a>
                                @foreach($categories as $category)
                                    <a href="{{ route('items', ['category' => $category->slug]) }}"
                                        class="flex items-center px-4 py-3 rounded-lg text-sm transition-all {{ request('category') == $category->slug ? 'bg-primary text-white font-bold shadow-md' : 'text-gray-600 hover:bg-white hover:text-primary border border-transparent' }}">
                                        <i class="fas fa-folder mr-3 text-xs opacity-50"></i>
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Product Grid -->
                <div class="flex-1">
                    <!-- Mobile Filter Toggles -->
                    <div class="lg:hidden flex overflow-x-auto pb-6 gap-3 no-scrollbar items-center">
                        <a href="{{ route('items') }}"
                            class="flex-shrink-0 px-6 py-2.5 rounded-md transition-all text-xs font-black uppercase tracking-wider {{ !request('category') ? 'bg-primary text-white shadow-md' : 'bg-white border border-gray-100 text-gray-500' }}">All</a>
                        @foreach($categories as $category)
                            <a href="{{ route('items', ['category' => $category->slug]) }}"
                                class="flex-shrink-0 px-6 py-2.5 rounded-md transition-all text-xs font-black uppercase tracking-wider {{ request('category') == $category->slug ? 'bg-primary text-white shadow-md' : 'bg-white border border-gray-100 text-gray-500' }}">{{ $category->name }}</a>
                        @endforeach
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                        @forelse($products as $product)
                            <div class="group border border-primary/20 p-4 rounded-lg">
                                <div class="relative overflow-hidden rounded-md bg-gray-100 mb-4 aspect-square">
                                    <img src="{{ $product->mainImage->image_path ?? '' }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="absolute bottom-4 right-4 w-10 h-10 bg-white shadow-md rounded-full flex items-center justify-center text-primary opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="flex flex-col">
                                    <span
                                        class="text-[10px] font-bold text-primary uppercase tracking-widest mb-1">{{ $product->category->name ?? 'General' }}</span>
                                    <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-primary transition-colors">
                                        <a href="{{ route('item', $product->slug) }}">{{ $product->name }}</a>
                                    </h3>
                                    <div class="flex justify-between items-center mt-auto">
                                        <span class="text-lg font-bold text-gray-900">₹{{ $product->price }}</span>
                                        <span class="text-gray-400 text-xs">{{ $product->weight }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-20 text-center">
                                <p class="text-gray-400">No products found in this category.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection