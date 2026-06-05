<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Shopping Cart</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ $errors->first() }}</div>
            @endif

            @if($cartItems->isEmpty())
                <div class="bg-white rounded-lg shadow p-8 text-center">
                    <p class="text-gray-500 text-lg">Your cart is empty.</p>
                    <a href="{{ route('products.index') }}" class="inline-block mt-4 bg-indigo-500 text-white px-6 py-2 rounded hover:bg-indigo-600">Continue Shopping</a>
                </div>
            @else
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="w-full" id="cartTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Product</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Price</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Quantity</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Subtotal</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                                <tr data-price="{{ $item->product->currentPrice() }}" data-stock="{{ $item->product->stock }}">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if($item->product->image)
                                                <img src="{{ Storage::url($item->product->image) }}" class="w-12 h-12 object-cover rounded mr-3">
                                            @endif
                                            <a href="{{ route('products.show', $item->product) }}" class="text-sm font-medium text-gray-900 hover:text-indigo-600">{{ $item->product->name }}</a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm price">Tsh {{ number_format($item->product->currentPrice(), 0) }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="w-16 rounded border-gray-300 text-sm qty-input" oninput="updateCartTotal()">
                                            <button type="submit" class="text-indigo-600 text-sm hover:underline">Update</button>
                                        </form>
                                        <div class="stock-remaining text-xs mt-1"></div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold subtotal">Tsh {{ number_format($item->product->currentPrice() * $item->quantity, 0) }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 text-sm hover:underline">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-xl font-bold">Total: Tsh <span id="cartTotal">{{ number_format($total, 0) }}</span></span>
                            <div class="mt-2 flex items-center gap-2 text-xs text-gray-500">
                                <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded">Secure Checkout</span>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Continue Shopping</a>
                            <a href="{{ route('checkout.gateways') }}" class="bg-green-500 text-white px-8 py-2 rounded hover:bg-green-600 font-semibold">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>

    <script>
        function updateCartTotal() {
            var total = 0;
            var rows = document.querySelectorAll('#cartTable tbody tr');

            rows.forEach(function(row) {
                var price = parseFloat(row.getAttribute('data-price')) || 0;
                var stock = parseInt(row.getAttribute('data-stock')) || 0;
                var qtyInput = row.querySelector('.qty-input');
                var qty = parseInt(qtyInput.value) || 0;
                var subtotal = price * qty;

                var subtotalCell = row.querySelector('.subtotal');
                subtotalCell.textContent = 'Tsh ' + number_format(subtotal, 0);

                var remaining = stock - qty;
                var stockEl = row.querySelector('.stock-remaining');
                if (remaining < 0) {
                    stockEl.textContent = 'Not enough stock!';
                    stockEl.className = 'stock-remaining text-xs mt-1 text-red-600 font-semibold';
                } else if (remaining <= 5) {
                    stockEl.textContent = remaining + ' remaining';
                    stockEl.className = 'stock-remaining text-xs mt-1 text-orange-500';
                } else {
                    stockEl.textContent = '';
                    stockEl.className = 'stock-remaining text-xs mt-1';
                }

                total += subtotal;
            });

            document.getElementById('cartTotal').textContent = number_format(total, 0);
        }

        function number_format(number, decimals) {
            return Math.floor(number).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
    </script>
    @endif
        </div>
    </div>
</x-app-layout>
