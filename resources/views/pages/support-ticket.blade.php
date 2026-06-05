<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Support Ticket #{{ $message->id }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow overflow-hidden">

                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $message->subject }}</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ ucfirst($message->type) }} &bull; {{ $message->created_at->format('M d, Y H:i') }}
                            </p>
                        </div>
                        <span class="px-3 py-1 rounded text-xs font-semibold
                            @if($message->status === 'open') bg-yellow-100 text-yellow-800
                            @elseif($message->status === 'replied') bg-blue-100 text-blue-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($message->status) }}
                        </span>
                    </div>
                </div>

                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-sm font-bold text-indigo-600 flex-shrink-0">
                            {{ substr($message->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold">{{ $message->name }}</p>
                            <p class="text-sm text-gray-700 mt-1">{{ $message->message }}</p>
                        </div>
                    </div>
                </div>

                @if($message->admin_reply)
                    <div class="p-6 border-b border-gray-200 bg-blue-50">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-sm font-bold text-blue-600 flex-shrink-0">
                                A
                            </div>
                            <div>
                                <p class="text-sm font-semibold">Admin Reply</p>
                                <p class="text-sm text-blue-900 mt-1">{{ $message->admin_reply }}</p>
                                @if($message->replied_at)
                                    <p class="text-xs text-blue-500 mt-2">{{ $message->replied_at->diffForHumans() }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <div class="p-6 text-sm text-gray-500">
                    @if($message->status === 'open')
                        Your ticket is open. An admin will respond shortly.
                    @elseif($message->status === 'replied')
                        An admin has replied to your ticket. If you need further assistance, please submit a new message.
                    @else
                        This ticket is closed. Thank you for reaching out.
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>