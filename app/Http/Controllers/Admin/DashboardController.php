<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function index()
    {
        $stats = [
            'total_courses' => Course::count(),
            'active_courses' => Course::active()->count(),
            'total_enrollments' => Enrollment::count(),
            'active_enrollments' => Enrollment::active()->count(),
            'pending_payments' => Payment::pending()->count(),
            'total_users' => User::where('role', 'user')->count(),
        ];

        $pendingPayments = Payment::pending()
            ->with(['enrollment.user', 'enrollment.course'])
            ->latest()
            ->take(5)
            ->get();

        $recentEnrollments = Enrollment::with(['user', 'course'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'pendingPayments', 'recentEnrollments'));
    }
}
