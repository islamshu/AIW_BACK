<div class="col-12">
    <label class="fw-bold">الصور</label>

    <div class="border rounded p-3 bg-light text-center">

        
        <input type="hidden"
               name="sections[<?php echo e($section->id); ?>][data][image_id]"
               id="section_image_<?php echo e($section->id); ?>"
               value="<?php echo e($data['image_id'] ?? ''); ?>">

        
        <img
            id="section_preview_<?php echo e($section->id); ?>"
            src="<?php echo e(get_image_path(@$data['image_id']) ?? ''); ?>"
            class="img-fluid rounded mb-2"
            style="max-height:180px; <?php echo e(empty($data['image_id']) ? 'display:none' : ''); ?>"
        >

        <button type="button"
        class="btn btn-outline-primary btn-sm js-open-media"
        data-section-id="<?php echo e($section->id); ?>">
    اختيار صورة
</button>


        
        <button type="button"
                class="btn btn-outline-danger btn-sm ms-2"
                onclick="removeSectionImage(<?php echo e($section->id); ?>)"
                id="section_remove_<?php echo e($section->id); ?>"
                style="<?php echo e(empty($data['image_id']) ? 'display:none' : ''); ?>">
            حذف
        </button>

    </div>
</div>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/pages/sections/images.blade.php ENDPATH**/ ?>