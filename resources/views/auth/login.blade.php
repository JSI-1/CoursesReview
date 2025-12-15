@extends('layouts.app')

@section('title', __('messages.login'))

@php
    $isRTL = app()->getLocale() === 'ar';
@endphp

@section('content')
<div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow animate-fade-in">
            <div class="card-header">
                <h4 class="mb-0 text-center">{{ __('messages.welcome_back') }}</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('messages.email') }}</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">{{ __('messages.password') }}</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">{{ __('messages.login') }}</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p class="mb-0">{{ __('messages.dont_have_account') }} <a href="{{ route('register') }}">{{ __('messages.register_here') }}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
