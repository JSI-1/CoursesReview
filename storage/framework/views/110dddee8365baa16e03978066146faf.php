<?php
    $locale = app()->getLocale();
    $isRTL = $locale === 'ar';
    $dir = $isRTL ? 'rtl' : 'ltr';
?>
<!DOCTYPE html>
<html lang="<?php echo e($locale); ?>" dir="<?php echo e($dir); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', __('messages.app_name')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <?php if($isRTL): ?>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <?php else: ?>
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <?php endif; ?>

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        body {
            font-family: <?php echo e($isRTL ? "'Cairo', sans-serif" : "'Figtree', sans-serif"); ?>;
        }
        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }
        [dir="ltr"] {
            direction: ltr;
            text-align: left;
        }
    </style>
</head>
<body class="font-sans antialiased d-flex flex-column min-vh-100" dir="<?php echo e($dir); ?>">
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?php echo e(route('courses.index')); ?>">
                <?php echo e(__('messages.app_name')); ?>

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav <?php echo e($isRTL ? 'ms-auto' : 'me-auto'); ?>">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('courses.index')); ?>"><?php echo e(__('messages.courses')); ?></a>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-center">
                    <!-- Language Switcher -->
                    <li class="nav-item <?php echo e($isRTL ? 'ms-2' : 'me-2'); ?>">
                        <div class="dropdown">
                            <button class="btn btn-link nav-link p-2 text-white" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><?php echo e($locale === 'ar' ? '🇸🇦' : 'EN'); ?></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                                <li>
                                    <a class="dropdown-item <?php echo e($locale === 'en' ? 'active' : ''); ?>" href="<?php echo e(route('language.switch', 'en')); ?>">
                                        <?php echo e(__('messages.english')); ?>

                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?php echo e($locale === 'ar' ? 'active' : ''); ?>" href="<?php echo e(route('language.switch', 'ar')); ?>">
                                        <?php echo e(__('messages.arabic')); ?>

                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('messages.dashboard')); ?></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <?php echo e(auth()->user()->name); ?>

                            </a>
                            <ul class="dropdown-menu <?php echo e($isRTL ? 'dropdown-menu-start' : 'dropdown-menu-end'); ?>">
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item"><?php echo e(__('messages.logout')); ?></button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('messages.login')); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('messages.register')); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4 flex-grow-1">
        <div class="container">
            <?php echo $__env->make('components.flash-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <footer class="bg-light text-dark py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-0">&copy; <?php echo e(date('Y')); ?> <?php echo e(__('messages.app_name')); ?>. <?php echo e($isRTL ? 'جميع الحقوق محفوظة' : 'All rights reserved'); ?>.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\Users\user\OneDrive\Desktop\course-review-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>