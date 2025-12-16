@extends('layouts.app')

@section('title', __('messages.edit_review_title'))

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@php
    $isRTL = app()->getLocale() === 'ar';
@endphp

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">{{ __('messages.courses') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('courses.show', $course) }}">{{ $course->translated_name }}</a></li>
                <li class="breadcrumb-item active">{{ __('messages.edit_review_title') }}</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('messages.edit_review_title') }} {{ $isRTL ? 'لـ' : __('messages.for') }} {{ $course->translated_name }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('reviews.update', [$course, $review]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="rating" class="form-label">{{ __('messages.rating') }} <span class="text-danger">*</span></label>
                        <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror" required>
                            <option value="">{{ __('messages.select_rating') }}</option>
                            <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>5 - {{ __('messages.excellent') }}</option>
                            <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>4 - {{ __('messages.very_good') }}</option>
                            <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>3 - {{ __('messages.good') }}</option>
                            <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>2 - {{ __('messages.fair') }}</option>
                            <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>1 - {{ __('messages.poor') }}</option>
                        </select>
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">{{ __('messages.comment') }} <span class="text-danger">*</span></label>
                        <textarea name="comment" 
                                  id="comment" 
                                  class="form-control @error('comment') is-invalid @enderror" 
                                  rows="5" 
                                  required
                                  minlength="10"
                                  maxlength="1000">{{ old('comment', $review->comment) }}</textarea>
                        <small class="form-text text-muted">{{ $isRTL ? 'الحد الأدنى 10 أحرف، الحد الأقصى 1000 حرف.' : 'Minimum 10 characters, maximum 1000 characters.' }}</small>
                        @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">{{ __('messages.attach_file') }} ({{ __('messages.optional') }})</label>
                        @if($review->file_path)
                            <div class="mb-2 p-2 bg-light rounded">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <a href="{{ Storage::url($review->file_path) }}" target="_blank" class="text-decoration-none">
                                            📎 {{ __('messages.current_file') }}: {{ basename($review->file_path) }}
                                        </a>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remove_file" value="1" id="remove_file">
                                        <label class="form-check-label" for="remove_file">
                                            {{ __('messages.remove_file') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <input type="file" 
                               name="file" 
                               id="file" 
                               class="form-control @error('file') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.pdf">
                        <small class="form-text text-muted">{{ __('messages.file_upload_hint') }}</small>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">{{ __('messages.update_review') }}</button>
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
