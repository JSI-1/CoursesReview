@extends('layouts.app')

@php
    $isRTL = app()->getLocale() === 'ar';
@endphp

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body text-center py-5">
                <h1 class="display-4 mb-4">{{ __('messages.welcome_title') }}</h1>
                <p class="lead mb-4">{{ __('messages.welcome_description') }}</p>
                <a href="{{ route('courses.index') }}" class="btn btn-primary btn-lg">{{ __('messages.browse_courses') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
