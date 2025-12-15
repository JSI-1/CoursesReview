

<?php $__env->startSection('title', __('messages.dashboard')); ?>

<?php
    $isRTL = app()->getLocale() === 'ar';
?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <h1 class="h2 mb-4"><?php echo e(__('messages.dashboard')); ?></h1>
        <p class="lead"><?php echo e($isRTL ? 'مرحباً بعودتك' : 'Welcome back'); ?>, <?php echo e(auth()->user()->name); ?>!</p>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><?php echo e(__('messages.my_reviews')); ?></h5>
            </div>
            <div class="card-body">
                <?php if($reviews->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th><?php echo e(__('messages.courses')); ?></th>
                                    <th><?php echo e(__('messages.department')); ?></th>
                                    <th><?php echo e(__('messages.rating')); ?></th>
                                    <th><?php echo e(__('messages.comment')); ?></th>
                                    <th><?php echo e($isRTL ? 'التاريخ' : 'Date'); ?></th>
                                    <th><?php echo e($isRTL ? 'الإجراءات' : 'Actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(route('courses.show', $review->course)); ?>" class="text-decoration-none fw-semibold">
                                                <?php echo e($review->course->name); ?>

                                            </a>
                                        </td>
                                        <td><span class="badge bg-secondary"><?php echo e($review->course->department->translated_name); ?></span></td>
                                        <td>
                                            <div class="text-warning">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <?php if($i <= $review->rating): ?>
                                                        ★
                                                    <?php else: ?>
                                                        ☆
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </div>
                                        </td>
                                        <td><?php echo e(Str::limit($review->comment, 50)); ?></td>
                                        <td><small class="text-muted"><?php echo e($review->created_at->format('M d, Y')); ?></small></td>
                                        <td>
                                            <a href="<?php echo e(route('reviews.edit', [$review->course, $review])); ?>" class="btn btn-sm btn-outline-primary"><?php echo e(__('messages.edit')); ?></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        <?php echo e($reviews->links()); ?>

                    </div>
                <?php else: ?>
                    <div class="alert alert-info mb-0">
                        <p class="mb-2"><?php echo e($isRTL ? 'لم تكتب أي مراجعات بعد.' : "You haven't written any reviews yet."); ?></p>
                        <a href="<?php echo e(route('courses.index')); ?>" class="btn btn-primary"><?php echo e(__('messages.courses')); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\OneDrive\Desktop\course-review-app\resources\views/dashboard.blade.php ENDPATH**/ ?>