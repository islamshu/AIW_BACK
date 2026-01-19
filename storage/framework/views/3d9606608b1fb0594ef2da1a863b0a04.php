<?php $__env->startSection('title', __('اعدادات الموقع')); ?>

<?php $__env->startSection('content'); ?>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"><?php echo e(__('إعدادات الموقع')); ?></h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('الرئيسية')); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo e(__('إعدادات الموقع')); ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <section id="validation">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"><?php echo e(__('إعدادات الموقع')); ?></h4>
                                </div>

                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="<?php echo e(route('add_general')); ?>" method="post"
                                            enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>

                                            <!-- القسم العام -->
                                            <div class="form-section mb-4">
                                                <h5 class="section-title"><i class="ft-settings"></i>
                                                    <?php echo e(__('الإعدادات العامة')); ?></h5>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo e(__('شعار الموقع')); ?></label>
                                                            <div class="col-md-6 mb-3 type-field" id="imageField"></div>


                                                            
                                                            <input type="hidden" name="general[website_logo]"
                                                                id="imageInput"
                                                                value="<?php echo e(get_general_value('website_logo')); ?>">

                                                            <button type="button" class="btn btn-outline-primary w-100"
                                                                onclick="openMediaLibrary()">
                                                                📁 اختيار صورة من المكتبة
                                                            </button>

                                                            
                                                            <div class="mt-2">
                                                                <img id="imagePreview"
                                                                    src="<?php echo e(asset('storage/' . get_general_value('website_logo'))); ?>"
                                                                    class="img-thumbnail"
                                                                    style="max-height:120px">
                                                            </div>


                                                        </div>
                                                    </div>



                                                </div>

                                                <div class="row mt-2">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo e(__('البريد الإلكتروني')); ?></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="ft-mail"></i></span>
                                                                </div>
                                                                <input type="email"
                                                                    value="<?php echo e(get_general_value('website_email')); ?>"
                                                                    class="form-control" name="general[website_email]"
                                                                    placeholder="info@example.com">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo e(__('هاتف الموقع')); ?></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="ft-phone"></i></span>
                                                                </div>
                                                                <input type="text"
                                                                    value="<?php echo e(get_general_value('phone')); ?>"
                                                                    class="form-control" name="general[phone]"
                                                                    placeholder="+123456789">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>



                                    <!-- قسم اللغة العربية -->
                                    <div class="form-section mb-4">
                                        <h5 class="section-title"><i class="ft-flag"></i>
                                            <?php echo e(__('إعدادات اللغة العربية')); ?></h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo e(__('اسم الموقع')); ?></label>
                                                    <input type="text"
                                                        value="<?php echo e(get_general_value('website_name_ar')); ?>" required
                                                        class="form-control" name="general[website_name_ar]"
                                                        placeholder="اسم الموقع بالعربية">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo e(__('عنوان الموقع')); ?></label>
                                                    <input type="text"
                                                        value="<?php echo e(get_general_value('address_ar')); ?>" required
                                                        class="form-control" name="general[address_ar]"
                                                        placeholder="عنوان الموقع بالعربية">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo e(__('وصف الموقع')); ?></label>
                                                    <textarea name="general[description_ar]" class="form-control  js-editor" rows="2"
                                                        placeholder="وصف الموقع بالعربية"><?php echo e(get_general_value('description_ar')); ?></textarea>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <!-- قسم اللغة الانجليزية -->
                                    <div class="form-section mb-4">
                                        <h5 class="section-title"><i class="ft-flag"></i>
                                            <?php echo e(__('إعدادات اللغة الانجليزية')); ?></h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo e(__('اسم الموقع')); ?></label>
                                                    <input type="text"
                                                        value="<?php echo e(get_general_value('website_name_en')); ?>" required
                                                        class="form-control text-right" name="general[website_name_en]"
                                                        placeholder="اسم الموقع">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo e(__('عنوان الموقع')); ?></label>
                                                    <input type="text"
                                                        value="<?php echo e(get_general_value('address_en')); ?>" required
                                                        class="form-control" name="general[address_en]"
                                                        placeholder="عنوان الموقع بالانجليزية">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo e(__('وصف الموقع')); ?></label>
                                                    <textarea name="general[description_en]" class="form-control js-editor text-right" rows="2"
                                                        placeholder="وصف الموقع"><?php echo e(get_general_value('description_en')); ?></textarea>
                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                    <!-- زر الحفظ -->
                                    <div class="form-actions text-center mt-3">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="la la-check-square-o"></i> <?php echo e(__('حفظ التغييرات')); ?>

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

<?php $__env->startSection('script'); ?>
    <script>
        // Script for file input label update
        $(document).ready(function() {
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });

            // Image preview functionality
            function readURL(input, preview) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(preview).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".imagee").change(function() {
                readURL(this, '.image-previeww');
            });

            $(".image").change(function() {
                readURL(this, '.image-preview');
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/dashboard/setting.blade.php ENDPATH**/ ?>