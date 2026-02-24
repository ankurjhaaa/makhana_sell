@extends('Layout.adminlayout')
@section('title', 'Add Product')

@section('admin_content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex items-center space-x-3">
                <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                    <i class="fas fa-cart-plus"></i>
                </div>
                <div>
                    <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest">New Product</h4>
                    <p class="text-[10px] text-gray-400 mt-1 uppercase font-bold">Add details and images for your product
                    </p>
                </div>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                class="p-8 space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Basic Info -->
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Product
                                Name</label>
                            <input type="text" name="name" required placeholder="makhana name"
                                class="w-full px-4 py-3 rounded-lg border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Price
                                    (₹)</label>
                                <input type="number" name="price" required placeholder="0.00"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm">
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Weight/Size</label>
                                <input type="text" name="weight" required placeholder="e.g. 100g, 250g"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Category</label>
                            <select name="category_id" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm appearance-none">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Description & Status -->
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Description</label>
                            <textarea name="description" rows="5" required
                                placeholder="Describe your product crispy details..."
                                class="w-full px-4 py-3 rounded-lg border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm resize-none"></textarea>
                        </div>

                        <div class="space-y-4">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block">Product
                                Images</label>
                            <div class="grid grid-cols-3 gap-3">
                                <label
                                    class="aspect-square bg-gray-50 border-2 border-dashed border-gray-200 rounded-lg flex items-center justify-center cursor-pointer hover:bg-gray-100 hover:border-primary transition-all">
                                    <i class="fas fa-plus text-gray-300"></i>
                                    <input type="file" name="images[]" multiple class="hidden"
                                        onchange="previewImages(this)">
                                </label>
                                <div id="image_previews" class="contents"></div>
                            </div>
                            <p class="text-[8px] text-gray-300 uppercase opacity-70">First image will be set as Main Image
                            </p>
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-gray-50 flex items-center justify-between">
                    <a href="{{ route('admin.products') }}"
                        class="text-xs font-bold text-gray-400 hover:text-gray-900 transition-colors uppercase tracking-widest">Cancel</a>
                    <button type="submit"
                        class="bg-primary text-white px-10 py-4 rounded-lg text-xs font-black uppercase tracking-widest hover:bg-green-800 transition-all shadow-lg active:scale-95 transform">
                        Publish Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImages(input) {
            const container = document.getElementById('image_previews');
            container.innerHTML = '';

            if (input.files) {
                Array.from(input.files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const div = document.createElement('div');
                        div.className = 'relative aspect-square rounded-lg overflow-hidden border border-gray-100';
                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-full object-cover">
                            ${index === 0 ? '<span class="absolute top-1 left-1 bg-primary text-white text-[6px] font-black uppercase px-1 rounded">Main</span>' : ''}
                        `;
                        container.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
@endsection