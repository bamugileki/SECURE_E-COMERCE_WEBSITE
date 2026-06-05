<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Confirm Payment</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow overflow-hidden">

                <div class="p-6 border-b border-gray-200 bg-yellow-50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Mock Payment Gateway</h3>
                            <p class="text-sm text-gray-600">This is a simulated payment. No real transaction will occur.</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <h4 class="font-semibold text-gray-900 mb-4">Order Summary</h4>

                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Qty</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Price</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                                <tr>
                                    <td class="px-4 py-3 text-sm">{{ $item->product->name }}</td>
                                    <td class="px-4 py-3 text-sm text-center">{{ $item->quantity }}</td>
                                    <td class="px-4 py-3 text-sm text-right">Tsh {{ number_format($item->product->currentPrice(), 0) }}</td>
                                    <td class="px-4 py-3 text-sm text-right font-semibold">Tsh {{ number_format($item->product->currentPrice() * $item->quantity, 0) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50 font-semibold">
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-sm text-right">Total ({{ $count }} items):</td>
                                <td class="px-4 py-3 text-sm text-right">Tsh {{ number_format($total, 0) }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4 text-sm text-blue-800">
                        <p class="font-semibold flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                            </svg>
                            Payment Method: Mock Payment (Test)
                        </p>
                        <p class="mt-1">Click "Confirm Payment" to simulate a successful transaction. Your order will be created and you will receive a confirmation notification.</p>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex gap-4 justify-end">
                    <a href="{{ route('payment.cancel', ['gateway' => 'mock', 'mock_reference' => $reference]) }}"
                       class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 font-medium">
                        Cancel
                    </a>
                    <a href="{{ route('payment.success', ['gateway' => 'mock', 'mock_reference' => $reference]) }}"
                       class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 font-semibold flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                        </svg>
                        Confirm Payment
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>