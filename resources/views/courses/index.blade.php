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
                <div class="card h-100 shadow-sm course-card">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-3 d-flex justify-content-between align-items-start">
                            <div>
                                <span class="badge bg-primary mb-2">{{ $course->code }}</span>
                                <span class="badge bg-secondary d-block">{{ $course->department->translated_name }}</span>
                            </div>
                            @if($course->reviews_avg_rating)
                                <div class="text-center">
                                    <div class="text-warning mb-1" style="font-size: 1.1rem;">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($course->reviews_avg_rating))
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </div>
                                    <small class="text-muted d-block">{{ number_format($course->reviews_avg_rating, 1) }}</small>
                                </div>
                            @endif
                        </div>
                        <h5 class="card-title mb-3 fw-bold" style="min-height: 3rem; line-height: 1.4;">{{ $course->name }}</h5>
                        @if($course->description)
                            <p class="card-text small text-muted flex-grow-1 mb-3" style="line-height: 1.6;">{{ Str::limit($course->description, 100) }}</p>
                        @endif
                        <div class="mt-auto pt-3 border-top">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                @if($course->reviews_avg_rating)
                                    <small class="text-muted">
                                        <strong>{{ $course->reviews_count }}</strong> {{ trans_choice('messages.review_count', $course->reviews_count) }}
                                    </small>
                                @else
                                    <small class="text-muted">{{ __('messages.no_reviews_yet') }}</small>
                                @endif
                                <small class="text-muted"><strong>{{ $course->credits }}</strong> {{ __('messages.credits') }}</small>
                            </div>
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-primary w-100">{{ __('messages.view_details') }} {{ $isRTL ? '←' : '→' }}</a>
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
