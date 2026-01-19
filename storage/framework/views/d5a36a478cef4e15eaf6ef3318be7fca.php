
<?php $__env->startSection('title', $page->title[app()->getLocale()]); ?>

<?php $__env->startSection('content'); ?>



<?php $__empty_1 = true; $__currentLoopData = $layouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

    
    <section class="w-full py-14 md:py-20">
        <div class="container mx-auto px-4">

            
            <div class="grid grid-cols-12 gap-6 md:gap-10">

                <?php $__currentLoopData = $layout['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php
                        $colSpan = (int) ($column['col'] ?? 12);
                        if ($colSpan < 1 || $colSpan > 12) {
                            $colSpan = 12;
                        }
                    ?>

                    <div class="col-span-12 lg:col-span-<?php echo e($colSpan); ?>">

                        
                        <?php $__empty_2 = true; $__currentLoopData = $column['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>

                            <?php
                                $data = is_array($section->data)
                                    ? $section->data
                                    : json_decode($section->data ?? '[]', true);
                            ?>

                            <div class="mb-10 last:mb-0">

                                <?php if ($__env->exists(
                                    'website.sections.' . $section->type,
                                    [
                                        'section' => $section,
                                        'data'    => $data,
                                        'page'    => $page,
                                        'col'     => $colSpan, // 👈 مهم كما طلبت
                                    ]
                                )) echo $__env->make(
                                    'website.sections.' . $section->type,
                                    [
                                        'section' => $section,
                                        'data'    => $data,
                                        'page'    => $page,
                                        'col'     => $colSpan, // 👈 مهم كما طلبت
                                    ]
                                , array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                          
                        <?php endif; ?>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </section>
    

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    
    <section class="py-24">
        <div class="container mx-auto px-4">
            <div class="rounded-2xl border border-white/10 bg-white/5 p-10 text-center">
                <h2 class="text-2xl font-bold mb-2">
                    لا يوجد محتوى بعد
                </h2>
                <p class="text-white/60">
                    هذه الصفحة لا تحتوي على أي أقسام حالياً
                </p>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/website/pages/preview.blade.php ENDPATH**/ ?>