<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display user's enrollments (my courses).
     */
    public function index()
    {
        $enrollments = auth()->user()->enrollments()
            ->with(['course', 'payment'])
            ->latest()
            ->paginate(10);

        return view('enrollments.index', compact('enrollments'));
    }

    /**
     * Enroll user in a course.
     */
    public function store(Course $course)
    {
        $user = auth()->user();

        // Check if already enrolled
        $existingEnrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You are already enrolled in this course.');
        }

        // Check quota
        if ($course->isQuotaFull()) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'Sorry, this course is full. No available slots.');
        }

        // Create enrollment
        $enrollment = Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'pending',
        ]);

        // Create pending payment
        Payment::create([
            'enrollment_id' => $enrollment->id,
            'amount' => $course->price,
            'payment_method' => '',
            'status' => 'pending',
        ]);

        return redirect()->route('my-courses')
            ->with('success', 'Successfully enrolled! Please complete your payment.');
    }

    /**
     * Cancel enrollment.
     */
    public function destroy(Enrollment $enrollment)
    {
        // Ensure user owns this enrollment
        if ($enrollment->user_id !== auth()->id()) {
            abort(403);
        }

        // Only allow cancellation if pending
        if ($enrollment->status !== 'pending') {
            return back()->with('error', 'Cannot cancel this enrollment.');
        }

        $enrollment->update(['status' => 'cancelled']);

        return redirect()->route('my-courses')
            ->with('success', 'Enrollment cancelled.');
    }
}
