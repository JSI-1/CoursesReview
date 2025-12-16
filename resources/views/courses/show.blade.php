@extends('layouts.app')

@section('title', $course->translated_name)

@php
    $isRTL = app()->getLocale() === 'ar';
    use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">{{ __('messages.courses') }}</a></li>
                <li class="breadcrumb-item active">{{ $course->translated_name }}</li>
            </ol>
        </nav>

        <!-- Course Information -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="flex-grow-1">
                        <h1 class="h2 mb-2">{{ $course->translated_name }}</h1>
                        <div class="d-flex gap-2 mb-3">
                            <span class="badge bg-primary">{{ $course->code }}</span>
                            <span class="badge bg-secondary">{{ $course->department->translated_name }}</span>
                            <span class="badge bg-info text-white">{{ $course->credits }} {{ __('messages.credits') }}</span>
                        </div>
                    </div>
                        @if($averageRating > 0)
                        <div class="text-center ms-4 p-3 rounded" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%); min-width: 150px;">
                            <div class="text-warning fs-3 mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($averageRating))
                                            ★
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </div>
                            <div class="fw-bold fs-5 text-primary">{{ number_format($averageRating, 1) }}/5.0</div>
                            <small class="text-muted">{{ trans_choice('messages.review_count', $reviewsCount, ['count' => $reviewsCount]) }}</small>
                            </div>
                        @endif
                </div>
                @if($course->translated_description)
                    <div class="mt-4 p-3 rounded" style="background: #f8fafc; {{ $isRTL ? 'border-right' : 'border-left' }}: 4px solid var(--primary-color);">
                        <h5 class="mb-2">{{ __('messages.description') }}</h5>
                        <p class="mb-0" style="line-height: 1.7;">{{ $course->translated_description }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Review Form (for authenticated users who haven't reviewed) -->
        @auth
            @if(!$userReview)
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0 d-flex align-items-center">
                            <span style="margin-{{ $isRTL ? 'left' : 'right' }}: 0.5rem; font-size: 1.5rem;">✍️</span>
                            {{ __('messages.write_review') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('reviews.store', $course) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="rating" class="form-label">{{ __('messages.rating') }} <span class="text-danger">*</span></label>
                                <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror" required>
                                    <option value="">{{ __('messages.select_rating') }}</option>
                                    <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>5 - {{ __('messages.excellent') }}</option>
                                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 - {{ __('messages.very_good') }}</option>
                                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 - {{ __('messages.good') }}</option>
                                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 - {{ __('messages.fair') }}</option>
                                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 - {{ __('messages.poor') }}</option>
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
                                          maxlength="1000">{{ old('comment') }}</textarea>
                                <small class="form-text text-muted">{{ $isRTL ? 'الحد الأدنى 10 أحرف، الحد الأقصى 1000 حرف.' : 'Minimum 10 characters, maximum 1000 characters.' }}</small>
                                @error('comment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">{{ __('messages.attach_file') }} ({{ __('messages.optional') }})</label>
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
                            <button type="submit" class="btn btn-primary">{{ __('messages.submit_review') }}</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-info mb-4">
                    <strong>{{ __('messages.already_reviewed') }}</strong>
                    <a href="{{ route('reviews.edit', [$course, $userReview]) }}" class="btn btn-sm btn-outline-primary {{ $isRTL ? 'me-2' : 'ms-2' }}">{{ __('messages.edit_review') }}</a>
                </div>
            @endif
        @else
            <div class="alert alert-warning mb-4">
                <strong>{{ __('messages.please_login') }} <a href="{{ route('login') }}">{{ __('messages.login') }}</a> {{ __('messages.or') }} <a href="{{ route('register') }}">{{ __('messages.register') }}</a> {{ __('messages.to_write_review') }}</strong>
            </div>
        @endauth

        <!-- Reviews List -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0 d-flex align-items-center">
                    <span style="margin-{{ $isRTL ? 'left' : 'right' }}: 0.5rem; font-size: 1.5rem;">💬</span>
                    {{ __('messages.reviews') }} ({{ $reviewsCount }})
                </h5>
            </div>
            <div class="card-body">
                @if($reviews->count() > 0)
                    @foreach($reviews as $review)
                        <div class="border-bottom pb-3 mb-3 review-item">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center {{ $isRTL ? 'ms-3' : 'me-3' }}" style="width: 45px; height: 45px; font-weight: 700; font-size: 1.1rem; flex-shrink: 0;">
                                        {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                    </div>
                                    <div class="{{ $isRTL ? 'text-right' : 'text-left' }}">
                                        <strong class="d-block mb-1">{{ $review->user->name }}</strong>
                                        <span class="text-muted small">{{ $review->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <p class="mb-2 {{ $isRTL ? 'pe-5' : 'ps-5' }}">{{ $review->comment }}</p>
                            @if($review->file_path)
                                <div class="mb-2 {{ $isRTL ? 'pe-5' : 'ps-5' }}">
                                    <a href="{{ Storage::url($review->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        📎 {{ __('messages.view_file') }}: {{ basename($review->file_path) }}
                                    </a>
                                </div>
                            @endif
                            @auth
                                @if(auth()->id() === $review->user_id)
                                    <div class="mt-3 {{ $isRTL ? 'pe-5' : 'ps-5' }}">
                                        <a href="{{ route('reviews.edit', [$course, $review]) }}" class="btn btn-sm btn-outline-secondary {{ $isRTL ? 'ms-2' : 'me-2' }}">
                                            ✏️ {{ __('messages.edit') }}
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $review->id }}">
                                            🗑️ {{ __('messages.delete') }}
                                        </button>
                                    </div>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal{{ $review->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $review->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $review->id }}">
                                                        ⚠️ {{ __('messages.confirm_delete') }}
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="{{ __('messages.close') }}"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="mb-3">{{ __('messages.delete_review_confirm') }}</p>
                                                    <div class="alert alert-light border">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-warning me-2">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    @if($i <= $review->rating)
                                                                        ★
                                                                    @else
                                                                        ☆
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                            <strong>{{ $review->user->name }}</strong>
                                                            <span class="text-muted small ms-2">{{ $review->created_at->format('M d, Y') }}</span>
                                                        </div>
                                                        <p class="mb-0 text-muted small">{{ Str::limit($review->comment, 100) }}</p>
                                                    </div>
                                                    <p class="text-danger mb-0"><strong>{{ __('messages.cannot_undo') }}</strong></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                                                    <form method="POST" action="{{ route('reviews.destroy', [$course, $review]) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            🗑️ {{ __('messages.delete_review') }}
                                                        </button>
                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $reviews->links() }}
                    </div>
                @else
                    <p class="text-muted mb-0">{{ __('messages.no_reviews') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
