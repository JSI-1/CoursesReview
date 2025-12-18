<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
     
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'min:10', 'max:1000'],
            'file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'], // 5MB max
        ];
    }
    public function messages(): array
    {
        return [
            'rating.required' => 'Please select a rating.',
            'rating.integer' => 'Rating must be a number.',
            'rating.min' => 'Rating must be at least 1.',
            'rating.max' => 'Rating cannot be more than 5.',
            'comment.required' => 'Please write a comment.',
            'comment.min' => 'Comment must be at least 10 characters.',
            'comment.max' => 'Comment cannot exceed 1000 characters.',
            'file.file' => 'The uploaded file is invalid.',
            'file.mimes' => 'The file must be a jpg, png, or pdf.',
            'file.max' => 'The file size must not exceed 5MB.',
        ];
    }
}
