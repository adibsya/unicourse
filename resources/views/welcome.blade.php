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
    <!-- Navigation - Modern Design -->
    <nav x-data="{ open: false, scrolled: false }" 
         @scroll.window="scrolled = window.scrollY > 20"
         :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-lg' : 'bg-white'"
         class="border-b border-gray-200 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex items-center group">
                        <div class="bg-white rounded-xl p-2 shadow-md group-hover:shadow-lg transition-shadow duration-300">
                            <img src="{{ asset('images/logo.png') }}" alt="Unicourse" class="h-10 w-auto">
                        </div>
                    </a>
                    
                    <!-- Navigation Links -->
                    <div class="hidden md:flex ml-8 space-x-1">
                        <a href="{{ route('home') }}" 
                           class="group inline-flex items-center px-4 py-2 text-sm font-medium rounded-full bg-navy-100 text-navy-900 transition-all duration-300">
                            <svg class="w-4 h-4 mr-2 text-navy-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Home
                        </a>
                        <a href="{{ route('courses.index') }}" 
                           class="group inline-flex items-center px-4 py-2 text-sm font-medium rounded-full text-gray-600 hover:bg-gray-100 hover:text-navy-900 transition-all duration-300">
                            <svg class="w-4 h-4 mr-2 text-gray-400 group-hover:text-navy-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            Explore Courses
                        </a>
                        @auth
                            <a href="{{ route('my-courses') }}" 
                               class="group inline-flex items-center px-4 py-2 text-sm font-medium rounded-full text-gray-600 hover:bg-gray-100 hover:text-navy-900 transition-all duration-300">
                                <svg class="w-4 h-4 mr-2 text-gray-400 group-hover:text-navy-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"></path>
                                </svg>
                                My Learning
                            </a>
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="group inline-flex items-center px-4 py-2 text-sm font-medium rounded-full bg-gradient-to-r from-gold-100 to-gold-50 text-gold-800 hover:from-gold-200 hover:to-gold-100 transition-all duration-300">
                                    <svg class="w-4 h-4 mr-2 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    Admin
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                <!-- Right Side -->
                <div class="hidden sm:flex items-center gap-3">
                    @auth
                        <!-- Notification Bell -->
                        <button type="button" class="relative p-2 text-gray-500 hover:text-navy-600 hover:bg-gray-100 rounded-full transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                        </button>

                        <!-- User Dropdown -->
                        <div x-data="{ userOpen: false }" class="relative">
                            <button type="button" @click="userOpen = !userOpen" 
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-full bg-gradient-to-r from-navy-50 to-navy-100 text-navy-900 hover:from-navy-100 hover:to-navy-200 focus:outline-none transition-all duration-300 shadow-sm hover:shadow">
                                <span class="w-8 h-8 rounded-full bg-gradient-to-br from-navy-700 to-navy-900 text-white flex items-center justify-center mr-2 text-sm font-semibold shadow-inner">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </span>
                                <span class="max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                                <svg class="ms-2 h-4 w-4 text-gray-400 transition-transform" :class="{ 'rotate-180': userOpen }" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            
                            <div x-show="userOpen" 
                                 @click.away="userOpen = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden z-50">
                                <div class="px-4 py-3 bg-gradient-to-r from-navy-50 to-gray-50 border-b">
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profile
                                </a>
                                <a href="{{ route('my-courses') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    My Courses
                                </a>
                                <div class="border-t"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Guest Links -->
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-navy-900 hover:text-navy-700 rounded-full hover:bg-gray-100 transition-all duration-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Log In
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center bg-gradient-to-r from-navy-800 to-navy-900 text-white px-5 py-2.5 rounded-full font-medium hover:from-navy-700 hover:to-navy-800 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Join for Free
                        </a>
                    @endauth
                </div>

                <!-- Mobile Hamburger -->
                <div class="flex items-center sm:hidden">
                    <button type="button" @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-navy-900 hover:bg-gray-100 focus:outline-none transition-all duration-300">
                        <svg class="h-6 w-6 transition-transform duration-300" :class="{ 'rotate-90': open }" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="sm:hidden bg-white border-t shadow-lg">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="flex items-center px-4 py-3 text-base font-medium bg-navy-50 text-navy-900 border-l-4 border-navy-600">
                    <svg class="w-5 h-5 mr-3 text-navy-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Home
                </a>
                <a href="{{ route('courses.index') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-600 hover:text-navy-900 hover:bg-navy-50">
                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Explore Courses
                </a>
                @auth
                    <a href="{{ route('my-courses') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-600 hover:text-navy-900 hover:bg-navy-50">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"></path>
                        </svg>
                        My Learning
                    </a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-base font-medium text-gold-800 bg-gold-50 hover:bg-gold-100">
                            <svg class="w-5 h-5 mr-3 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            Admin Panel
                        </a>
                    @endif
                @endauth
            </div>
            @auth
                <div class="pt-4 pb-4 border-t border-gray-200 bg-gradient-to-r from-navy-50 to-gray-50">
                    <div class="px-4 flex items-center">
                        <span class="w-12 h-12 rounded-full bg-gradient-to-br from-navy-700 to-navy-900 text-white flex items-center justify-center mr-3 font-semibold text-lg shadow-lg">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </span>
                        <div>
                            <div class="font-semibold text-base text-navy-900">{{ Auth::user()->name }}</div>
                            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <div class="mt-4 px-4 space-y-2">
                        <a href="{{ route('profile.edit') }}" class="flex items-center py-2 px-3 text-base font-medium text-gray-700 hover:text-navy-900 hover:bg-white rounded-lg">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Edit Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center py-2 px-3 text-base font-medium text-red-600 hover:bg-red-50 rounded-lg">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="pt-4 pb-4 border-t border-gray-200 px-4 space-y-3 bg-gray-50">
                    <a href="{{ route('login') }}" class="flex w-full items-center justify-center py-3 text-navy-900 font-medium border-2 border-navy-200 rounded-xl hover:bg-navy-50">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Log In
                    </a>
                    <a href="{{ route('register') }}" class="flex w-full items-center justify-center py-3 bg-gradient-to-r from-navy-800 to-navy-900 text-white font-medium rounded-xl shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Join for Free
                    </a>
                </div>
            @endauth
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
                    <div class="bg-white rounded-2xl p-3 shadow-lg inline-block mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Unicourse" class="h-12 w-auto">
                    </div>
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
