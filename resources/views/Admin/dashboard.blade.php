@extends('Layout.adminlayout')
@section('title', 'Dashboard')

@section('admin_content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Total Revenue -->
        <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-green-50 text-primary rounded-lg flex items-center justify-center">
                    <i class="fas fa-indian-rupee-sign"></i>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Revenue</span>
            </div>
            <h3 class="text-2xl font-black text-gray-900">₹{{ number_format($stats['total_revenue']) }}</h3>
            <p class="text-[10px] text-gray-400 mt-1">Excludes cancelled orders</p>
        </div>

        <!-- Total Orders -->
        <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-truck-loading"></i>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Orders</span>
            </div>
            <h3 class="text-2xl font-black text-gray-900">{{ $stats['total_orders'] }}</h3>
            <p class="text-[10px] text-gray-400 mt-1">Check pending shipments</p>
        </div>

        <!-- Total Products -->
        <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-orange-50 text-orange-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shopping-basket"></i>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Live Products</span>
            </div>
            <h3 class="text-2xl font-black text-gray-900">{{ $stats['total_products'] }}</h3>
            <p class="text-[10px] text-gray-400 mt-1">Across {{ $stats['total_categories'] }} categories</p>
        </div>

        <!-- Total Categories -->
        <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-folder-tree"></i>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Categories</span>
            </div>
            <h3 class="text-2xl font-black text-gray-900">{{ $stats['total_categories'] }}</h3>
            <p class="text-[10px] text-gray-400 mt-1">View all sections</p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Recent Orders -->
        <div class="xl:col-span-2 bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest">Recent Orders</h4>
                <a href="{{ route('admin.orders') }}" class="text-xs font-bold text-primary hover:underline">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Order ID
                            </th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Customer
                            </th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($stats['recent_orders'] as $order)
                            <tr class="hover:bg-gray-200/50 transition-colors">
                                <td class="px-6 py-4 text-xs font-bold text-gray-900">#{{ $order->id }}</td>
                                <td class="px-6 py-4 text-xs text-gray-600">{{ $order->customer_name }}</td>
                                <td class="px-6 py-4 text-xs font-black text-primary">₹{{ number_format($order->total_amount) }}
                                </td>
                                <td class="px-6 py-4 italic">
                                    <span
                                        class="px-2.5 py-1 rounded-full text-[9px] font-black uppercase tracking-wider {{ $order->status == 'pending' ? 'bg-orange-50 text-orange-600' : 'bg-green-50 text-primary' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-xs text-gray-400 italic">No recent orders yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg border border-gray-100 shadow-sm p-6">
            <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-50 pb-2">Quick
                Actions</h4>
            <div class="space-y-4">
                <a href="{{ route('admin.products.create') }}"
                    class="w-full flex items-center space-x-3 p-4 rounded-lg bg-gray-50 border border-gray-100 hover:border-primary transition-all group">
                    <div
                        class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-gray-900 block">Add New Product</span>
                        <span class="text-[10px] text-gray-400">Add to your inventory</span>
                    </div>
                </a>
                <a href="{{ route('admin.categories.create') }}"
                    class="w-full flex items-center space-x-3 p-4 rounded-lg bg-gray-50 border border-gray-100 hover:border-primary transition-all group">
                    <div
                        class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                        <i class="fas fa-folder-plus"></i>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-gray-900 block">New Category</span>
                        <span class="text-[10px] text-gray-400">Classify your products</span>
                    </div>
                </a>
                <a href="#"
                    class="w-full flex items-center space-x-3 p-4 rounded-lg bg-gray-50 border border-gray-100 hover:border-primary transition-all group">
                    <div
                        class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-gray-900 block">Site Settings</span>
                        <span class="text-[10px] text-gray-400">Configure your store</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection