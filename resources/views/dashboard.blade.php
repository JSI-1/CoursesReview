@extends('layouts.app')

@section('title', __('messages.dashboard'))

@php
    $isRTL = app()->getLocale() === 'ar';
@endphp

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="h2 mb-4">{{ __('messages.dashboard') }}</h1>
        <p class="lead">{{ $isRTL ? 'مرحباً بعودتك' : 'Welcome back' }}, {{ auth()->user()->name }}!</p>

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0 d-flex align-items-center">
                    <span style="margin-{{ $isRTL ? 'left' : 'right' }}: 0.5rem; font-size: 1.5rem;">📝</span>
                    {{ __('messages.my_reviews') }}
                </h5>
            </div>
            <div class="card-body">
                @if($reviews->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('messages.courses') }}</th>
                                    <th>{{ __('messages.department') }}</th>
                                    <th>{{ __('messages.rating') }}</th>
                                    <th>{{ __('messages.comment') }}</th>
                                    <th>{{ $isRTL ? 'التاريخ' : 'Date' }}</th>
                                    <th>{{ $isRTL ? 'الإجراءات' : 'Actions' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                    <tr>
                                        <td>
                                            <a href="{{ route('courses.show', $review->course) }}" class="text-decoration-none fw-semibold">
                                                {{ $review->course->translated_name }}
                                            </a>
                                        </td>
                                        <td><span class="badge bg-secondary">{{ $review->course->department->translated_name }}</span></td>
                                        <td>
                                            <div class="text-warning">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        ★
                                                    @else
                                                        ☆
                                                    @endif
                                                @endfor
                                            </div>
                                        </td>
                                        <td>{{ Str::limit($review->comment, 50) }}</td>
                                        <td><small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small></td>
                                        <td>
                                            <a href="{{ route('reviews.edit', [$review->course, $review]) }}" class="btn btn-sm btn-outline-primary">{{ __('messages.edit') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $reviews->links() }}
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        <p class="mb-2">{{ $isRTL ? 'لم تكتب أي مراجعات بعد.' : "You haven't written any reviews yet." }}</p>
                        <a href="{{ route('courses.index') }}" class="btn btn-primary">{{ __('messages.courses') }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
