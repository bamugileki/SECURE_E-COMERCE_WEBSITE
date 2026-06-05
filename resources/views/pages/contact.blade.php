<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Contact Us</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-lg shadow p-8">
                <h1 class="text-3xl font-bold mb-6">Contact Us</h1>

                <p class="text-gray-700 mb-4">
                    We are always here to support you. Reach out to SmartTrade Secure Platform for any inquiries, support, or assistance.
                </p>

                <h3 class="text-xl font-semibold mt-6 mb-2">Contact Information</h3>

                <ul class="text-gray-700 space-y-1 mb-4">
                    <li><strong>Name:</strong> Francis Bamugileki</li>
                    <li><strong>Email:</strong> francis@hesmb.com</li>
                    <li><strong>Phone:</strong> +255 689 045 666</li>
                </ul>

                <h3 class="text-xl font-semibold mt-6 mb-2">Location</h3>
                <p class="text-gray-700 mb-4">
                    Ngongona, Dodoma - Dodoma, Tanzania
                </p>

                <h3 class="text-xl font-semibold mt-6 mb-2">Send Message</h3>
                <p class="text-gray-700 mb-4">
                    For any technical issues, account problems, or order inquiries, our support team will respond within 24 hours.
                </p>

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                            <input type="text" name="name" value="{{ old('name', auth()->check() ? auth()->user()->first_name . ' ' . auth()->user()->last_name : '') }}" class="w-full rounded border-gray-300" required>
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Your Email</label>
                            <input type="email" name="email" value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" class="w-full rounded border-gray-300" required>
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" class="w-full rounded border-gray-300" required placeholder="Brief subject of your message">
                        @error('subject') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                        <select name="type" class="w-full rounded border-gray-300" required>
                            <option value="inquiry" {{ old('type') === 'inquiry' ? 'selected' : '' }}>General Inquiry</option>
                            <option value="complaint" {{ old('type') === 'complaint' ? 'selected' : '' }}>Complaint</option>
                            <option value="feedback" {{ old('type') === 'feedback' ? 'selected' : '' }}>Feedback</option>
                            <option value="other" {{ old('type') === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Your Message</label>
                        <textarea name="message" rows="5" class="w-full rounded border-gray-300" required placeholder="Describe your issue or inquiry in detail...">{{ old('message') }}</textarea>
                        @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 font-medium">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>