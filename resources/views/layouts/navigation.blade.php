<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Unicourse" class="h-10 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-8 sm:flex">
                    <a href="{{ route('courses.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-600 hover:text-navy-900 transition {{ request()->routeIs('courses.*') ? 'text-navy-900 border-b-2 border-navy-900' : '' }}">
                        Explore
                    </a>
                    @auth
                        <a href="{{ route('my-courses') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-600 hover:text-navy-900 transition {{ request()->routeIs('my-courses') ? 'text-navy-900 border-b-2 border-navy-900' : '' }}">
                            My Learning
                        </a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-600 hover:text-navy-900 transition">
                                Admin
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <!-- Settings Dropdown (Logged In) -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-full text-navy-900 bg-navy-50 hover:bg-navy-100 focus:outline-none transition">
                                <span class="w-8 h-8 rounded-full bg-navy-900 text-white flex items-center justify-center mr-2 text-sm font-semibold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </span>
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- Guest Links -->
                    <a href="{{ route('login') }}" class="text-navy-900 hover:text-navy-700 font-medium mr-4">Log In</a>
                    <a href="{{ route('register') }}" class="bg-navy-900 text-white px-5 py-2.5 rounded-md font-medium hover:bg-navy-800 transition">
                        Join for Free
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-navy-900 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 bg-white border-t">
            <a href="{{ route('courses.index') }}" class="block px-4 py-2 text-base font-medium text-gray-600 hover:text-navy-900 hover:bg-gray-50">
                Explore
            </a>
            @auth
                <a href="{{ route('my-courses') }}" class="block px-4 py-2 text-base font-medium text-gray-600 hover:text-navy-900 hover:bg-gray-50">
                    My Learning
                </a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-base font-medium text-gray-600 hover:text-navy-900 hover:bg-gray-50">
                        Admin
                    </a>
                @endif
            @endauth
        </div>

        @auth
            <!-- Responsive Settings Options (Logged In) -->
            <div class="pt-4 pb-1 border-t border-gray-200 bg-gray-50">
                <div class="px-4 flex items-center">
                    <span class="w-10 h-10 rounded-full bg-navy-900 text-white flex items-center justify-center mr-3 font-semibold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </span>
                    <div>
                        <div class="font-medium text-base text-navy-900">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-base font-medium text-gray-600 hover:text-navy-900 hover:bg-white">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-gray-600 hover:text-navy-900 hover:bg-white">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Guest Links (Mobile) -->
            <div class="pt-4 pb-4 border-t border-gray-200 px-4 space-y-2">
                <a href="{{ route('login') }}" class="block w-full text-center py-2 text-navy-900 font-medium border border-navy-900 rounded-md hover:bg-navy-50">
                    Log In
                </a>
                <a href="{{ route('register') }}" class="block w-full text-center py-2 bg-navy-900 text-white font-medium rounded-md hover:bg-navy-800">
                    Join for Free
                </a>
            </div>
        @endauth
    </div>
</nav>
