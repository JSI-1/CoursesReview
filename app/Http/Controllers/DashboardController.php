<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    
    public function index(): View
    {
        $reviews = auth()->user()->reviews()
            ->with('course.department')
            ->latest()
            ->paginate(10);
        return view('dashboard', compact('reviews'));
    }
}
