@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <span style="font-size: 1.5rem; margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}: 0.75rem;">✅</span>
            <div class="flex-grow-1">
                <strong>{{ __('messages.success') }}</strong> {{ session('success') }}
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('messages.close') }}"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <span style="font-size: 1.5rem; margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}: 0.75rem;">❌</span>
            <div class="flex-grow-1">
                <strong>{{ __('messages.error') }}</strong> {{ session('error') }}
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('messages.close') }}"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <div class="d-flex align-items-start">
            <span style="font-size: 1.5rem; margin-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}: 0.75rem;">⚠️</span>
            <div class="flex-grow-1">
                <strong>{{ __('messages.please_fix_errors') }}</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('messages.close') }}"></button>
    </div>
@endif
