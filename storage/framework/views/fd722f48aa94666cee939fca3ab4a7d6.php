
<?php $__env->startSection('title', 'خبر'); ?>

<?php $__env->startSection('style'); ?>
    <style>
        .page-wrapper {
            padding: 24px;
        }

        .form-card {
            background: #fff;
            border-radius: 18px;
            padding: 24px;
            border: 1px solid #eaecef;
        }

        .form-card h5 {
            font-weight: 800;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 700;
            font-size: 14px;
        }

        hr {
            margin: 24px 0;
        }

        .image-card {
            border: 2px dashed #dfe3e8;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            background: #fafafa;
            transition: all .3s ease;
        }

        .image-card:hover {
            border-color: #7367f0;
            background: #f5f6ff;
        }

        .image-preview-wrapper {
            position: relative;
            display: inline-block;
            margin-top: 12px;
        }

        .image-preview-wrapper img {
            max-height: 160px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .15);
        }

        .remove-image-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #dc3545;
            color: #fff;
            border-radius: 50%;
            border: none;
            width: 28px;
            height: 28px;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-wrapper">

        <div class="mb-4">
            <h3><?php echo e($news ? 'تعديل خبر' : 'إضافة خبر جديد'); ?></h3>
            <small class="text-muted">إدارة محتوى الأخبار المعروضة في الموقع</small>
        </div>

        <?php echo $__env->make('dashboard.inc.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="form-card">

            <form method="POST" action="<?php echo e($news ? route('dashboard.news.update', $news) : route('dashboard.news.store')); ?>">
                <?php echo csrf_field(); ?>
                <?php if($news): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>

                
                <h5>العناوين</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">العنوان (AR)</label>
                        <input required type="text" class="form-control" name="title[ar]"
                            value="<?php echo e(old('title.ar', $news?->getTranslation('title', 'ar'))); ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title (EN)</label>
                        <input required type="text" class="form-control" name="title[en]"
                            value="<?php echo e(old('title.en', $news?->getTranslation('title', 'en'))); ?>">
                    </div>
                </div>

                <hr>

                
                <h5>الوصف المختصر</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">الوصف المختصر (AR)</label>
                        <textarea required class="form-control" rows="4" name="excerpt[ar]"><?php echo e(old('excerpt.ar', $news?->getTranslation('excerpt', 'ar'))); ?></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Excerpt (EN)</label>
                        <textarea required class="form-control" rows="4" name="excerpt[en]"><?php echo e(old('excerpt.en', $news?->getTranslation('excerpt', 'en'))); ?></textarea>
                    </div>
                </div>

                <hr>

                
                <h5>المحتوى الكامل</h5>
                <div class="mb-3">
                    <label class="form-label">المحتوى (AR)</label>
                    <textarea  class="form-control js-editor" rows="8" name="content[ar]"><?php echo old('content.ar', $news?->getTranslation('content', 'ar')); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Content (EN)</label>
                    <textarea  class="form-control js-editor" rows="8" name="content[en]"><?php echo old('content.en', $news?->getTranslation('content', 'en')); ?></textarea>
                </div>

                <hr>
                <hr>

                
                <h5>إعدادات النشر</h5>

                <div class="row align-items-center">

                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">تاريخ النشر</label>
                        <input type="datetime-local" name="published_at" class="form-control"
                            value="<?php echo e(old('published_at', optional($news?->published_at)->format('Y-m-d\TH:i'))); ?>">
                        <small class="text-muted">
                            في حال تركه فارغًا سيتم النشر فورًا
                        </small>
                    </div>



                </div>
                
                <h5>الصورة الرئيسية</h5>

                <div class="col-md-12 mb-4">
                    <div class="image-card">

                        <i class="fas fa-image fa-2x mb-2 text-muted"></i>
                        <p class="mb-3 text-muted">
                            اختر صورة الخبر (تُعرض في صفحة الأخبار)
                        </p>

                        
                        <input type="hidden" name="image" id="imageInput" value="<?php echo e(old('image', $news?->image)); ?>">

                        <button type="button" class="btn btn-outline-primary px-4" onclick="openMediaLibrary()">
                            📁 اختيار صورة من المكتبة
                        </button>

                        
                        <div class="mt-2">
                            <img id="imagePreview" src="<?php echo e(asset('storage/' . $news?->image)); ?>" class="img-thumbnail"
                                style="max-height:120px">
                        </div>

                    </div>
                </div>



                
                <div class="d-flex justify-content-end gap-2">
                    <a href="<?php echo e(route('dashboard.news.index')); ?>" class="btn btn-light">
                        رجوع
                    </a>

                    <button class="btn btn-primary px-4">
                        <i class="fas fa-save"></i> حفظ الخبر
                    </button>
                </div>

            </form>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/news/form.blade.php ENDPATH**/ ?>