@extends('Layout.publiclayout')
@section('title', $product['name'])

@section('content')
    <section class="py-12 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-8 text-sm" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="text-gray-400 hover:text-primary">Home</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-300 text-[10px] mx-2"></i>
                            <a href="{{ route('items') }}" class="text-gray-400 hover:text-primary">Products</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-300 text-[10px] mx-2"></i>
                            <span class="text-gray-600 font-medium">{{ $product['name'] }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="flex flex-col md:flex-row gap-12 lg:gap-20">
                <!-- Product Gallery -->
                <div class="md:w-1/2">
                    <div class="aspect-square rounded-md overflow-hidden bg-gray-50 border border-gray-100">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="grid grid-cols-4 gap-4 mt-4">
                        <div class="aspect-square rounded-md overflow-hidden bg-gray-50 border-2 border-primary">
                            <img src="{{ $product['image'] }}" class="w-full h-full object-cover">
                        </div>
                        <!-- Dummy Thumbnails -->
                        <div class="aspect-square rounded-md overflow-hidden bg-gray-50 border border-gray-100 opacity-50">
                            <img src="{{ $product['image'] }}" class="w-full h-full object-cover grayscale">
                        </div>
                        <div class="aspect-square rounded-md overflow-hidden bg-gray-50 border border-gray-100 opacity-50">
                            <img src="{{ $product['image'] }}" class="w-full h-full object-cover grayscale">
                        </div>
                        <div class="aspect-square rounded-md overflow-hidden bg-gray-50 border border-gray-100 opacity-50">
                            <img src="{{ $product['image'] }}" class="w-full h-full object-cover grayscale">
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="md:w-1/2">
                    <div class="mb-6">
                        <span
                            class="text-xs font-bold text-primary uppercase tracking-widest">{{ $product['category'] }}</span>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-4">{{ $product['name'] }}</h1>
                        <div class="flex items-center mb-6">
                            <div class="flex text-yellow-400 mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-sm text-gray-500">(4.8/5 based on 120 reviews)</span>
                        </div>
                        <div class="flex items-baseline space-x-3 mb-8">
                            <span class="text-3xl font-bold text-gray-900">₹{{ $product['price'] }}</span>
                            <span class="text-gray-400 line-through">₹{{ $product['price'] + 100 }}</span>
                            <span class="text-primary text-sm font-bold bg-green-50 px-2 py-0.5 rounded">Save 25%</span>
                        </div>
                    </div>

                    <p class="text-gray-600 leading-relaxed mb-8">
                        {{ $product['description'] }} Our makhana is sourced directly from farms, sun-dried, and expertly
                        roasted to maintain its nutritional value while providing a satisfying crunch.
                    </p>

                    <div class="space-y-6 border-t border-gray-100 pt-8">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-gray-900">Net Weight:</span>
                            <span class="text-sm text-gray-600">{{ $product['weight'] }}</span>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex items-center border border-gray-200 rounded-md w-fit">
                                <button class="px-4 py-2 text-gray-600 hover:bg-gray-50">-</button>
                                <input type="number" value="1"
                                    class="w-12 text-center border-none focus:ring-0 text-sm font-bold" readonly>
                                <button class="px-4 py-2 text-gray-600 hover:bg-gray-50">+</button>
                            </div>
                            <a href="{{ route('cart') }}"
                                class="flex-1 bg-primary text-white text-center py-3 rounded-md font-bold hover:bg-green-800 transition-colors shadow-sm">
                                Add to Cart
                            </a>
                        </div>

                        <a href="{{ route('checkout') }}"
                            class="block w-full text-center border border-primary text-primary py-3 rounded-md font-bold hover:bg-green-50 transition-colors">
                            Buy Now
                        </a>
                    </div>

                    <!-- Product Features -->
                    <div class="grid grid-cols-2 gap-4 mt-10">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            Gluten Free
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            Non GMO
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            Zero Cholesterol
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            High Protein
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Details Tabs -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-md border border-gray-100 overflow-hidden">
                <div class="flex border-b border-gray-100">
                    <button class="px-8 py-4 text-sm font-bold text-primary border-b-2 border-primary">Description</button>
                    <button
                        class="px-8 py-4 text-sm font-medium text-gray-500 hover:text-primary transition-colors">Nutritional
                        Info</button>
                    <button
                        class="px-8 py-4 text-sm font-medium text-gray-500 hover:text-primary transition-colors">Reviews</button>
                </div>
                <div class="p-8">
                    <h4 class="text-lg font-bold text-gray-900 mb-4">Product Overview</h4>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Our {{ $product['name'] }} is more than just a snack; it's a superfood. Fox nuts are known for their
                        low glycemic index and high dietary fiber content, making them an ideal choice for diabetic patients
                        and fitness enthusiasts alike.
                    </p>
                    <ul class="space-y-2 list-disc list-inside text-gray-600 text-sm">
                        <li>Slow-roasted to perfection</li>
                        <li>Sourced directly from farmers in Bihar</li>
                        <li>Packed in vacuum-sealed bags to preserve freshness</li>
                        <li>No artificial colors or preservatives added</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection