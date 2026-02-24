@extends('Layout.publiclayout')
@section('title', $product->name)

@section('content')
    <section class="py-4 md:py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs - Mobile Optimized -->
            <nav class="flex mb-6 text-[10px] font-bold uppercase tracking-widest text-gray-400 overflow-x-auto whitespace-nowrap no-scrollbar"
                aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-primary">Home</a></li>
                    <li><i class="fas fa-chevron-right text-[8px] mx-1"></i></li>
                    <li><a href="{{ route('items') }}" class="hover:text-primary">Products</a></li>
                    <li><i class="fas fa-chevron-right text-[8px] mx-1"></i></li>
                    <li class="text-primary truncate max-w-[150px]">{{ $product->name }}</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">
                <!-- Product Gallery - Mobile Centric -->
                <div class="space-y-4">
                    <div class="aspect-square bg-gray-50 rounded-xl overflow-hidden border border-gray-100 relative group">
                        <img src="{{ $product->mainImage->image_path ?? '' }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-500" id="main-product-image">
                        <div class="absolute top-4 right-4 md:hidden">
                            <span
                                class="bg-white/80 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold text-primary shadow-sm">
                                {{ $product->category->name ?? 'Premium' }}
                            </span>
                        </div>
                    </div>

                    @if($product->images->count() > 1)
                        <div class="flex gap-3 overflow-x-auto pb-2 no-scrollbar">
                            @foreach($product->images as $image)
                                <button onclick="document.getElementById('main-product-image').src = '{{ $image->image_path }}'"
                                    class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden border-2 {{ $image->is_main ? 'border-primary' : 'border-transparent' }} bg-gray-50 hover:border-primary transition-all">
                                    <img src="{{ $image->image_path }}" alt="Gallery thumbnail" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Product Data -->
                <div class="flex flex-col">
                    <div class="mb-6">
                        <h1 class="text-2xl md:text-4xl font-extrabold text-gray-900 mb-2 leading-tight">
                            {{ $product->name }}
                        </h1>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="flex text-yellow-400 text-xs">
                                @for($i = 1; $i <= 5; $i++)
                                    <i
                                        class="fas fa-star {{ $i <= $product->avg_rating ? 'text-yellow-400' : 'text-gray-200' }}"></i>
                                @endfor
                            </div>
                            <span class="text-xs text-gray-400 font-bold">({{ number_format($product->avg_rating, 1) }}/5
                                Rating from {{ $product->reviews->count() }} reviews)</span>
                        </div>

                        <div class="flex items-baseline space-x-4">
                            <span class="text-3xl font-bold text-primary">₹{{ $product->price }}</span>
                            <span class="text-lg text-gray-400 line-through">₹{{ round($product->price * 1.25) }}</span>
                            <span
                                class="text-green-600 text-xs font-bold uppercase tracking-wider bg-green-50 px-2 py-1 rounded">Save
                                20%</span>
                        </div>
                    </div>

                    <div class="p-4 bg-green-50/50 rounded-lg border border-green-100 mb-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-weight-hanging text-primary text-sm"></i>
                                <span class="text-xs font-bold text-gray-700">{{ $product->weight }} Net</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-leaf text-primary text-sm"></i>
                                <span class="text-xs font-bold text-gray-700">100% Organic</span>
                            </div>
                        </div>
                    </div>

                    <p class="text-gray-500 text-sm leading-relaxed mb-8">
                        {{ $product->description }}
                    </p>

                    <!-- Add to Cart -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                        @csrf
                        <div class="flex flex-col sm:flex-row gap-4 mb-6">
                            <div
                                class="flex items-center justify-between border-2 border-gray-100 rounded-xl p-1 bg-white sm:w-32">
                                <button type="button" onclick="this.nextElementSibling.stepDown()"
                                    class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-primary">
                                    <i class="fas fa-minus text-xs"></i>
                                </button>
                                <input type="number" name="quantity" value="1" min="1"
                                    class="w-8 text-center bg-transparent border-none focus:ring-0 font-bold text-sm"
                                    readonly>
                                <button type="button" onclick="this.previousElementSibling.stepUp()"
                                    class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-primary">
                                    <i class="fas fa-plus text-xs"></i>
                                </button>
                            </div>
                            <button type="submit"
                                class="flex-1 bg-primary text-white h-12 md:h-14 rounded-xl font-bold hover:bg-green-800 transition-all shadow-lg active:scale-95 transform flex items-center justify-center space-x-3">
                                <i class="fas fa-shopping-basket"></i>
                                <span>Add to Bag</span>
                            </button>
                        </div>
                    </form>

                    <!-- Trust Badges -->
                    <div class="grid grid-cols-2 gap-4 border-t border-gray-100 pt-8">
                        <div class="flex items-center space-x-3 group">
                            <div
                                class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                                <i class="fas fa-truck-fast"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-900 uppercase">Fast Shipping</p>
                                <p class="text-[9px] text-gray-400">Delivery in 3-5 days</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 group">
                            <div
                                class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                                <i class="fas fa-shield-halved"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-900 uppercase">Secure Payment</p>
                                <p class="text-[9px] text-gray-400">100% Safe Checkout</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details Tabs -->
            <div class="mt-12 md:mt-20 border-t border-gray-100 pt-12">
                <div class="max-w-3xl">
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6">Why our Makhana?</h4>
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 flex-shrink-0"></div>
                            <p class="text-sm text-gray-500 leading-relaxed">Our makhana are harvested using sustainable
                                methods which preserves their natural nutrients and crunchy texture.</p>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 flex-shrink-0"></div>
                            <p class="text-sm text-gray-500 leading-relaxed">Each batch is tested for purity and size
                                consistency to ensure you only get the best superfood experience.</p>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 flex-shrink-0"></div>
                            <p class="text-sm text-gray-500 leading-relaxed">Roasting is done in small batches with premium
                                olive oil and natural spices to keep it heart-healthy.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Reviews -->
            <div class="mt-12 md:mt-20 border-t border-gray-100 pt-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Reviews List -->
                    <div class="space-y-8">
                        <h4 class="text-sm font-bold text-gray-900 uppercase tracking-widest flex items-center">
                            Customer Reviews
                            <span
                                class="ml-3 bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full text-[10px]">{{ $product->reviews->count() }}</span>
                        </h4>

                        <div class="space-y-6">
                            @forelse($product->reviews()->latest()->get() as $review)
                                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 relative">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center text-primary text-[10px] font-bold uppercase">
                                                {{ substr($review->user->name, 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="text-xs font-bold text-gray-900">{{ $review->user->name }}</p>
                                                <p class="text-[10px] text-gray-400">{{ $review->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex text-yellow-400 text-[10px]">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-200' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    @if($review->comment)
                                        <p class="text-xs text-gray-600 leading-relaxed italic">"{{ $review->comment }}"</p>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                                    <i class="fas fa-comment-dots text-gray-300 text-2xl mb-4 block"></i>
                                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">No reviews yet. Be the
                                        first!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Review Form -->
                    <div class="bg-white p-6 md:p-8 rounded-2xl border border-gray-100 shadow-sm self-start sticky top-24">
                        <h4 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6">Write a Review</h4>

                        @auth
                            <form action="{{ route('product.review', $product->id) }}" method="POST">
                                @csrf
                                <div class="mb-6">
                                    <label
                                        class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mb-3">Rating</label>
                                    <div class="flex items-center gap-2" id="star-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <input type="radio" name="rating" value="{{ $i }}" id="star-{{ $i }}"
                                                class="hidden peer" {{ old('rating') == $i ? 'checked' : '' }} required>
                                            <label for="star-{{ $i }}"
                                                class="cursor-pointer text-2xl text-gray-200 hover:text-yellow-400 peer-checked:text-yellow-400 transition-colors">
                                                <i class="fas fa-star"></i>
                                            </label>
                                        @endfor
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block mb-3">Your
                                        Experience (Optional)</label>
                                    <textarea name="comment" rows="4" placeholder="How was the crunch? Tell us everything..."
                                        class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-0 outline-none transition-all text-sm resize-none">{{ old('comment') }}</textarea>
                                </div>

                                <button type="submit"
                                    class="w-full bg-primary text-white py-4 rounded-xl font-bold hover:bg-green-800 transition-all shadow-md active:scale-95 transform">
                                    Submit Review
                                </button>
                            </form>
                        @else
                            <div class="text-center py-8">
                                <p class="text-xs text-gray-500 mb-6">Please login to share your experience with this product.
                                </p>
                                <a href="{{ route('login') }}"
                                    class="inline-flex bg-gray-100 text-gray-900 px-6 py-2.5 rounded-lg text-[10px] font-bold uppercase tracking-widest hover:bg-primary hover:text-white transition-all">
                                    Login to Review
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Star rating interactions
        document.querySelectorAll('#star-rating label').forEach(label => {
            label.addEventListener('mouseover', function () {
                let rating = this.getAttribute('for').split('-')[1];
                highlightStars(rating);
            });

            label.addEventListener('mouseleave', function () {
                let checked = document.querySelector('#star-rating input:checked');
                highlightStars(checked ? checked.value : 0);
            });
        });

        function highlightStars(rating) {
            document.querySelectorAll('#star-rating label').forEach((l, index) => {
                if (index < rating) {
                    l.classList.add('text-yellow-400');
                    l.classList.remove('text-gray-200');
                } else {
                    l.classList.remove('text-yellow-400');
                    l.classList.add('text-gray-200');
                }
            });
        }
    </script>
@endsection