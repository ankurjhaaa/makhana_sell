@extends('Layout.adminlayout')
@section('title', 'Categories')

@section('admin_content')
    <div class="bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest">Product Categories</h4>
                <p class="text-[10px] text-gray-400 mt-1 uppercase font-bold">Manage your store sections and classification
                </p>
            </div>
            <a href="{{ route('admin.categories.create') }}"
                class="inline-flex items-center space-x-2 bg-primary text-white px-6 py-2.5 rounded-lg text-xs font-bold hover:bg-green-800 transition-all active:scale-95 shadow-md">
                <i class="fas fa-plus"></i>
                <span>Add New Category</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">S.No</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Image</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Category Name
                        </th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Products count
                        </th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($categories as $index => $category)
                        <tr class="hover:bg-gray-50/80 transition-colors group">
                            <td class="px-6 py-4 text-xs font-bold text-gray-400">#{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="w-12 h-12 rounded-md bg-gray-100 border border-gray-200 overflow-hidden">
                                    @if($category->image)
                                        <img src="{{ $category->image }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-gray-900">{{ $category->name }}</span>
                                <span
                                    class="block text-[9px] text-gray-400 font-mono tracking-tighter uppercase mt-0.5">/{{ $category->slug }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 rounded-md text-[10px] font-bold">
                                    {{ $category->products_count }} Items
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this category? This will affect related products.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors"
                                            title="Delete">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="text-gray-300 mb-4">
                                    <i class="fas fa-folder-open text-5xl"></i>
                                </div>
                                <p class="text-gray-400 italic text-sm">No categories found. Start by adding one!</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection