<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     */
    public function store(StoreReviewRequest $request, Course $course): RedirectResponse
    {
        // Prevent duplicate reviews
        if ($course->reviews()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You have already reviewed this course.');
        }

        $filePath = null;
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('feedback', $fileName, 'public');
        }

        $course->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'file_path' => $filePath,
        ]);

        return redirect()->route('courses.show', $course)
            ->with('success', 'Review submitted successfully!');
    }

    /**
     * Show the form for editing the specified review.
     */
    public function edit(Course $course, Review $review)
    {
        Gate::authorize('update', $review);
        return view('reviews.edit', compact('course', 'review'));
    }

    /**
     * Update the specified review in storage.
     */
    public function update(UpdateReviewRequest $request, Course $course, Review $review): RedirectResponse
    {
        Gate::authorize('update', $review);
        
        $data = $request->validated();
        
        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($review->file_path && Storage::disk('public')->exists($review->file_path)) {
                Storage::disk('public')->delete($review->file_path);
            }
            
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $data['file_path'] = $file->storeAs('feedback', $fileName, 'public');
        } elseif ($request->has('remove_file') && $request->remove_file == '1') {
            // Remove file if user wants to delete it
            if ($review->file_path && Storage::disk('public')->exists($review->file_path)) {
                Storage::disk('public')->delete($review->file_path);
            }
            $data['file_path'] = null;
        }
        
        // Remove 'file' and 'remove_file' from data array as they're not database columns
        unset($data['file']);
        if (isset($data['remove_file'])) {
            unset($data['remove_file']);
        }
        
        $review->update($data);
        
        return redirect()->route('courses.show', $course)
            ->with('success', 'Review updated successfully!');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Course $course, Review $review): RedirectResponse
    {
        Gate::authorize('delete', $review);

        // Delete associated file if exists
        if ($review->file_path && Storage::disk('public')->exists($review->file_path)) {
            Storage::disk('public')->delete($review->file_path);
        }

        $review->delete();

        return redirect()->route('courses.show', $course)
            ->with('success', 'Review deleted successfully!');
    }
}
