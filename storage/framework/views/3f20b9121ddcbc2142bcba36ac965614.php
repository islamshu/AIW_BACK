<?php
    $meta = $sectionsRegistry[$section->type] ?? [];
    $data = is_array($section->data) ? $section->data : [];
?>

<div class="section-chip js-section-chip" id="section-<?php echo e($section->id); ?>">
    <input type="hidden" name="sections[<?php echo e($section->id); ?>][id]" value="<?php echo e($section->id); ?>">
    <input type="hidden" name="sections[<?php echo e($section->id); ?>][layout_id]" value="<?php echo e($layout['id']); ?>">
    <input type="hidden" name="sections[<?php echo e($section->id); ?>][column_index]" value="<?php echo e($colIndex); ?>">
    <input type="hidden" name="sections[<?php echo e($section->id); ?>][order]" value="<?php echo e($section->order); ?>">
    <input type="hidden" name="sections[<?php echo e($section->id); ?>][_delete]" class="js-delete-flag" value="0">
    <input type="hidden" name="sections[<?php echo e($section->id); ?>][type]" value="<?php echo e($section->type); ?>">
    <input type="hidden" name="sections[<?php echo e($section->id); ?>][is_active]" value="0">
    
    <div class="section-header">
        <div class="section-title">
            <strong><?php echo e($meta['icon'] ?? '🧱'); ?> <?php echo e($meta['label'] ?? $section->type); ?></strong>
            <?php if(!$section->is_active): ?>
            <span class="badge badge-warning ml-2">مخفي</span>
            <?php endif; ?>
        </div>
        
        <div class="d-flex align-items-center">
            <div class="custom-control custom-switch mr-2">
                <input type="checkbox" class="custom-control-input" 
                       name="sections[<?php echo e($section->id); ?>][is_active]" 
                       id="active-<?php echo e($section->id); ?>" 
                       value="1" <?php echo e($section->is_active ? 'checked' : ''); ?>>
                <label class="custom-control-label" for="active-<?php echo e($section->id); ?>"></label>
            </div>
            
            <button type="button" class="btn btn-danger btn-sm js-mark-delete">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
    
    <hr class="my-3">
    
    <!-- HERO Section -->
    <?php if($section->type === 'hero'): ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">العنوان عربي</label>
                <input type="text" class="form-control" 
                       name="sections[<?php echo e($section->id); ?>][data][title_ar]"
                       value="<?php echo e($data['title_ar'] ?? ''); ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">Title English</label>
                <input type="text" class="form-control" 
                       name="sections[<?php echo e($section->id); ?>][data][title_en]"
                       value="<?php echo e($data['title_en'] ?? ''); ?>">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="font-weight-bold">الوصف عربي</label>
                <textarea class="form-control" rows="3"
                          name="sections[<?php echo e($section->id); ?>][data][desc_ar]"><?php echo e($data['desc_ar'] ?? ''); ?></textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="font-weight-bold">Description English</label>
                <textarea class="form-control" rows="3"
                          name="sections[<?php echo e($section->id); ?>][data][desc_en]"><?php echo e($data['desc_en'] ?? ''); ?></textarea>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- TEXT Section -->
    <?php if($section->type === 'text'): ?>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="font-weight-bold">النص عربي</label>
                <textarea class="form-control" rows="4"
                          name="sections[<?php echo e($section->id); ?>][data][text_ar]"><?php echo e($data['text_ar'] ?? ''); ?></textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="font-weight-bold">Text English</label>
                <textarea class="form-control" rows="4"
                          name="sections[<?php echo e($section->id); ?>][data][text_en]"><?php echo e($data['text_en'] ?? ''); ?></textarea>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- REPEATER Section -->
    <?php if($section->type === 'repeater'): ?>
    <?php
        $items = $data['items'] ?? [];
        $displayMode = $data['display_mode'] ?? 'multi';
    ?>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">عنوان القسم (عربي)</label>
                <input type="text" class="form-control" 
                       name="sections[<?php echo e($section->id); ?>][data][title_ar]"
                       value="<?php echo e($data['title_ar'] ?? ''); ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="font-weight-bold">Section Title (English)</label>
                <input type="text" class="form-control" 
                       name="sections[<?php echo e($section->id); ?>][data][title_en]"
                       value="<?php echo e($data['title_en'] ?? ''); ?>">
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label class="font-weight-bold d-block mb-2">طريقة العرض</label>
        <select class="form-control" name="sections[<?php echo e($section->id); ?>][data][display_mode]">
            <option value="multi" <?php echo e($displayMode === 'multi' ? 'selected' : ''); ?>>كل عنصر داخل كارد مستقل</option>
            <option value="single" <?php echo e($displayMode === 'single' ? 'selected' : ''); ?>>جميع العناصر داخل كارد واحد</option>
        </select>
    </div>
    
    <div class="mb-3">
        <button type="button" class="btn btn-outline-primary js-add-repeater-item" 
                data-section="<?php echo e($section->id); ?>">
            <i class="fas fa-plus mr-1"></i>
            إضافة عنصر
        </button>
    </div>
    
    <div class="repeater-items" data-section="<?php echo e($section->id); ?>">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="repeater-item border rounded p-3 mb-3">
            <input type="hidden" 
                   name="sections[<?php echo e($section->id); ?>][data][items][<?php echo e($index); ?>][order]" 
                   value="<?php echo e($item['order'] ?? $index); ?>">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>العنوان (عربي)</label>
                        <input type="text" class="form-control" 
                               name="sections[<?php echo e($section->id); ?>][data][items][<?php echo e($index); ?>][title_ar]"
                               value="<?php echo e($item['title_ar'] ?? ''); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Title (English)</label>
                        <input type="text" class="form-control" 
                               name="sections[<?php echo e($section->id); ?>][data][items][<?php echo e($index); ?>][title_en]"
                               value="<?php echo e($item['title_en'] ?? ''); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الوصف (عربي)</label>
                        <textarea class="form-control" rows="3"
                                  name="sections[<?php echo e($section->id); ?>][data][items][<?php echo e($index); ?>][desc_ar]"><?php echo e($item['desc_ar'] ?? ''); ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Description (English)</label>
                        <textarea class="form-control" rows="3"
                                  name="sections[<?php echo e($section->id); ?>][data][items][<?php echo e($index); ?>][desc_en]"><?php echo e($item['desc_en'] ?? ''); ?></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-danger btn-block js-remove-repeater-item">
                        <i class="fas fa-trash mr-1"></i>حذف العنصر
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
</div><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/pages/partials/section-item.blade.php ENDPATH**/ ?>