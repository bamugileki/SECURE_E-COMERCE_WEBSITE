<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show py-2 small" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-gray-500 text-sm">Total Products</p>
                    <p class="text-3xl font-bold">{{ $totalProducts }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-gray-500 text-sm">Total Orders</p>
                    <p class="text-3xl font-bold">{{ $totalOrders }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-gray-500 text-sm">Total Users</p>
                    <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-gray-500 text-sm">Total Revenue</p>
                    <p class="text-3xl font-bold">Tsh {{ number_format($totalRevenue, 0) }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Recent Orders</h3>
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm">Order</th>
                            <th class="px-4 py-2 text-left text-sm">Customer</th>
                            <th class="px-4 py-2 text-left text-sm">Total</th>
                            <th class="px-4 py-2 text-left text-sm">Status</th>
                            <th class="px-4 py-2 text-left text-sm">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($recentOrders as $order)
                            <tr>
                                <td class="px-4 py-2 text-sm">#{{ $order->id }}</td>
                                <td class="px-4 py-2 text-sm">{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                                <td class="px-4 py-2 text-sm">Tsh {{ number_format($order->total_price, 0) }}</td>
                                <td class="px-4 py-2">
                                    <span class="px-2 py-1 rounded text-xs
                                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status === 'confirmed') bg-blue-100 text-blue-800
                                        @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                                        @else bg-green-100 text-green-800 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-sm">{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Management Links --}}
            <h3 class="text-sm font-semibold text-gray-700 mb-3 mt-8">Management</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <a href="{{ route('admin.products') }}" class="bg-white rounded-lg shadow p-5 text-center hover:bg-gray-50 hover-lift">
                    <p class="text-base font-semibold text-indigo-600">Manage Products</p>
                </a>
                <a href="{{ route('admin.orders') }}" class="bg-white rounded-lg shadow p-5 text-center hover:bg-gray-50 hover-lift">
                    <p class="text-base font-semibold text-indigo-600">Manage Orders</p>
                </a>
                <a href="{{ route('admin.categories') }}" class="bg-white rounded-lg shadow p-5 text-center hover:bg-gray-50 hover-lift">
                    <p class="text-base font-semibold text-indigo-600">Manage Categories</p>
                </a>
                <a href="{{ route('admin.users') }}" class="bg-white rounded-lg shadow p-5 text-center hover:bg-gray-50 hover-lift">
                    <p class="text-base font-semibold text-indigo-600">Manage Users</p>
                </a>
                <a href="{{ route('admin.history') }}" class="bg-white rounded-lg shadow p-5 text-center hover:bg-gray-50 hover-lift">
                    <p class="text-base font-semibold text-indigo-600">Activity History</p>
                </a>
                <a href="{{ route('admin.ratings') }}" class="bg-white rounded-lg shadow p-5 text-center hover:bg-gray-50 hover-lift">
                    <p class="text-base font-semibold text-indigo-600">Product Ratings</p>
                </a>
            </div>



            {{-- Analytics & Reports --}}
            <h3 class="text-sm font-semibold text-gray-700 mb-3 mt-8">Analytics & Reports</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <a href="{{ route('admin.reports') }}" class="bg-white rounded-lg shadow p-5 text-center hover:bg-gray-50 hover-lift">
                    <p class="text-base font-semibold text-indigo-600">Sales Reports</p>
                    <p class="text-xs text-gray-500 mt-1">View sales &amp; monthly revenue</p>
                </a>
                <a href="{{ route('admin.reports') }}#revenue" class="bg-white rounded-lg shadow p-5 text-center hover:bg-gray-50 hover-lift">
                    <p class="text-base font-semibold text-green-600">Monitor Revenue</p>
                    <p class="text-xs text-gray-500 mt-1">Track revenue over time</p>
                </a>
                <a href="{{ route('admin.reports') }}#best-sellers" class="bg-white rounded-lg shadow p-5 text-center hover:bg-gray-50 hover-lift">
                    <p class="text-base font-semibold text-purple-600">Best Sellers</p>
                    <p class="text-xs text-gray-500 mt-1">Track best-selling products</p>
                </a>
                <a href="{{ route('admin.reports') }}#customers" class="bg-white rounded-lg shadow p-5 text-center hover:bg-gray-50 hover-lift">
                    <p class="text-base font-semibold text-blue-600">Customer Activity</p>
                    <p class="text-xs text-gray-500 mt-1">Analyze customer behavior</p>
                </a>
            </div>

            {{-- Customer Support --}}
            <h3 class="text-sm font-semibold text-gray-700 mb-3 mt-8">Customer Support</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <a href="{{ route('admin.support.messages') }}" class="bg-white rounded-lg shadow p-5 text-center hover:bg-gray-50 hover-lift">
                    <p class="text-base font-semibold text-indigo-600">Support Messages</p>
                    <p class="text-xs text-gray-500 mt-1">Respond to customer inquiries</p>
                </a>
                <a href="{{ route('admin.support.messages') }}?type=complaint" class="bg-white rounded-lg shadow p-5 text-center hover:bg-gray-50 hover-lift">
                    <p class="text-base font-semibold text-red-600">Complaints</p>
                    <p class="text-xs text-gray-500 mt-1">Manage complaints &amp; feedback</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
