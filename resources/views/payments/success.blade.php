<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Successful') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-2xl text-center p-8">
                <!-- Success Animation -->
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Payment Successful!</h2>
                <p class="text-gray-600 mb-6">Your payment has been processed and verified.</p>
                
                <!-- Transaction Details -->
                <div class="bg-gray-50 rounded-xl p-6 mb-6 text-left">
                    <h3 class="font-semibold text-gray-700 mb-4">Transaction Details</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Course</span>
                            <span class="font-medium text-gray-900">{{ $enrollment->course->title }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Amount Paid</span>
                            <span class="font-medium text-green-600">Rp {{ number_format($enrollment->payment->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Transaction ID</span>
                            <span class="font-mono text-sm text-gray-900">{{ $enrollment->payment->reference_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Date</span>
                            <span class="text-gray-900">{{ $enrollment->payment->verified_at->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Course Access -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                    <div class="flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-blue-800">You now have full access to this course!</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('courses.show', $enrollment->course) }}" 
                       class="bg-navy-800 text-white py-3 px-6 rounded-lg hover:bg-navy-900 transition font-semibold flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Start Learning
                    </a>
                    <a href="{{ route('my-courses') }}" 
                       class="bg-gray-200 text-gray-700 py-3 px-6 rounded-lg hover:bg-gray-300 transition font-semibold">
                        Go to My Courses
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
