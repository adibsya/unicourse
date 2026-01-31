<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-navy-900">Dashboard</h1>
        <p class="text-gray-600">Welcome back! Here's an overview of your platform.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Courses</p>
                    <p class="text-3xl font-bold text-navy-900 mt-1">{{ $stats['total_courses'] }}</p>
                </div>
                <div class="p-3 rounded-xl bg-navy-100">
                    <svg class="w-6 h-6 text-navy-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Active Enrollments</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $stats['active_enrollments'] }}</p>
                </div>
                <div class="p-3 rounded-xl bg-green-100">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pending Payments</p>
                    <p class="text-3xl font-bold text-gold-600 mt-1">{{ $stats['pending_payments'] }}</p>
                </div>
                <div class="p-3 rounded-xl bg-gold-100">
                    <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Users</p>
                    <p class="text-3xl font-bold text-navy-900 mt-1">{{ $stats['total_users'] ?? \App\Models\User::count() }}</p>
                </div>
                <div class="p-3 rounded-xl bg-gray-100">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Pending Payments -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-navy-900">Pending Payments</h2>
                <a href="{{ route('admin.payments.index') }}?status=pending" class="text-sm text-navy-600 hover:text-navy-800 font-medium inline-flex items-center">View all <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
            </div>
            <div class="p-6">
                @forelse($pendingPayments as $payment)
                    <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-b-0">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-navy-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-navy-900 font-semibold text-sm">{{ substr($payment->enrollment->user->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-navy-900">{{ $payment->enrollment->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $payment->enrollment->course->title }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-navy-900">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                            <a href="{{ route('admin.payments.show', $payment) }}" class="text-sm text-gold-600 hover:text-gold-700 font-medium">Review</a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500">All payments verified!</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Enrollments -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-navy-900">Recent Enrollments</h2>
                <a href="{{ route('admin.enrollments.index') }}" class="text-sm text-navy-600 hover:text-navy-800 font-medium inline-flex items-center">View all <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
            </div>
            <div class="p-6">
                @forelse($recentEnrollments as $enrollment)
                    <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-b-0">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-navy-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-navy-900 font-semibold text-sm">{{ substr($enrollment->user->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-navy-900">{{ $enrollment->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $enrollment->course->title }}</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                            {{ $enrollment->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $enrollment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $enrollment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($enrollment->status) }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <p class="text-gray-500">No enrollments yet</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>
