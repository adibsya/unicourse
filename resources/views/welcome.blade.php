<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Unicourse') }} - Your Gateway to Knowledge</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-white">
    <!-- Navigation - Coursera Style -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-24">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Unicourse" class="h-14 w-auto">
                    </a>
                    <div class="hidden md:flex ml-10 space-x-8">
                        <a href="{{ route('courses.index') }}" class="text-gray-600 hover:text-navy-900 font-medium transition">
                            Explore Courses
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('my-courses') }}" class="text-gray-600 hover:text-navy-900 font-medium">My Courses</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-navy-900 font-medium">Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-navy-900 font-medium">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-navy-900 hover:text-navy-700 font-medium">Log In</a>
                        <a href="{{ route('register') }}" class="bg-navy-900 text-white px-5 py-2.5 rounded-md font-medium hover:bg-navy-800 transition">
                            Join for Free
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section - Coursera Inspired -->
    <div class="relative bg-gradient-to-r from-navy-900 via-navy-800 to-navy-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.4\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28 relative">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gold-500 text-navy-900 mb-6">
                        🎓 Start Learning Today
                    </span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                        Learn without limits
                    </h1>
                    <p class="text-lg md:text-xl text-navy-100 mb-8 leading-relaxed">
                        Build skills with courses from the best instructors. Start learning today with flexible schedules and affordable prices.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('courses.index') }}" class="inline-flex items-center justify-center bg-white text-navy-900 px-8 py-3.5 rounded-md font-semibold hover:bg-gray-100 transition text-center">
                            Explore Courses
                        </a>
                        @guest
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center bg-gold-500 text-navy-900 px-8 py-3.5 rounded-md font-semibold hover:bg-gold-400 transition text-center">
                                Join for Free
                            </a>
                        @endguest
                    </div>
                </div>
                <div class="hidden md:block">
                        <div class="relative">
                            <img src="{{ asset('images/hero.png') }}" alt="Learning" class="relative rounded-2xl shadow-2xl w-full max-w-md mx-auto transform hover:scale-105 transition duration-500">
                        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-white py-12 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-navy-900">5+</div>
                    <div class="text-gray-600 mt-1">Courses</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-navy-900">Expert</div>
                    <div class="text-gray-600 mt-1">Instructors</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-navy-900">24/7</div>
                    <div class="text-gray-600 mt-1">Support</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-navy-900">100%</div>
                    <div class="text-gray-600 mt-1">Verified</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-navy-900 mb-4">Why learn with Unicourse?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">World-class learning experience with industry-recognized certifications</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-lg transition border border-gray-100">
                    <div class="w-14 h-14 bg-navy-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-navy-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-navy-900 mb-3">Learn from Experts</h3>
                    <p class="text-gray-600 leading-relaxed">Get taught by industry professionals with years of real-world experience in their fields.</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-lg transition border border-gray-100">
                    <div class="w-14 h-14 bg-gold-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-navy-900 mb-3">Flexible Schedule</h3>
                    <p class="text-gray-600 leading-relaxed">Learn at your own pace with courses designed to fit your busy lifestyle and schedule.</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-lg transition border border-gray-100">
                    <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-navy-900 mb-3">Get Certified</h3>
                    <p class="text-gray-600 leading-relaxed">Earn certificates upon completion to showcase your skills to employers worldwide.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-navy-900 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-navy-800 to-navy-700 rounded-2xl p-12 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-gold-500 rounded-full opacity-10 -translate-y-1/2 translate-x-1/2"></div>
                <div class="relative">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Ready to start learning?</h2>
                    <p class="text-navy-200 mb-8 text-lg max-w-xl mx-auto">Join thousands of learners who have transformed their careers with Unicourse.</p>
                    <a href="{{ route('courses.index') }}" class="inline-flex items-center bg-gold-500 text-navy-900 px-8 py-3.5 rounded-md font-semibold hover:bg-gold-400 transition">
                        Browse All Courses
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-navy-950 text-gray-400 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <div class="col-span-2 md:col-span-1">
                    <img src="{{ asset('images/logo.png') }}" alt="Unicourse" class="h-16 w-auto mb-4">
                    <p class="text-sm leading-relaxed">Your gateway to knowledge. Learn new skills, advance your career, and achieve your goals.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Explore</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('courses.index') }}" class="hover:text-white transition">All Courses</a></li>
                        <li><a href="#" class="hover:text-white transition">Categories</a></li>
                        <li><a href="#" class="hover:text-white transition">Instructors</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition">Careers</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-navy-800 pt-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} Unicourse. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Chatbot -->
    @include('components.chatbot')
</body>
</html>
