<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <!-- Course Header -->
        <div class="bg-gradient-to-r from-navy-900 via-navy-800 to-navy-700 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center text-sm text-navy-200 mb-4">
                    <a href="{{ route('courses.index') }}" class="hover:text-white transition">Courses</a>
                    <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-white">{{ Str::limit($course->title, 30) }}</span>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $course->title }}</h1>
                <div class="flex flex-wrap items-center gap-4 text-navy-200">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Starts {{ $course->start_date->format('F d, Y') }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $course->available_quota }} of {{ $course->quota }} slots available
                    </span>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm p-8 mb-6">
                        <h2 class="text-xl font-semibold text-navy-900 mb-4">About this course</h2>
                        <div class="prose max-w-none text-gray-600">
                            <p class="whitespace-pre-line leading-relaxed">{{ $course->description }}</p>
                        </div>
                    </div>

                    <!-- What you'll learn -->
                    <div class="bg-white rounded-xl shadow-sm p-8">
                        <h2 class="text-xl font-semibold text-navy-900 mb-4">What you'll learn</h2>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-600">Practical skills from industry experts</span>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-600">Hands-on projects and exercises</span>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-600">Certificate upon completion</span>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-600">Career advancement opportunities</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar - Enrollment Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24 border border-gray-100">
                        <!-- Price -->
                        <div class="text-center pb-6 border-b border-gray-100">
                            <div class="text-3xl font-bold text-navy-900">
                                Rp {{ number_format($course->price, 0, ',', '.') }}
                            </div>
                            <p class="text-gray-500 text-sm mt-1">Full course access</p>
                        </div>

                        <!-- Enrollment Status -->
                        <div class="py-6">
                            @if($course->isQuotaFull())
                                <div class="bg-red-50 text-red-700 rounded-lg p-4 text-center mb-4">
                                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    <p class="font-medium">Course is full</p>
                                    <p class="text-sm mt-1">No slots available</p>
                                </div>
                            @else
                                <div class="flex items-center justify-center mb-4 text-green-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-medium">{{ $course->available_quota }} slots available</span>
                                </div>
                            @endif

                            @auth
                                @if(!$course->isQuotaFull())
                                    <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-gold-500 text-navy-900 py-3 px-6 rounded-lg font-semibold hover:bg-gold-400 transition">
                                            Enroll Now
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="block w-full bg-navy-900 text-white py-3 px-6 rounded-lg font-semibold hover:bg-navy-800 transition text-center">
                                    Log in to Enroll
                                </a>
                                <p class="text-center text-gray-500 text-sm mt-3">
                                    Don't have an account? <a href="{{ route('register') }}" class="text-navy-900 font-medium hover:underline">Sign up</a>
                                </p>
                            @endauth
                        </div>

                        <!-- Course includes -->
                        <div class="pt-6 border-t border-gray-100">
                            <h4 class="font-semibold text-navy-900 mb-4">This course includes:</h4>
                            <ul class="space-y-3 text-sm text-gray-600">
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-navy-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    Certificate of completion
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-navy-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Flexible schedule
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-navy-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Easy payment options
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
