@extends('Layout.adminlayout')
@section('title', 'Manage Orders')

@section('admin_content')
    <div class="bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest">Order Pipeline</h4>
                <p class="text-[10px] text-gray-400 mt-1 uppercase font-bold">Track and process customer orders</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Filter:</span>
                <select class="text-xs font-bold bg-gray-50 border border-gray-100 rounded-lg px-3 py-2 outline-none">
                    <option>All Orders</option>
                    <option>Pending</option>
                    <option>Processing</option>
                    <option>Shipped</option>
                    <option>Delivered</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Order ID</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Customer Info
                        </th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Amount</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Payment</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $order)
                                <tr class="hover:bg-gray-50/80 transition-colors group text-sm">
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-gray-900">#{{ $order->id }}</span>
                                        <span
                                            class="block text-[9px] text-gray-400 mt-1">{{ $order->created_at->format('d M, Y H:i') }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-gray-900">{{ $order->customer_name }}</span>
                                            <span class="text-[10px] text-gray-400 flex items-center mt-1">
                                                <i class="fas fa-phone text-[8px] mr-1"></i> {{ $order->phone }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-black text-primary">₹{{ number_format($order->total_amount) }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">{{ $order->payment_method }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST"
                                            id="status_form_{{ $order->id }}">
                                            @csrf
                                            <select name="status" onchange="this.form.submit()"
                                                class="text-[10px] font-black uppercase tracking-wider px-3 py-1.5 rounded-full border-none appearance-none cursor-pointer focus:ring-2 focus:ring-primary/20 
                                                    {{ $order->status == 'pending' ? 'bg-orange-50 text-orange-600' :
                        ($order->status == 'shipped' ? 'bg-blue-50 text-blue-600' :
                            ($order->status == 'delivered' ? 'bg-green-50 text-primary' : 'bg-gray-100 text-gray-600')) }}">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                                    Processing</option>
                                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped
                                                </option>
                                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered
                                                </option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="#" class="p-2 text-primary hover:bg-green-50 rounded-lg transition-colors inline-block"
                                            title="View Details">
                                            <i class="fas fa-external-link-alt text-xs"></i>
                                        </a>
                                    </td>
                                </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="text-gray-300 mb-4">
                                    <i class="fas fa-truck-loading text-5xl"></i>
                                </div>
                                <p class="text-gray-400 italic text-sm">No orders have matching your criteria.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection