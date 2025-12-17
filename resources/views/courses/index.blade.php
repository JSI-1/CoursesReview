@extends('layouts.app')

@section('title', __('messages.courses'))

@php
    $isRTL = app()->getLocale() === 'ar';
@endphp

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="h2 mb-4">{{ __('messages.courses') }}</h1>
        
        <!-- Search and Filter Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">{{ __('messages.search') }} & {{ __('messages.filter') }}</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('courses.index') }}" class="row g-3">
                    <div class="col-md-6">
                        <label for="search" class="form-label">{{ __('messages.search') }}</label>
                        <input type="text" 
                               id="search"
                               name="search" 
                               class="form-control" 
                               placeholder="{{ __('messages.search_placeholder') }}"
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="department" class="form-label">{{ __('messages.department') }}</label>
                        <select name="department" id="department" class="form-select">
                            <option value="">{{ __('messages.all_departments') }}</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ request('department') == $department->id ? 'selected' : '' }}>
                                    {{ $department->translated_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">{{ __('messages.search') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if($courses->count() > 0)
    <div class="row">
        @foreach($courses as $course)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 course-card">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-3 d-flex justify-content-between align-items-start">
                            <div>
                                <span class="badge bg-primary mb-2 px-3 py-2">{{ $course->code }}</span>
                                <span class="badge bg-secondary d-block px-3 py-2">{{ $course->department->translated_name }}</span>
                            </div>
                            @if($course->reviews_avg_rating)
                                <div class="text-center p-2 rounded bg-tertiary">
                                    <div class="mb-1 rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($course->reviews_avg_rating))
                                                <span class="star-filled">★</span>
                                            @else
                                                <span class="star-empty">☆</span>
                                            @endif
                                        @endfor
                                    </div>
                                    <small class="text-primary fw-bold d-block">{{ number_format($course->reviews_avg_rating, 1) }}/5</small>
                                </div>
                            @endif
                        </div>
                        <h5 class="card-title mb-3 fw-bold">{{ $course->translated_name }}</h5>
                        @if($course->translated_description)
                            <p class="card-text flex-grow-1 mb-3">{{ Str::limit($course->translated_description, 100) }}</p>
                        @endif
                        <div class="mt-auto pt-3 border-top">
                            <div class="d-flex justify-content-between align-items-center mb-3 course-metadata">
                                @if($course->reviews_avg_rating)
                                    <small class="course-meta-item">
                                        <span class="course-meta-icon">💬</span>
                                        <span class="course-meta-text">{{ trans_choice('messages.review_count', $course->reviews_count, ['count' => $course->reviews_count]) }}</span>
                                    </small>
                                @else
                                    <small class="course-meta-item">{{ __('messages.no_reviews_yet') }}</small>
                                @endif
                                <small class="course-meta-item">
                                    <span class="course-meta-icon">📖</span>
                                    <strong class="course-meta-number">{{ $course->credits }}</strong>
                                    <span class="course-meta-text">{{ __('messages.credits') }}</span>
                                </small>
                            </div>
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                                <span>{{ __('messages.view_details') }}</span>
                                <span class="{{ $isRTL ? 'ms-2' : 'me-2' }}">{{ $isRTL ? '←' : '→' }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $courses->links() }}
    </div>
@else
    <div class="alert alert-info">
        <h5>{{ __('messages.no_courses_found') }}</h5>
        <p class="mb-0">{{ __('messages.try_adjusting') }}</p>
    </div>
@endif
@endsection
