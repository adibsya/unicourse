<x-admin-layout>
    <div class="max-w-2xl">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Payment Details</h1>

        <div class="bg-white rounded-lg shadow p-6">
            <!-- User Info -->
            <div class="mb-6 pb-6 border-b">
                <h2 class="text-sm font-medium text-gray-500 mb-2">User</h2>
                <p class="text-lg font-semibold text-gray-900">{{ $payment->enrollment->user->name }}</p>
                <p class="text-gray-600">{{ $payment->enrollment->user->email }}</p>
            </div>

            <!-- Course Info -->
            <div class="mb-6 pb-6 border-b">
                <h2 class="text-sm font-medium text-gray-500 mb-2">Course</h2>
                <p class="text-lg font-semibold text-gray-900">{{ $payment->enrollment->course->title }}</p>
                <p class="text-2xl font-bold text-indigo-600 mt-2">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
            </div>

            <!-- Payment Info -->
            <div class="mb-6 pb-6 border-b">
                <h2 class="text-sm font-medium text-gray-500 mb-2">Payment Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Method</p>
                        <p class="font-medium">{{ $payment->payment_method ?: 'Not submitted' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Reference Number</p>
                        <p class="font-medium">{{ $payment->reference_number ?: '-' }}</p>
                    </div>
                </div>
                @if($payment->notes)
                    <div class="mt-4">
                        <p class="text-sm text-gray-500">Notes</p>
                        <p class="text-gray-700">{{ $payment->notes }}</p>
                    </div>
                @endif
            </div>

            <!-- Status -->
            <div class="mb-6">
                <h2 class="text-sm font-medium text-gray-500 mb-2">Status</h2>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    {{ $payment->status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                    {{ $payment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                    {{ $payment->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                    {{ ucfirst($payment->status) }}
                </span>
                @if($payment->verified_at)
                    <p class="text-sm text-gray-500 mt-2">Verified at: {{ $payment->verified_at->format('M d, Y H:i') }}</p>
                @endif
            </div>

            <!-- Actions -->
            @if($payment->status === 'pending')
                <div class="flex items-center gap-4 pt-6 border-t">
                    <form action="{{ route('admin.payments.approve', $payment) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700">
                            Approve Payment
                        </button>
                    </form>
                    <form action="{{ route('admin.payments.reject', $payment) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-md hover:bg-red-700">
                            Reject Payment
                        </button>
                    </form>
                </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('admin.payments.index') }}" class="text-indigo-600 hover:text-indigo-800">
                    â† Back to Payments
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>
