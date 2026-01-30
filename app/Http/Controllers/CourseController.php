<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of available courses.
     */
    public function index()
    {
        $courses = Course::active()
            ->orderBy('start_date')
            ->paginate(12);

        return view('courses.index', compact('courses'));
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }
}
