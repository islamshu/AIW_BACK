<?php if($media->count()): ?>
<div class="media-grid">
    <?php $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="media-item" data-media-id="<?php echo e($m->id); ?>">
        <div class="media-thumb js-media-preview"
             data-bs-toggle="modal" 
             data-bs-target="#editModal"
             data-id="<?php echo e($m->id); ?>"
             data-url="<?php echo e($m->url); ?>"
             data-alt="<?php echo e($m->alt ?? ''); ?>"
             data-title="<?php echo e($m->title ?? ''); ?>"
             data-caption="<?php echo e($m->caption ?? ''); ?>"
             data-description="<?php echo e($m->description ?? ''); ?>"
             data-filename="<?php echo e($m->file_name); ?>"
             data-size="<?php echo e($m->human_size); ?>"
             data-type="<?php echo e($m->mime_type); ?>"
             data-date="<?php echo e($m->created_at->format('Y/m/d')); ?>">
            <img src="<?php echo e($m->url); ?>" alt="<?php echo e($m->alt ?? ''); ?>" loading="lazy">
            <div class="media-thumb-overlay">
                <span class="text-white">
                    <i class="fas fa-search-plus fa-2x"></i>
                </span>
            </div>
        </div>
        
        <div class="media-info">
            <div class="media-filename" title="<?php echo e($m->file_name); ?>">
                <?php echo e(Str::limit($m->file_name, 25)); ?>

            </div>
            <div class="media-meta">
                <span><?php echo e($m->human_size); ?></span>
                <span><?php echo e($m->created_at->format('Y/m/d')); ?></span>
            </div>
        </div>

        <div class="media-actions">
            <?php if($selectMode): ?>
            <button type="button"
                    class="btn btn-primary btn-sm js-select-media"
                    data-id="<?php echo e($m->id); ?>"
                    data-url="<?php echo e($m->url); ?>"
                    data-alt="<?php echo e($m->alt ?? ''); ?>">
                <i class="fas fa-check me-1"></i> اختيار
            </button>
            <?php endif; ?>
            
            <button type="button"
                    class="btn-action js-media-edit"
                    data-bs-toggle="modal" 
                    data-bs-target="#editModal"
                    data-id="<?php echo e($m->id); ?>"
                    data-url="<?php echo e($m->url); ?>"
                    data-alt="<?php echo e($m->alt ?? ''); ?>"
                    data-title="<?php echo e($m->title ?? ''); ?>"
                    data-caption="<?php echo e($m->caption ?? ''); ?>"
                    data-description="<?php echo e($m->description ?? ''); ?>"
                    data-filename="<?php echo e($m->file_name); ?>"
                    data-size="<?php echo e($m->human_size); ?>"
                    data-type="<?php echo e($m->mime_type); ?>"
                    data-date="<?php echo e($m->created_at->format('Y/m/d')); ?>"
                    title="تعديل">
                <i class="fas fa-edit"></i>
            </button>
            
            <button type="button" 
                    class="btn-action delete js-media-delete" 
                    data-id="<?php echo e($m->id); ?>"
                    title="حذف">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php else: ?>
<div class="empty-state">
    <div class="empty-state-icon">
        <i class="far fa-images"></i>
    </div>
    <h5>لا توجد وسائط بعد</h5>
    <p class="text-muted">ابدأ برفع الوسائط الأولى بالنقر على زر "رفع وسائط جديدة"</p>
</div>
<?php endif; ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/media/_media_grid.blade.php ENDPATH**/ ?>