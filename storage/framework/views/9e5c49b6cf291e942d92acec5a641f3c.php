

<?php $__env->startSection('title', app()->getLocale() === 'ar' ? 'التقديم على وظيفة' : 'Apply for a Job'); ?>

<?php $__env->startSection('content'); ?>
<section
    class="pt-32 pb-24 relative overflow-hidden"
    style="background: var(--bg-color);"
>

    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full blur-3xl"
             style="background: var(--primary-color); opacity:.06"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full blur-3xl"
             style="background: var(--secondary-color); opacity:.06"></div>
    </div>

    <div class="container mx-auto px-4 max-w-5xl relative z-10">

        
        <div class="mb-20 text-center fade-in">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-4"
                style="color: var(--text-color)">
                <?php echo e(app()->getLocale() === 'ar'
                    ? 'التقديم على الوظائف المتاحة'
                    : 'Apply for Available Jobs'); ?>

            </h1>

            <p class="max-w-2xl mx-auto leading-relaxed"
               style="color: color-mix(in srgb, var(--text-color) 70%, transparent)">
                <?php echo e(app()->getLocale() === 'ar'
                    ? 'اختر الوظيفة المناسبة لك، اطّلع على المؤهلات المطلوبة ثم قدّم طلبك بكل سهولة.'
                    : 'Choose the position that suits you, review the requirements and submit your application easily.'); ?>

            </p>
        </div>

        
        <div class="mb-14 fade-in">
            <label class="block mb-3 font-semibold"
                   style="color: var(--text-color)">
                <?php echo e(app()->getLocale() === 'ar' ? 'الوظائف المتاحة' : 'Available Jobs'); ?>

            </label>

            <select id="jobSelect"
                class="w-full rounded-xl px-4 py-3 focus:outline-none transition"
                style="
                    background: #fff;
                    border: 1px solid color-mix(in srgb, var(--primary-color) 30%, transparent);
                    color: var(--text-color);
                ">

                <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($job->id); ?>"
                        <?php echo e(($selectedJob?->id ?? null) == $job->id ? 'selected' : ''); ?>>
                        <?php echo e($job->getTranslation('title', app()->getLocale())); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        
        <div class="mb-20 fade-in">
            <div class="rounded-2xl p-8"
                 style="
                    background: #ffffff;
                    border: 1px solid color-mix(in srgb, var(--primary-color) 18%, transparent);
                 ">

                <h2 class="text-lg font-bold mb-4"
                    style="color: var(--primary-color)">
                    <?php echo e(app()->getLocale() === 'ar'
                        ? 'المتطلبات الوظيفية'
                        : 'Job Requirements'); ?>

                </h2>

                <div id="requirementsBox"
                     class="leading-relaxed"
                     style="color: color-mix(in srgb, var(--text-color) 80%, transparent)">

                    <?php if($selectedJob): ?>
                        <?php echo $selectedJob->getTranslation('requirements', app()->getLocale()); ?>

                    <?php else: ?>
                        <span style="color: color-mix(in srgb, var(--text-color) 60%, transparent)">
                            <?php echo e(app()->getLocale() === 'ar'
                                ? 'اختر وظيفة لعرض المتطلبات'
                                : 'Select a job to view requirements'); ?>

                        </span>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        
        <div class="fade-in">
            <div class="rounded-2xl p-8"
                 style="
                    background: #ffffff;
                    border: 1px solid color-mix(in srgb, var(--primary-color) 18%, transparent);
                 ">

                <h2 class="text-xl font-bold mb-8"
                    style="color: var(--text-color)">
                    <?php echo e(app()->getLocale() === 'ar'
                        ? 'نموذج التقديم'
                        : 'Application Form'); ?>

                </h2>

                <form id="applyForm"
                      enctype="multipart/form-data"
                      class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="job_id" id="jobId"
                           value="<?php echo e($selectedJob?->id); ?>">

                    
                    <div>
                        <label class="block mb-2 text-sm font-semibold"
                               style="color: var(--text-color)">
                            <?php echo e(app()->getLocale() === 'ar' ? 'الاسم الكامل' : 'Full Name'); ?>

                        </label>
                        <input type="text" name="name" required
                               class="w-full px-4 py-3 rounded-xl focus:outline-none"
                               style="border:1px solid #e5e7eb">
                    </div>

                    
                    <div>
                        <label class="block mb-2 text-sm font-semibold"
                               style="color: var(--text-color)">
                            <?php echo e(app()->getLocale() === 'ar' ? 'رقم الهاتف' : 'Phone Number'); ?>

                        </label>
                        <input type="text" name="phone" required
                               class="w-full px-4 py-3 rounded-xl focus:outline-none"
                               style="border:1px solid #e5e7eb">
                    </div>

                    
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold"
                               style="color: var(--text-color)">
                            CV
                        </label>
                        <input type="file" name="cv" required
                               accept=".pdf,.doc,.docx"
                               class="w-full px-4 py-3 rounded-xl"
                               style="border:1px solid #e5e7eb">
                    </div>

                    
                    <div class="md:col-span-2 flex justify-end mt-6">
                        <button type="submit"
                            class="px-10 py-3 rounded-full font-bold text-white transition hover:scale-105"
                            style="
                                background: linear-gradient(
                                    135deg,
                                    var(--primary-color),
                                    var(--secondary-color)
                                );
                            ">
                            <?php echo e(app()->getLocale() === 'ar' ? 'إرسال الطلب' : 'Submit Application'); ?>

                        </button>
                    </div>
                </form>

                <div id="formMessage" class="mt-4 hidden"></div>
            </div>
        </div>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/website/jobs/apply.blade.php ENDPATH**/ ?>