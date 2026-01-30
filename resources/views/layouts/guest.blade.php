<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Unicourse') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex">
            <!-- Left Side - Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-navy-900 via-navy-800 to-navy-700 relative overflow-hidden">
                <!-- Decorative Elements -->
                <div class="absolute top-0 left-0 w-96 h-96 bg-gold-500 rounded-full opacity-10 -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-80 h-80 bg-navy-400 rounded-full opacity-20 translate-x-1/4 translate-y-1/4"></div>
                <div class="absolute top-1/2 left-1/4 w-64 h-64 bg-gold-400 rounded-full opacity-10"></div>
                
                <!-- Content -->
                <div class="relative z-10 flex flex-col justify-center items-center w-full px-12">
                    <a href="{{ route('home') }}" class="mb-8 bg-white rounded-2xl p-4 shadow-lg">
                        <img src="{{ asset('images/logo.png') }}" alt="Unicourse" class="h-16 w-auto">
                    </a>
                    <h1 class="text-4xl font-bold text-white mb-4 text-center">Welcome to Unicourse</h1>
                    <p class="text-navy-200 text-lg text-center max-w-md leading-relaxed">
                        Your gateway to knowledge. Start your learning journey today and unlock your potential.
                    </p>
                    
                    <!-- Features -->
                    <div class="mt-12 space-y-4 max-w-sm">
                        <div class="flex items-center text-white">
                            <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-navy-100">Access to quality courses</span>
                        </div>
                        <div class="flex items-center text-white">
                            <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-navy-100">Learn at your own pace</span>
                        </div>
                        <div class="flex items-center text-white">
                            <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-navy-100">Get certified upon completion</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Form -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-6 py-12 bg-gray-50">
                <!-- Mobile Logo -->
                <div class="lg:hidden mb-8">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Unicourse" class="h-16 w-auto">
                    </a>
                </div>
                
                <div class="w-full max-w-md">
                    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                        {{ $slot }}
                    </div>
                    
                    <!-- Footer -->
                    <p class="mt-8 text-center text-sm text-gray-500">
                        &copy; {{ date('Y') }} Unicourse. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
