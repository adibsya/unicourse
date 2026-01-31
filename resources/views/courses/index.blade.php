<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-navy-900 leading-tight">
            {{ __('Explore Courses') }}
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
                <h1 class="text-3xl font-bold text-navy-900 mb-2">All Courses</h1>
                <p class="text-gray-600">Learn from industry experts and advance your career</p>
            </div>

            <!-- Course Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($courses as $course)
                    <!-- Entire card is clickable -->
                    <a href="{{ route('courses.show', $course) }}" 
                       class="block bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group hover:-translate-y-1 cursor-pointer">
                        <!-- Course Image Placeholder -->
                        <div class="h-40 bg-gradient-to-br from-navy-800 to-navy-600 relative overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/30 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <!-- Badge -->
                            <div class="absolute top-3 left-3">
                                <span class="bg-gold-500 text-navy-900 text-xs font-semibold px-2 py-1 rounded">
                                    Course
                                </span>
                            </div>
                            <!-- Hover overlay -->
                            <div class="absolute inset-0 bg-navy-900/0 group-hover:bg-navy-900/20 transition-all duration-300 flex items-center justify-center">
                                <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white/90 text-navy-900 px-4 py-2 rounded-full font-medium text-sm">
                                    View Course →
                                </span>
                            </div>
                        </div>

                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-navy-900 mb-2 group-hover:text-navy-700 transition line-clamp-2">
                                {{ $course->title }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ Str::limit($course->description, 100) }}
                            </p>

                            <!-- Course Meta -->
                            <div class="flex items-center text-sm text-gray-500 mb-4 space-x-4">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $course->start_date->format('M d, Y') }}
                                </span>
                                <span class="flex items-center {{ $course->available_quota > 5 ? 'text-green-600' : ($course->available_quota > 0 ? 'text-yellow-600' : 'text-red-600') }}">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $course->available_quota }} slots
                                </span>
                            </div>

                            <!-- Price & Action -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <span class="text-xl font-bold text-navy-900">
                                    Rp {{ number_format($course->price, 0, ',', '.') }}
                                </span>
                                <span class="bg-navy-900 text-white px-4 py-2 rounded-lg text-sm font-medium group-hover:bg-navy-700 transition">
                                    View Details
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white rounded-xl p-12 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No courses available</h3>
                            <p class="text-gray-500">Check back soon for new courses.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Custom Pagination -->
            @if($courses->hasPages())
                <div class="mt-10 flex justify-center">
                    <nav class="flex items-center gap-2">
                        {{-- Previous Button --}}
                        @if($courses->onFirstPage())
                            <span class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 text-gray-400 cursor-not-allowed">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </span>
                        @else
                            <a href="{{ $courses->previousPageUrl() }}" 
                               class="flex items-center justify-center w-10 h-10 rounded-full bg-white border-2 border-navy-200 text-navy-600 hover:bg-navy-600 hover:text-white hover:border-navy-600 transition-all duration-300 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                            @if($page == $courses->currentPage())
                                <span class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-navy-700 to-navy-900 text-white font-semibold shadow-lg">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" 
                                   class="flex items-center justify-center w-10 h-10 rounded-full bg-white border-2 border-gray-200 text-gray-700 hover:bg-navy-50 hover:border-navy-300 hover:text-navy-700 font-medium transition-all duration-300 shadow-sm hover:shadow-md">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        {{-- Next Button --}}
                        @if($courses->hasMorePages())
                            <a href="{{ $courses->nextPageUrl() }}" 
                               class="flex items-center justify-center w-10 h-10 rounded-full bg-white border-2 border-navy-200 text-navy-600 hover:bg-navy-600 hover:text-white hover:border-navy-600 transition-all duration-300 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @else
                            <span class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 text-gray-400 cursor-not-allowed">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </span>
                        @endif
                    </nav>
                </div>

                <!-- Page Info -->
                <div class="mt-4 text-center text-sm text-gray-500">
                    Showing {{ $courses->firstItem() }} - {{ $courses->lastItem() }} of {{ $courses->total() }} courses
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
