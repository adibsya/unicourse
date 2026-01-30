<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Submit Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <!-- Course Info -->
                    <div class="mb-6 pb-6 border-b">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $enrollment->course->title }}</h3>
                        <p class="text-2xl font-bold text-indigo-600 mt-2">
                            Rp {{ number_format($payment->amount, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Payment Status -->
                    @if($payment->status !== 'pending')
                        <div class="mb-6 p-4 rounded-lg {{ $payment->status === 'paid' ? 'bg-green-50' : 'bg-red-50' }}">
                            <p class="font-medium {{ $payment->status === 'paid' ? 'text-green-800' : 'text-red-800' }}">
                                Payment Status: {{ ucfirst($payment->status) }}
                            </p>
                            @if($payment->verified_at)
                                <p class="text-sm {{ $payment->status === 'paid' ? 'text-green-600' : 'text-red-600' }} mt-1">
                                    Verified at: {{ $payment->verified_at->format('M d, Y H:i') }}
                                </p>
                            @endif
                        </div>
                    @else
                        <!-- Payment Form -->
                        <form action="{{ route('payments.store', $enrollment) }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">
                                    Payment Method *
                                </label>
                                <input type="text" name="payment_method" id="payment_method" 
                                       value="{{ old('payment_method', $payment->payment_method) }}"
                                       placeholder="e.g., BCA Transfer, Mandiri, GoPay"
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       required>
                                @error('payment_method')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="reference_number" class="block text-sm font-medium text-gray-700 mb-2">
                                    Reference / Transfer Number
                                </label>
                                <input type="text" name="reference_number" id="reference_number" 
                                       value="{{ old('reference_number', $payment->reference_number) }}"
                                       placeholder="e.g., TRF123456789"
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('reference_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                    Additional Notes
                                </label>
                                <textarea name="notes" id="notes" rows="3"
                                          placeholder="Any additional information about your payment..."
                                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $payment->notes) }}</textarea>
                                @error('notes')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="bg-yellow-50 p-4 rounded-lg mb-6">
                                <p class="text-sm text-yellow-800">
                                    <strong>Important:</strong> Please transfer the exact amount to our bank account, then fill in the payment details above. Our admin will verify your payment within 1x24 hours.
                                </p>
                            </div>

                            <div class="flex items-center justify-between">
                                <a href="{{ route('my-courses') }}" 
                                   class="text-gray-600 hover:text-gray-800">
                                    â† Back to My Courses
                                </a>
                                <button type="submit" 
                                        class="bg-indigo-600 text-white py-2 px-6 rounded-md hover:bg-indigo-700 transition">
                                    Submit Payment
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
