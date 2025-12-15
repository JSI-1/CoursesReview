

<?php $__env->startSection('title', __('messages.courses')); ?>

<?php
    $isRTL = app()->getLocale() === 'ar';
?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-12">
        <h1 class="h2 mb-4"><?php echo e(__('messages.courses')); ?></h1>
        
        <!-- Search and Filter Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><?php echo e(__('messages.search')); ?> & <?php echo e(__('messages.filter')); ?></h5>
            </div>
            <div class="card-body">
                <form method="GET" action="<?php echo e(route('courses.index')); ?>" class="row g-3">
                    <div class="col-md-6">
                        <label for="search" class="form-label"><?php echo e(__('messages.search')); ?></label>
                        <input type="text" 
                               id="search"
                               name="search" 
                               class="form-control" 
                               placeholder="<?php echo e(__('messages.search_placeholder')); ?>"
                               value="<?php echo e(request('search')); ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="department" class="form-label"><?php echo e(__('messages.department')); ?></label>
                        <select name="department" id="department" class="form-select">
                            <option value=""><?php echo e(__('messages.all_departments')); ?></option>
                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($department->id); ?>" <?php echo e(request('department') == $department->id ? 'selected' : ''); ?>>
                                    <?php echo e($department->translated_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100"><?php echo e(__('messages.search')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if($courses->count() > 0): ?>
    <div class="row">
        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm course-card">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-3 d-flex justify-content-between align-items-start">
                            <div>
                                <span class="badge bg-primary mb-2"><?php echo e($course->code); ?></span>
                                <span class="badge bg-secondary d-block"><?php echo e($course->department->translated_name); ?></span>
                            </div>
                            <?php if($course->reviews_avg_rating): ?>
                                <div class="text-center">
                                    <div class="text-warning mb-1" style="font-size: 1.1rem;">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= round($course->reviews_avg_rating)): ?>
                                                ★
                                            <?php else: ?>
                                                ☆
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <small class="text-muted d-block"><?php echo e(number_format($course->reviews_avg_rating, 1)); ?></small>
                                </div>
                            <?php endif; ?>
                        </div>
                        <h5 class="card-title mb-3 fw-bold" style="min-height: 3rem; line-height: 1.4;"><?php echo e($course->name); ?></h5>
                        <?php if($course->description): ?>
                            <p class="card-text small text-muted flex-grow-1 mb-3" style="line-height: 1.6;"><?php echo e(Str::limit($course->description, 100)); ?></p>
                        <?php endif; ?>
                        <div class="mt-auto pt-3 border-top">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <?php if($course->reviews_avg_rating): ?>
                                    <small class="text-muted">
                                        <strong><?php echo e($course->reviews_count); ?></strong> <?php echo e(trans_choice('messages.review_count', $course->reviews_count)); ?>

                                    </small>
                                <?php else: ?>
                                    <small class="text-muted"><?php echo e(__('messages.no_reviews_yet')); ?></small>
                                <?php endif; ?>
                                <small class="text-muted"><strong><?php echo e($course->credits); ?></strong> <?php echo e(__('messages.credits')); ?></small>
                            </div>
                            <a href="<?php echo e(route('courses.show', $course)); ?>" class="btn btn-primary w-100"><?php echo e(__('messages.view_details')); ?> <?php echo e($isRTL ? '←' : '→'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        <?php echo e($courses->links()); ?>

    </div>
<?php else: ?>
    <div class="alert alert-info">
        <h5><?php echo e(__('messages.no_courses_found')); ?></h5>
        <p class="mb-0"><?php echo e(__('messages.try_adjusting')); ?></p>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\OneDrive\Desktop\course-review-app\resources\views/courses/index.blade.php ENDPATH**/ ?>