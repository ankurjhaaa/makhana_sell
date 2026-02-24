@extends('Layout.adminlayout')
@section('title', 'Edit Category')

@section('admin_content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex items-center space-x-3">
                <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                    <i class="fas fa-edit"></i>
                </div>
                <div>
                    <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest">Edit Category</h4>
                    <p class="text-[10px] text-gray-400 mt-1 uppercase font-bold">Update category details and appearance</p>
                </div>
            </div>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data"
                class="p-8 space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Category Name</label>
                    <input type="text" name="name" required value="{{ $category->name }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">
                    {{ $message }}</p> @enderror
                </div>

                <div class="space-y-4">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block">Update
                        Thumbnail</label>
                    <div class="relative group">
                        <input type="file" name="image" id="category_image" class="hidden" onchange="previewImage(this)">
                        <label for="category_image"
                            class="flex flex-col items-center justify-center w-full h-48 bg-gray-50 border-2 border-dashed border-gray-200 rounded-lg cursor-pointer hover:bg-gray-100 hover:border-primary transition-all group">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6 {{ $category->image ? 'hidden' : '' }}"
                                id="preview_placeholder">
                                <i
                                    class="fas fa-cloud-upload-alt text-3xl text-gray-300 mb-3 group-hover:text-primary transition-colors"></i>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-2">Click to
                                    replace image</p>
                                <p class="text-[8px] text-gray-300 mt-1 uppercase tracking-tighter">Max 2MB</p>
                            </div>
                            <img id="image_preview" src="{{ $category->image }}"
                                class="{{ $category->image ? '' : 'hidden' }} h-full w-full object-contain p-4">
                        </label>
                    </div>
                    @error('image') <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">
                    {{ $message }}</p> @enderror
                </div>

                <div class="pt-6 border-t border-gray-50 flex items-center justify-between">
                    <a href="{{ route('admin.categories') }}"
                        class="text-xs font-bold text-gray-400 hover:text-gray-900 transition-colors uppercase tracking-widest">Cancel</a>
                    <button type="submit"
                        class="bg-primary text-white px-8 py-3 rounded-lg text-xs font-bold hover:bg-green-800 transition-all shadow-md active:scale-95 transform">
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('image_preview');
            const placeholder = document.getElementById('preview_placeholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection