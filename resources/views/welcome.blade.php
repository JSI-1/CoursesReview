@extends('layouts.app')

@php
    $isRTL = app()->getLocale() === 'ar';
@endphp

@section('content')
<div class="hero-section">
    <div class="row justify-content-center align-items-center min-vh-75">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center py-5 px-4">
                    <div class="mb-4">
                        <div class="float-animation" style="font-size: 4rem; margin-bottom: 1rem;">
                            📚
                        </div>
                    </div>
                    <h1 class="display-4 mb-4 gradient-text fw-bold">
                        {{ __('messages.welcome_title') }}
                    </h1>
                    <p class="lead mb-4 welcome-text" style="font-size: 1.25rem; line-height: 1.8; color: #64748b;">
                        {{ __('messages.welcome_description') }}
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="{{ route('courses.index') }}" class="btn btn-primary btn-lg px-5 py-3">
                            <span style="margin-{{ $isRTL ? 'left' : 'right' }}: 0.5rem;">{{ __('messages.browse_courses') }}</span>
                            <span>{{ $isRTL ? '←' : '→' }}</span>
                        </a>
                        @guest
                            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-5 py-3">
                                {{ __('messages.get_started') }}
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .min-vh-75 {
        min-height: 75vh;
    }
</style>
@endsection
