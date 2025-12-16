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
                    <div class="card-body d-flex flex-column position-relative">
                        <!-- Decorative gradient overlay -->
                        <div class="position-absolute top-0 end-0" style="width: 100px; height: 100px; background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, transparent 100%); border-radius: 0 16px 0 100px; pointer-events: none;"></div>
                        
                        <div class="mb-3 d-flex justify-content-between align-items-start position-relative">
                            <div>
                                <span class="badge bg-primary mb-2 px-3 py-2">{{ $course->code }}</span>
                                <span class="badge bg-secondary d-block px-3 py-2">{{ $course->department->translated_name }}</span>
                            </div>
                            @if($course->reviews_avg_rating)
                                <div class="text-center rating-display p-2 rounded" style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 193, 7, 0.05) 100%); min-width: 80px;">
                                    <div class="text-warning mb-1" style="font-size: 1.2rem; filter: drop-shadow(0 2px 4px rgba(255, 193, 7, 0.3));">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($course->reviews_avg_rating))
                                                <span>★</span>
                                            @else
                                                <span>☆</span>
                                            @endif
                                        @endfor
                                    </div>
                                    <small class="text-primary fw-bold d-block" style="font-size: 0.9rem;">{{ number_format($course->reviews_avg_rating, 1) }}/5</small>
                                </div>
                            @endif
                        </div>
                        <h5 class="card-title mb-3 fw-bold position-relative" style="min-height: 3rem; line-height: 1.4; font-size: 1.25rem; color: #1e293b;">{{ $course->translated_name }}</h5>
                        @if($course->translated_description)
                            <p class="card-text small text-muted flex-grow-1 mb-3 position-relative" style="line-height: 1.7; color: #64748b;">{{ Str::limit($course->translated_description, 100) }}</p>
                        @endif
                        <div class="mt-auto pt-3 border-top position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                @if($course->reviews_avg_rating)
                                    <small class="text-muted d-flex align-items-center">
                                        <span style="margin-{{ $isRTL ? 'left' : 'right' }}: 0.25rem;">💬</span>
                                        {{ trans_choice('messages.review_count', $course->reviews_count, ['count' => $course->reviews_count]) }}
                                    </small>
                                @else
                                    <small class="text-muted">{{ __('messages.no_reviews_yet') }}</small>
                                @endif
                                <small class="text-muted d-flex align-items-center">
                                    <span style="margin-{{ $isRTL ? 'left' : 'right' }}: 0.25rem;">📖</span>
                                    <strong>{{ $course->credits }}</strong> {{ __('messages.credits') }}
                                </small>
                            </div>
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                                <span>{{ __('messages.view_details') }}</span>
                                <span style="margin-{{ $isRTL ? 'right' : 'left' }}: 0.5rem; transition: transform 0.3s ease;">{{ $isRTL ? '←' : '→' }}</span>
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
