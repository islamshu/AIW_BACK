

<?php $__env->startSection('title', 'قسم الهيرو'); ?>

<?php $__env->startSection('content'); ?>
<div class="app-content content">
    <div class="content-wrapper">

        
        <div class="content-header row mb-2">
            <div class="col-12">
                <h3 class="content-header-title">تعديل قسم الهيرو</h3>
            </div>
        </div>

     

        
        <div class="card">
            <div class="card-body">
                <?php echo $__env->make('dashboard.inc.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <form method="POST"
                      action="<?php echo e(route('home-hero.update')); ?>"
                      enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="row">

                        
                        <div class="col-md-6 mb-2">
                            <label>العنوان (AR)</label>
                            <input type="text"
                                   name="title[ar]"
                                   class="form-control"
                                   value="<?php echo e(old('title.ar', $hero->getTranslation('title','ar'))); ?>">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Title (EN)</label>
                            <input type="text"
                                   name="title[en]"
                                   class="form-control"
                                   value="<?php echo e(old('title.en', $hero->getTranslation('title','en'))); ?>">
                        </div>

                        
                        <div class="col-md-6 mb-2">
                            <label>الوصف (AR)</label>
                            <textarea name="subtitle[ar]"
                                      class="form-control js-editor"
                                      rows="3"><?php echo e(old('subtitle.ar', $hero->getTranslation('subtitle','ar'))); ?></textarea>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Description (EN)</label>
                            <textarea name="subtitle[en]"
                                      class="form-control js-editor"
                                      rows="3"><?php echo e(old('subtitle.en', $hero->getTranslation('subtitle','en'))); ?></textarea>
                        </div>

                        
                        <div class="col-md-6 mb-2">
                            <label>زر (AR)</label>
                            <input type="text"
                                   name="button_text[ar]"
                                   class="form-control"
                                   value="<?php echo e(old('button_text.ar', $hero->getTranslation('button_text','ar'))); ?>">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Button (EN)</label>
                            <input type="text"
                                   name="button_text[en]"
                                   class="form-control"
                                   value="<?php echo e(old('button_text.en', $hero->getTranslation('button_text','en'))); ?>">
                        </div>

                        
                        <div class="col-md-12 mb-2">
                            <label>رابط الزر</label>
                            <input type="text"
                                   name="button_link"
                                   class="form-control"
                                   value="<?php echo e(old('button_link', $hero->button_link)); ?>">
                        </div>

                        
                        <div class="col-md-12 mb-3">
                         
                            <div class="form-group">
                                <label>الصورة</label>
                                <div class="col-md-6 mb-3 type-field" id="imageField"></div>


                                
                                <input type="hidden" name="image"
                                    id="imageInput"
                                    value="<?php echo e($hero->image); ?>">

                                <button type="button" class="btn btn-outline-primary w-100"
                                    onclick="openMediaLibrary()">
                                    📁 اختيار صورة من المكتبة
                                </button>

                                
                                <div class="mt-2">
                                    <img id="imagePreview"
                                        src="<?php echo e(asset('storage/' . $hero->image)); ?>"
                                        class="img-thumbnail"
                                        style="max-height:120px">
                                </div>


                            </div>
                        </div>

                    </div>

                    <button class="btn btn-primary">
                        حفظ التعديلات
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/home-hero/edit.blade.php ENDPATH**/ ?>