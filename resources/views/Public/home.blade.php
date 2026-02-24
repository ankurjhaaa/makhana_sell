@extends('Layout.publiclayout')
@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="bg-white py-12 md:py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <span
                        class="inline-block py-1 px-3 rounded-full bg-green-50 text-primary text-xs font-bold uppercase tracking-wider mb-4 border border-green-100">Premium
                        Quality</span>
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Healthy Snacking <br>
                        <span class="text-primary italic">Redefined.</span>
                    </h1>
                    <p class="text-gray-500 text-lg mb-8 max-w-lg">
                        Discover the crunchy, nutritious goodness of handpicked Phool Makhana. Perfectly roasted and
                        flavored for your palate.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('items') }}"
                            class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-green-800 transition-colors shadow-sm">
                            Shop Now
                        </a>
                        <a href="#featured"
                            class="inline-flex items-center justify-center px-8 py-3 border border-gray-200 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                            Learn More
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 relative">
                    <div
                        class="absolute -top-10 -right-10 w-64 h-64 bg-green-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse">
                    </div>
                    <img src="https://images.unsplash.com/photo-1620912189865-1e8a33da4c5e?q=80&w=1200&auto=format&fit=crop"
                        alt="Makhana Hero" class="rounded-lg shadow-2xl relative z-10 w-full object-cover h-[400px]">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="bg-white p-8 rounded-md border border-gray-100 shadow-sm transition-transform hover:-translate-y-1">
                    <div class="w-12 h-12 bg-green-50 rounded-md flex items-center justify-center text-primary mb-6">
                        <i class="fas fa-certificate text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">100% Organic</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Directly sourced from the finest farms, ensuring pure,
                        unadulterated quality.</p>
                </div>
                <div
                    class="bg-white p-8 rounded-md border border-gray-100 shadow-sm transition-transform hover:-translate-y-1">
                    <div class="w-12 h-12 bg-green-50 rounded-md flex items-center justify-center text-primary mb-6">
                        <i class="fas fa-burn text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Superfood</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Rich in antioxidants, proteins, and minerals. Perfect
                        for weight management.</p>
                </div>
                <div
                    class="bg-white p-8 rounded-md border border-gray-100 shadow-sm transition-transform hover:-translate-y-1">
                    <div class="w-12 h-12 bg-green-50 rounded-md flex items-center justify-center text-primary mb-6">
                        <i class="fas fa-truck-fast text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Fast Delivery</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Carefully packed to retain freshness and delivered
                        straight to your doorstep.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section id="featured" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Featured Products</h2>
                    <p class="text-gray-500">Our best-selling makhana flavors you'll love.</p>
                </div>
                <a href="{{ route('items') }}" class="text-primary font-bold hover:underline hidden md:block">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div class="group border border-primary/20 p-4 rounded-xl">
                        <div class="relative overflow-hidden rounded-md bg-gray-100 mb-4 aspect-square">
                            <img src="{{ $product->mainImage->image_path ?? '' }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute top-4 right-4">
                                <span
                                    class="bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-primary border border-green-100">
                                    {{ $product->category->name ?? 'General' }}
                                </span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-primary transition-colors">
                            {{ $product->name }}</h3>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-900">₹{{ $product->price }}</span>
                            <span class="text-gray-400 text-sm">{{ $product->weight }}</span>
                        </div>
                        <a href="{{ route('item', $product->slug) }}"
                            class="mt-4 w-full inline-flex items-center justify-center px-4 py-2 border border-gray-100 rounded-md text-sm font-medium text-primary bg-white hover:bg-primary hover:text-white transition-all">
                            View Details
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center md:hidden">
                <a href="{{ route('items') }}" class="inline-flex items-center text-primary font-bold">
                    View All Products <i class="fas fa-arrow-right ml-2 text-sm"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <!-- <section class="py-16 bg-primary text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Stay Healthy, Stay Crunchy</h2>
            <p class="text-green-100 mb-8 max-w-xl mx-auto">Subscribe to get updates on new launches and exclusive offers on
                your favorite superfood.</p>
            <form class="max-w-md mx-auto flex gap-4">
                <input type="email" placeholder="Your email address"
                    class="flex-1 px-4 py-3 rounded-md text-gray-900 focus:outline-none">
                <button type="submit"
                    class="bg-white text-primary px-6 py-3 rounded-md font-bold hover:bg-green-50 transition-colors">
                    Join Now
                </button>
            </form>
        </div>
    </section> -->
@endsection