@extends('Layout.adminlayout')
@section('title', 'Edit Product')

@section('admin_content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex items-center space-x-3">
                <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                    <i class="fas fa-edit"></i>
                </div>
                <div>
                    <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest">Edit Product</h4>
                    <p class="text-[10px] text-gray-400 mt-1 uppercase font-bold">Update product details and inventory</p>
                </div>
            </div>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                class="p-8 space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Basic Info -->
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Product
                                Name</label>
                            <input type="text" name="name" required value="{{ $product->name }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Price
                                    (₹)</label>
                                <input type="number" name="price" required value="{{ $product->price }}"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm">
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Weight/Size</label>
                                <input type="text" name="weight" required value="{{ $product->weight }}"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Category</label>
                            <select name="category_id" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm appearance-none">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Description & Images -->
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Description</label>
                            <textarea name="description" rows="5" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm resize-none">{{ $product->description }}</textarea>
                        </div>

                        <div class="space-y-4">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block">Current
                                Images</label>
                            <div class="grid grid-cols-4 gap-3">
                                @foreach($product->images as $image)
                                    <div class="relative aspect-square rounded-lg overflow-hidden border border-gray-100">
                                        <img src="{{ $image->image_path }}" class="w-full h-full object-cover">
                                        @if($image->is_main)
                                            <span
                                                class="absolute top-1 left-1 bg-primary text-white text-[6px] font-black uppercase px-1 rounded">Main</span>
                                        @endif
                                    </div>
                                @endforeach
                                <label
                                    class="aspect-square bg-gray-50 border-2 border-dashed border-gray-200 rounded-lg flex items-center justify-center cursor-pointer hover:bg-gray-100 hover:border-primary transition-all">
                                    <i class="fas fa-plus text-gray-300"></i>
                                    <input type="file" name="images[]" multiple class="hidden"
                                        onchange="previewImages(this)">
                                </label>
                            </div>
                            <div id="image_previews" class="grid grid-cols-4 gap-3 mt-4"></div>
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-gray-50 flex items-center justify-between">
                    <a href="{{ route('admin.products') }}"
                        class="text-xs font-bold text-gray-400 hover:text-gray-900 transition-colors uppercase tracking-widest">Cancel</a>
                    <button type="submit"
                        class="bg-primary text-white px-10 py-4 rounded-lg text-xs font-black uppercase tracking-widest hover:bg-green-800 transition-all shadow-lg active:scale-95 transform">
                        Update Product
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
                Array.from(input.files).forEach((file) => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const div = document.createElement('div');
                        div.className = 'relative aspect-square rounded-lg overflow-hidden border border-primary/30';
                        div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                        container.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
@endsection