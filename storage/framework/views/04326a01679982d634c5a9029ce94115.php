<?php
    use App\Models\Page;

    $footerPages = Page::where('status', 'published')
        ->orderBy('order')
        ->get();

    $excludedSlugs = ['home', 'sectors', 'contact'];
?>

<footer class="relative bg-[#0a192f] border-t border-[#00b4d8]/10 pt-20 pb-8 overflow-hidden">

    
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-[#00b4d8]/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-[#ff5d8f]/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative container mx-auto px-4">

        
        <div class="max-w-3xl mx-auto text-center mb-16">
            <p class="text-[#8892b0] text-sm md:text-base leading-relaxed">
                <?php echo get_general_value('description_'.app()->getLocale()); ?>

            </p>

            <div class="w-24 h-[2px] bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f]
                        mx-auto mt-6 rounded-full"></div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16 text-center md:text-start">

            
            <div class="flex justify-center md:justify-start">
                <img
                    src="<?php echo e(asset('storage/'.get_general_value('website_logo'))); ?>"
                    alt="AIW Logo"
                    class="object-contain drop-shadow-xl w-auto h-auto
                           max-w-[180px] md:max-w-[220px] lg:max-w-[260px]">
            </div>

            
            <div>
                <h5 class="text-white font-semibold mb-4">
                    <?php echo e(app()->getLocale() === 'ar' ? 'روابط سريعة' : 'Quick Links'); ?>

                </h5>

                <ul class="space-y-3">
                    <li>
                        <a href="/" class="text-[#8892b0] hover:text-[#00b4d8] transition">
                            <?php echo e(app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home'); ?>

                        </a>
                    </li>

                    <?php $__currentLoopData = $footerPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(in_array($page->slug, $excludedSlugs)) continue; ?>
                        <li>
                            <a href="<?php echo e(url($page->slug)); ?>"
                               class="text-[#8892b0] hover:text-[#00b4d8] transition">
                                <?php echo e($page->title[app()->getLocale()] ?? $page->title['ar']); ?>

                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if(get_general_value('sectors_enabled')): ?>
                        <li>
                            <a href="/sectors" class="text-[#8892b0] hover:text-[#00b4d8] transition">
                                <?php echo e(app()->getLocale() === 'ar' ? 'القطاعات' : 'Sectors'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a href="/contact" class="text-[#8892b0] hover:text-[#00b4d8] transition">
                            <?php echo e(app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact Us'); ?>

                        </a>
                    </li>
                </ul>
            </div>

            
            <div>
                <h5 class="text-white font-semibold mb-4">
                    <?php echo e(app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Get in Touch'); ?>

                </h5>

                <ul class="space-y-4 text-[#8892b0] text-sm">
                    <li class="flex items-center justify-center md:justify-start gap-3">
                        <i class="fas fa-envelope text-[#00b4d8]"></i>
                        <?php echo e(get_general_value('website_email')); ?>

                    </li>
                    <li class="flex items-center justify-center md:justify-start gap-3">
                        <i class="fas fa-phone text-[#00b4d8]"></i>
                        <?php echo e(get_general_value('phone')); ?>

                    </li>
                </ul>
            </div>

        </div>

        
        <div class="border-t border-[#00b4d8]/10 pt-6 text-center text-[#8892b0] text-sm">

            <p class="mb-1">
                © <?php echo e(date('Y')); ?>

                <span class="text-white font-semibold">
                    <?php echo e(get_general_value('website_name_'.app()->getLocale())); ?>

                </span>
                — <?php echo e(app()->getLocale() === 'ar' ? 'جميع الحقوق محفوظة.' : 'All rights reserved.'); ?>

            </p>
        
          
        
        </div>
        

    </div>
</footer>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/inc/footer.blade.php ENDPATH**/ ?>