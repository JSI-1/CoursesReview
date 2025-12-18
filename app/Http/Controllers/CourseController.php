<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
   
    public function index(Request $request): View
    {
        $query = Course::with('department');

        if ($request->department) {
            $query->where('department_id', $request->department);
        }

        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $courses = $query->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->latest()
            ->paginate(12);

        return view('courses.index', [
            'courses' => $courses,
            'departments' => Department::orderBy('name')->get()
        ]);
    }

   
    public function show(Course $course): View
    {
        $course->load('department');
        
        $averageRating = $course->reviews()->avg('rating') ?? 0;
        $reviews = $course->reviews()->with('user')->latest()->paginate(10);
        $userReview = auth()->check() 
            ? $course->reviews()->where('user_id', auth()->id())->first() 
            : null;

        return view('courses.show', [
            'course' => $course,
            'averageRating' => $averageRating,
            'reviewsCount' => $course->reviews()->count(),
            'reviews' => $reviews,
            'userReview' => $userReview
        ]);
    }
}
