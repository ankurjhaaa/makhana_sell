@extends('Layout.adminlayout')
@section('title', 'Products')

@section('admin_content')
    <div class="bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest">Inventory List</h4>
                <p class="text-[10px] text-gray-400 mt-1 uppercase font-bold">Manage your product catalog and availability
                </p>
            </div>
            <a href="{{ route('admin.products.create') }}"
                class="inline-flex items-center space-x-2 bg-primary text-white px-6 py-2.5 rounded-lg text-xs font-bold hover:bg-green-800 transition-all active:scale-95 shadow-md">
                <i class="fas fa-plus"></i>
                <span>Add New Product</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Product</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Category</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Price</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Weight</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50/80 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="w-12 h-12 rounded-md bg-gray-100 border border-gray-200 overflow-hidden flex-shrink-0">
                                        @if($product->mainImage)
                                            <img src="{{ $product->mainImage->image_path }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                <i class="fas fa-cube"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <span class="text-sm font-bold text-gray-900 block truncate">{{ $product->name }}</span>
                                        <span
                                            class="text-[9px] text-gray-400 font-mono tracking-tighter uppercase">/{{ $product->slug }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2.5 py-1 bg-green-50 text-primary rounded-md text-[10px] font-bold uppercase tracking-wider">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-black text-gray-900">₹{{ number_format($product->price) }}</span>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500 font-bold">{{ $product->weight }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.products.delete', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this product?');">
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
                                    <i class="fas fa-box-open text-5xl"></i>
                                </div>
                                <p class="text-gray-400 italic text-sm">Inventory is empty. Add your first product!</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection