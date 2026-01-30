<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-navy-900 leading-tight">
            {{ __('My Learning') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-navy-900 mb-2">My Learning</h1>
                <p class="text-gray-600">Track your enrolled courses and payment status</p>
            </div>

            @forelse($enrollments as $enrollment)
                <div class="bg-white rounded-xl shadow-sm mb-4 overflow-hidden border border-gray-100 hover:shadow-md transition">
                    <div class="flex flex-col md:flex-row">
                        <!-- Course Image -->
                        <div class="w-full md:w-48 h-32 md:h-auto bg-gradient-to-br from-navy-800 to-navy-600 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 p-5">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-navy-900 mb-1">
                                        {{ $enrollment->course->title }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mb-3">
                                        Starts: {{ $enrollment->course->start_date->format('M d, Y') }}
                                    </p>
                                    
                                    <!-- Status Badges -->
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                            {{ $enrollment->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $enrollment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $enrollment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                            <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                                {{ $enrollment->status === 'active' ? 'bg-green-500' : '' }}
                                                {{ $enrollment->status === 'pending' ? 'bg-yellow-500' : '' }}
                                                {{ $enrollment->status === 'cancelled' ? 'bg-red-500' : '' }}"></span>
                                            {{ ucfirst($enrollment->status) }}
                                        </span>
                                        @if($enrollment->payment)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                                {{ $enrollment->payment->status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $enrollment->payment->status === 'pending' ? 'bg-orange-100 text-orange-800' : '' }}
                                                {{ $enrollment->payment->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                                Payment: {{ ucfirst($enrollment->payment->status) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="mt-4 md:mt-0 md:ml-4 flex flex-col items-end gap-2">
                                    <span class="text-xl font-bold text-navy-900">
                                        Rp {{ number_format($enrollment->course->price, 0, ',', '.') }}
                                    </span>
                                    @if($enrollment->status === 'pending' && $enrollment->payment && $enrollment->payment->status === 'pending')
                                        <a href="{{ route('payments.show', $enrollment) }}" 
                                           class="bg-gold-500 text-navy-900 py-2 px-4 rounded-lg text-sm font-medium hover:bg-gold-400 transition">
                                            {{ $enrollment->payment->payment_method ? 'Update Payment' : 'Submit Payment' }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl p-12 text-center shadow-sm border border-gray-100">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-navy-900 mb-2">No courses yet</h3>
                    <p class="text-gray-500 mb-6">Start your learning journey by enrolling in a course.</p>
                    <a href="{{ route('courses.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-navy-900 text-white text-sm font-semibold rounded-lg hover:bg-navy-800 transition">
                        Explore Courses
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            @endforelse

            <div class="mt-6">
                {{ $enrollments->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
