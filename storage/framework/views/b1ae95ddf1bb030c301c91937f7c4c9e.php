<section class="py-16 bg-[#112240]">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <?php $__currentLoopData = App\Models\HomeStat::orderby('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                <div class="text-center fade-in">
                    <div class="text-3xl md:text-4xl font-bold gradient-text mb-2"><?php echo e($sta->value); ?></div>
                    <div class="text-[#a8b2d1]" > <?php echo e($sta->label); ?> </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

           
            </div>
        </div>
    </section><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sections/statistic.blade.php ENDPATH**/ ?>