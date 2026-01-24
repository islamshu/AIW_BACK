<?php $__env->startSection('title', __('اعدادات الموقع')); ?>

<?php $__env->startSection('content'); ?>
<div class="app-content content">
    <div class="content-wrapper">

        
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"><?php echo e(__('إعدادات الموقع')); ?></h3>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('home')); ?>"><?php echo e(__('الرئيسية')); ?></a>
                        </li>
                        <li class="breadcrumb-item active"><?php echo e(__('إعدادات الموقع')); ?></li>
                    </ol>
                </div>
            </div>
        </div>

        
        <div class="content-body">
            <section id="settings">

                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo e(__('إعدادات الموقع')); ?></h4>
                            </div>

                            <div class="card-content collapse show">
                                <div class="card-body">

                                    <form action="<?php echo e(route('add_general')); ?>"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>

                                        
                                        
                                        
                                        <div class="form-section mb-5">
                                            <h5 class="section-title mb-3">
                                                <i class="ft-settings"></i>
                                                <?php echo e(__('الإعدادات العامة')); ?>

                                            </h5>

                                            <div class="row">

                                                
                                                <div class="col-md-6">
                                                    <label><?php echo e(__('شعار الموقع')); ?></label>

                                                    <input type="hidden"
                                                           name="general[website_logo]"
                                                           id="imageInput"
                                                           value="<?php echo e(get_general_value('website_logo')); ?>">

                                                    <button type="button"
                                                            class="btn btn-outline-primary w-100"
                                                            onclick="openMediaLibrary()">
                                                        📁 <?php echo e(__('اختيار صورة من المكتبة')); ?>

                                                    </button>

                                                    <div class="mt-2">
                                                        <img id="imagePreview"
                                                             src="<?php echo e(asset('storage/'.get_general_value('website_logo'))); ?>"
                                                             class="img-thumbnail"
                                                             style="max-height:120px">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <label><?php echo e(__('البريد الإلكتروني')); ?></label>
                                                    <input type="email"
                                                           class="form-control"
                                                           name="general[website_email]"
                                                           value="<?php echo e(get_general_value('website_email')); ?>">
                                                </div>

                                                <div class="col-md-6">
                                                    <label><?php echo e(__('هاتف الموقع')); ?></label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="general[phone]"
                                                           value="<?php echo e(get_general_value('phone')); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        
                                        
                                        
                                        <div class="form-section mb-5">
                                            <h5 class="section-title text-center mb-4">
                                                <i class="ft-droplet"></i>
                                                <?php echo e(__('نظام ألوان الموقع')); ?>

                                            </h5>

                                            <div class="row justify-content-center">
                                                <div class="col-md-10">

                                                    <div class="card border shadow-sm">
                                                        <div class="card-body">

                                                            <div class="row text-center">

                                                                <div class="col-md-3">
                                                                    <label class="font-weight-bold mb-2 d-block">
                                                                        <?php echo e(__('اللون الرئيسي')); ?>

                                                                    </label>
                                                                    <input type="color"
                                                                           class="form-control"
                                                                           name="general[prime_color]"
                                                                           value="<?php echo e(get_general_value('prime_color') ?? '#00b4d8'); ?>">
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label class="font-weight-bold mb-2 d-block">
                                                                        <?php echo e(__('اللون الثانوي')); ?>

                                                                    </label>
                                                                    <input type="color"
                                                                           class="form-control"
                                                                           name="general[second_color]"
                                                                           value="<?php echo e(get_general_value('second_color') ?? '#ff5d8f'); ?>">
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label class="font-weight-bold mb-2 d-block">
                                                                        <?php echo e(__('لون الخلفية')); ?>

                                                                    </label>
                                                                    <input type="color"
                                                                           class="form-control"
                                                                           name="general[bg_color]"
                                                                           value="<?php echo e(get_general_value('bg_color') ?? '#0a192f'); ?>">
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label class="font-weight-bold mb-2 d-block">
                                                                        <?php echo e(__('لون النص')); ?>

                                                                    </label>
                                                                    <input type="color"
                                                                           class="form-control"
                                                                           name="general[text_color]"
                                                                           value="<?php echo e(get_general_value('text_color') ?? '#ffffff'); ?>">
                                                                </div>

                                                            </div>

                                                            
                                                            <div class="mt-4 p-4 rounded text-center"
                                                                 style="
                                                                    background: <?php echo e(get_general_value('bg_color') ?? '#0a192f'); ?>;
                                                                    color: <?php echo e(get_general_value('text_color') ?? '#ffffff'); ?>;
                                                                    border: 1px solid <?php echo e(get_general_value('prime_color') ?? '#00b4d8'); ?>;
                                                                 ">
                                                                <h4 style="
                                                                    background: linear-gradient(
                                                                        135deg,
                                                                        <?php echo e(get_general_value('prime_color') ?? '#00b4d8'); ?>,
                                                                        <?php echo e(get_general_value('second_color') ?? '#ff5d8f'); ?>

                                                                    );
                                                                    -webkit-background-clip: text;
                                                                    color: transparent;
                                                                ">
                                                                    <?php echo e(__('معاينة الألوان')); ?>

                                                                </h4>

                                                                <p class="mb-0">
                                                                    <?php echo e(__('هذا مثال مباشر على ألوان الموقع')); ?>

                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        
                                        
                                        
                                        <div class="form-section mb-5">
                                            <h5 class="section-title">
                                                <i class="ft-flag"></i>
                                                <?php echo e(__('إعدادات اللغة العربية')); ?>

                                            </h5>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label><?php echo e(__('اسم الموقع')); ?></label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="general[website_name_ar]"
                                                           value="<?php echo e(get_general_value('website_name_ar')); ?>">
                                                </div>

                                                <div class="col-md-6">
                                                    <label><?php echo e(__('العنوان')); ?></label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="general[address_ar]"
                                                           value="<?php echo e(get_general_value('address_ar')); ?>">
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label><?php echo e(__('وصف الموقع')); ?></label>
                                                    <textarea class="form-control js-editor"
                                                              rows="3"
                                                              name="general[description_ar]">
                                                        <?php echo e(get_general_value('description_ar')); ?>

                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        
                                        
                                        <div class="form-section mb-4">
                                            <h5 class="section-title">
                                                <i class="ft-flag"></i>
                                                <?php echo e(__('إعدادات اللغة الإنجليزية')); ?>

                                            </h5>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label><?php echo e(__('اسم الموقع')); ?></label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="general[website_name_en]"
                                                           value="<?php echo e(get_general_value('website_name_en')); ?>">
                                                </div>

                                                <div class="col-md-6">
                                                    <label><?php echo e(__('العنوان')); ?></label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="general[address_en]"
                                                           value="<?php echo e(get_general_value('address_en')); ?>">
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label><?php echo e(__('وصف الموقع')); ?></label>
                                                    <textarea class="form-control js-editor"
                                                              rows="3"
                                                              name="general[description_en]">
                                                        <?php echo e(get_general_value('description_en')); ?>

                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="text-center">
                                            <button type="submit"
                                                    class="btn btn-primary btn-lg">
                                                <i class="la la-check"></i>
                                                <?php echo e(__('حفظ التغييرات')); ?>

                                            </button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </section>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/setting.blade.php ENDPATH**/ ?>