

<?php $__env->startSection('title', $course->name); ?>

<?php
    $isRTL = app()->getLocale() === 'ar';
    use Illuminate\Support\Facades\Storage;
?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('courses.index')); ?>"><?php echo e(__('messages.courses')); ?></a></li>
                <li class="breadcrumb-item active"><?php echo e($course->name); ?></li>
            </ol>
        </nav>

        <!-- Course Information -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="flex-grow-1">
                        <h1 class="h2 mb-2"><?php echo e($course->name); ?></h1>
                        <div class="d-flex gap-2 mb-3">
                            <span class="badge bg-primary"><?php echo e($course->code); ?></span>
                            <span class="badge bg-secondary"><?php echo e($course->department->translated_name); ?></span>
                            <span class="badge bg-info text-white"><?php echo e($course->credits); ?> <?php echo e(__('messages.credits')); ?></span>
                        </div>
                    </div>
                    <?php if($averageRating > 0): ?>
                        <div class="text-center ms-4 p-3 rounded" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%); min-width: 150px;">
                            <div class="text-warning fs-3 mb-2">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <?php if($i <= round($averageRating)): ?>
                                        ★
                                    <?php else: ?>
                                        ☆
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                            <div class="fw-bold fs-5 text-primary"><?php echo e(number_format($averageRating, 1)); ?>/5.0</div>
                            <small class="text-muted"><?php echo e(trans_choice('messages.review_count', $reviewsCount, ['count' => $reviewsCount])); ?></small>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if($course->description): ?>
                    <div class="mt-4 p-3 rounded" style="background: #f8fafc; <?php echo e($isRTL ? 'border-right' : 'border-left'); ?>: 4px solid var(--primary-color);">
                        <h5 class="mb-2"><?php echo e(__('messages.description')); ?></h5>
                        <p class="mb-0" style="line-height: 1.7;"><?php echo e($course->description); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Review Form (for authenticated users who haven't reviewed) -->
        <?php if(auth()->guard()->check()): ?>
            <?php if(!$userReview): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><?php echo e(__('messages.write_review')); ?></h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('reviews.store', $course)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="rating" class="form-label"><?php echo e(__('messages.rating')); ?> <span class="text-danger">*</span></label>
                                <select name="rating" id="rating" class="form-select <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                    <option value=""><?php echo e(__('messages.select_rating')); ?></option>
                                    <option value="5" <?php echo e(old('rating') == 5 ? 'selected' : ''); ?>>5 - <?php echo e(__('messages.excellent')); ?></option>
                                    <option value="4" <?php echo e(old('rating') == 4 ? 'selected' : ''); ?>>4 - <?php echo e(__('messages.very_good')); ?></option>
                                    <option value="3" <?php echo e(old('rating') == 3 ? 'selected' : ''); ?>>3 - <?php echo e(__('messages.good')); ?></option>
                                    <option value="2" <?php echo e(old('rating') == 2 ? 'selected' : ''); ?>>2 - <?php echo e(__('messages.fair')); ?></option>
                                    <option value="1" <?php echo e(old('rating') == 1 ? 'selected' : ''); ?>>1 - <?php echo e(__('messages.poor')); ?></option>
                                </select>
                                <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label"><?php echo e(__('messages.comment')); ?> <span class="text-danger">*</span></label>
                                <textarea name="comment" 
                                          id="comment" 
                                          class="form-control <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          rows="5" 
                                          required
                                          minlength="10"
                                          maxlength="1000"><?php echo e(old('comment')); ?></textarea>
                                <small class="form-text text-muted"><?php echo e($isRTL ? 'الحد الأدنى 10 أحرف، الحد الأقصى 1000 حرف.' : 'Minimum 10 characters, maximum 1000 characters.'); ?></small>
                                <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label"><?php echo e(__('messages.attach_file')); ?> (<?php echo e(__('messages.optional')); ?>)</label>
                                <input type="file" 
                                       name="file" 
                                       id="file" 
                                       class="form-control <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       accept=".jpg,.jpeg,.png,.pdf">
                                <small class="form-text text-muted"><?php echo e(__('messages.file_upload_hint')); ?></small>
                                <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <button type="submit" class="btn btn-primary"><?php echo e(__('messages.submit_review')); ?></button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-info mb-4">
                    <strong><?php echo e(__('messages.already_reviewed')); ?></strong>
                    <a href="<?php echo e(route('reviews.edit', [$course, $userReview])); ?>" class="btn btn-sm btn-outline-primary <?php echo e($isRTL ? 'me-2' : 'ms-2'); ?>"><?php echo e(__('messages.edit_review')); ?></a>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="alert alert-warning mb-4">
                <strong><?php echo e(__('messages.please_login')); ?> <a href="<?php echo e(route('login')); ?>"><?php echo e(__('messages.login')); ?></a> <?php echo e(__('messages.or')); ?> <a href="<?php echo e(route('register')); ?>"><?php echo e(__('messages.register')); ?></a> <?php echo e(__('messages.to_write_review')); ?></strong>
            </div>
        <?php endif; ?>

        <!-- Reviews List -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><?php echo e(__('messages.reviews')); ?> (<?php echo e($reviewsCount); ?>)</h5>
            </div>
            <div class="card-body">
                <?php if($reviews->count() > 0): ?>
                    <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border-bottom pb-3 mb-3 review-item">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center <?php echo e($isRTL ? 'ms-3' : 'me-3'); ?>" style="width: 45px; height: 45px; font-weight: 700; font-size: 1.1rem; flex-shrink: 0;">
                                        <?php echo e(strtoupper(substr($review->user->name, 0, 1))); ?>

                                    </div>
                                    <div class="<?php echo e($isRTL ? 'text-right' : 'text-left'); ?>">
                                        <strong class="d-block mb-1"><?php echo e($review->user->name); ?></strong>
                                        <span class="text-muted small"><?php echo e($review->created_at->format('M d, Y')); ?></span>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-warning">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= $review->rating): ?>
                                                ★
                                            <?php else: ?>
                                                ☆
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                            <p class="mb-2 <?php echo e($isRTL ? 'pe-5' : 'ps-5'); ?>"><?php echo e($review->comment); ?></p>
                            <?php if($review->file_path): ?>
                                <div class="mb-2 <?php echo e($isRTL ? 'pe-5' : 'ps-5'); ?>">
                                    <a href="<?php echo e(Storage::url($review->file_path)); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        📎 <?php echo e(__('messages.view_file')); ?>: <?php echo e(basename($review->file_path)); ?>

                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if(auth()->guard()->check()): ?>
                                <?php if(auth()->id() === $review->user_id): ?>
                                    <div class="mt-3 <?php echo e($isRTL ? 'pe-5' : 'ps-5'); ?>">
                                        <a href="<?php echo e(route('reviews.edit', [$course, $review])); ?>" class="btn btn-sm btn-outline-secondary <?php echo e($isRTL ? 'ms-2' : 'me-2'); ?>">
                                            ✏️ <?php echo e(__('messages.edit')); ?>

                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo e($review->id); ?>">
                                            🗑️ <?php echo e(__('messages.delete')); ?>

                                        </button>
                                    </div>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo e($review->id); ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo e($review->id); ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel<?php echo e($review->id); ?>">
                                                        ⚠️ <?php echo e(__('messages.confirm_delete')); ?>

                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="<?php echo e(__('messages.close')); ?>"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="mb-3"><?php echo e(__('messages.delete_review_confirm')); ?></p>
                                                    <div class="alert alert-light border">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-warning me-2">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <?php if($i <= $review->rating): ?>
                                                                        ★
                                                                    <?php else: ?>
                                                                        ☆
                                                                    <?php endif; ?>
                                                                <?php endfor; ?>
                                                            </div>
                                                            <strong><?php echo e($review->user->name); ?></strong>
                                                            <span class="text-muted small ms-2"><?php echo e($review->created_at->format('M d, Y')); ?></span>
                                                        </div>
                                                        <p class="mb-0 text-muted small"><?php echo e(Str::limit($review->comment, 100)); ?></p>
                                                    </div>
                                                    <p class="text-danger mb-0"><strong><?php echo e(__('messages.cannot_undo')); ?></strong></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('messages.cancel')); ?></button>
                                                    <form method="POST" action="<?php echo e(route('reviews.destroy', [$course, $review])); ?>" class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger">
                                                            🗑️ <?php echo e(__('messages.delete_review')); ?>

                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        <?php echo e($reviews->links()); ?>

                    </div>
                <?php else: ?>
                    <p class="text-muted mb-0"><?php echo e(__('messages.no_reviews')); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\OneDrive\Desktop\course-review-app\resources\views/courses/show.blade.php ENDPATH**/ ?>