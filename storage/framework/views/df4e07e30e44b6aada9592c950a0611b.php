<nav class="fixed top-0 w-full bg-[#0a192f]/95 backdrop-blur-sm z-50 py-4 border-b border-[#00b4d8]/10">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">

            
            <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f]
                            rounded-lg flex items-center justify-center">
                    <span class="font-bold text-xl">AIW</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-lg">Advanced Innovation Works</span>
                    <span class="text-[#00b4d8] text-sm">
                        Multi-Sector Investment & Operations Group
                    </span>
                </div>
            </a>

            
            <div class="hidden md:flex items-center gap-8">

                
                <a href="<?php echo e(url('/')); ?>" class="text-[#a8b2d1] hover:text-[#00b4d8] flex gap-2">
                    <i class="fas fa-home"></i>
                    <?php echo e(__('الرئيسية')); ?>

                </a>

                
                <?php $__currentLoopData = $navPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(in_array($page->slug, ['home', 'sectors', 'contact'])) continue; ?>

                    <a href="<?php echo e(url($page->slug)); ?>"
                       class="text-[#a8b2d1] hover:text-[#00b4d8] flex gap-2">
                        <i class="fas fa-circle-dot text-xs mt-1"></i>
                        <?php echo e($page->title[app()->getLocale()] ?? $page->title['ar']); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <a href="<?php echo e(route('sectors.index')); ?>"
                   class="text-[#a8b2d1] hover:text-[#00b4d8] flex gap-2">
                    <i class="fas fa-industry"></i>
                    <?php echo e(__('القطاعات')); ?>

                </a>

                
                <a href="<?php echo e(url('/contact')); ?>"
                   class="text-[#a8b2d1] hover:text-[#00b4d8] flex gap-2">
                    <i class="fas fa-envelope"></i>
                    <?php echo e(__('اتصل بنا')); ?>

                </a>

                
                <a href="<?php echo e(route('language.switch', app()->getLocale() === 'ar' ? 'en' : 'ar')); ?>"
                   class="bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f]
                          text-white px-4 py-2 rounded-full font-semibold">
                    <?php echo e(app()->getLocale() === 'ar' ? 'English' : 'العربية'); ?>

                </a>

            </div>

            
            <button id="menuToggle" class="md:hidden text-2xl">
                <i class="fas fa-bars"></i>
            </button>

        </div>

        
        <div id="mobileMenu" class="hidden md:hidden mt-4">
            <div class="flex flex-col gap-4 py-4">

                <a href="<?php echo e(url('/')); ?>" class="text-[#a8b2d1] hover:text-[#00b4d8]">
                    <?php echo e(__('الرئيسية')); ?>

                </a>

                <?php $__currentLoopData = $navPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(in_array($page->slug, ['home', 'sectors', 'contact'])) continue; ?>

                    <a href="<?php echo e(url($page->slug)); ?>"
                       class="text-[#a8b2d1] hover:text-[#00b4d8]">
                        <?php echo e($page->title[app()->getLocale()] ?? $page->title['ar']); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <a href="<?php echo e(route('sectors.index')); ?>" class="text-[#a8b2d1] hover:text-[#00b4d8]">
                    <?php echo e(__('القطاعات')); ?>

                </a>
                <?php
                    $jobs  = App\Models\Job::query()
            ->where('is_active', 1)
            ->whereDate('publish_from', '<=', now())
            ->where(function ($q) {
                $q->whereNull('publish_to')
                  ->orWhereDate('publish_to', '>=', now());
            })
            ->get();
                ?>
                <?php echo e(dd(vars: $jobs)); ?>

                <?php if($jobs): ?>
                <a href="<?php echo e(route('jobs.index')); ?>" class="text-[#a8b2d1] hover:text-[#00b4d8]">
                    <?php echo e(__('الوظائف')); ?>

                </a>
                <?php endif; ?>
                <a href="<?php echo e(url('/contact')); ?>" class="text-[#a8b2d1] hover:text-[#00b4d8]">
                    <?php echo e(__('اتصل بنا')); ?>

                </a>

            </div>
        </div>

    </div>
</nav>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/inc/nav.blade.php ENDPATH**/ ?>