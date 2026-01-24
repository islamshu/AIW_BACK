<?php
    use App\Models\Page;

    $footerPages = Page::where('status', 'published')
        ->orderBy('order')
        ->get();

    $excludedSlugs = ['home', 'sectors', 'contact'];
?>

<footer
    class="relative pt-20 pb-8 overflow-hidden"
    style="
        background: var(--bg-color);
        border-top: 1px solid
            color-mix(in srgb, var(--primary-color) 25%, transparent);
    "
>

    
    <div class="absolute inset-0 pointer-events-none">
        <div
            class="absolute -top-32 -right-32 w-96 h-96 rounded-full blur-3xl"
            style="
                background: var(--primary-color);
                opacity: .08;
            "
        ></div>

        <div
            class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full blur-3xl"
            style="
                background: var(--secondary-color);
                opacity: .08;
            "
        ></div>
    </div>

    <div class="relative container mx-auto px-4">

        
        <div class="max-w-3xl mx-auto text-center mb-16">
            <p
                class="text-sm md:text-base leading-relaxed"
                style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
            >
                <?php echo get_general_value('description_'.app()->getLocale()); ?>

            </p>

            <div
                class="w-24 h-[2px] mx-auto mt-6 rounded-full"
                style="
                    background: linear-gradient(
                        135deg,
                        var(--primary-color),
                        var(--secondary-color)
                    );
                "
            ></div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16 text-center md:text-start">

            
            <div class="flex justify-center md:justify-start">
                <img
                    src="<?php echo e(asset('storage/'.get_general_value('website_logo'))); ?>"
                    alt="Logo"
                    class="object-contain drop-shadow-xl
                           max-w-[180px] md:max-w-[220px] lg:max-w-[260px]"
                >
            </div>

            
            <div>
                <h5 class="font-semibold mb-4" style="color: var(--text-color)">
                    <?php echo e(app()->getLocale() === 'ar' ? 'روابط سريعة' : 'Quick Links'); ?>

                </h5>

                <ul class="space-y-3">
                    <li>
                        <a href="/"
                           class="transition"
                           style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                           onmouseover="this.style.color='var(--primary-color)'"
                           onmouseout="this.style.color='color-mix(in srgb, var(--text-color) 70%, transparent)'">
                            <?php echo e(app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home'); ?>

                        </a>
                    </li>

                    <?php $__currentLoopData = $footerPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(in_array($page->slug, $excludedSlugs)) continue; ?>
                        <li>
                            <a href="<?php echo e(url($page->slug)); ?>"
                               class="transition"
                               style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                               onmouseover="this.style.color='var(--primary-color)'"
                               onmouseout="this.style.color='color-mix(in srgb, var(--text-color) 70%, transparent)'">
                                <?php echo e($page->title[app()->getLocale()] ?? $page->title['ar']); ?>

                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if(get_general_value('sectors_enabled')): ?>
                        <li>
                            <a href="/sectors"
                               class="transition"
                               style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                               onmouseover="this.style.color='var(--primary-color)'"
                               onmouseout="this.style.color='color-mix(in srgb, var(--text-color) 70%, transparent)'">
                                <?php echo e(app()->getLocale() === 'ar' ? 'القطاعات' : 'Sectors'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a href="/contact"
                           class="transition"
                           style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                           onmouseover="this.style.color='var(--primary-color)'"
                           onmouseout="this.style.color='color-mix(in srgb, var(--text-color) 70%, transparent)'">
                            <?php echo e(app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact Us'); ?>

                        </a>
                    </li>
                </ul>
            </div>

            
            <div>
                <h5 class="font-semibold mb-4" style="color: var(--text-color)">
                    <?php echo e(app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Get in Touch'); ?>

                </h5>

                <ul
                    class="space-y-4 text-sm"
                    style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
                >
                    <li class="flex items-center justify-center md:justify-start gap-3">
                        <i class="fas fa-envelope" style="color: var(--primary-color)"></i>
                        <?php echo e(get_general_value('website_email')); ?>

                    </li>
                    <li class="flex items-center justify-center md:justify-start gap-3">
                        <i class="fas fa-phone" style="color: var(--primary-color)"></i>
                        <?php echo e(get_general_value('phone')); ?>

                    </li>
                </ul>
            </div>

        </div>

        
        <div
            class="pt-6 text-center text-sm"
            style="
                border-top: 1px solid
                    color-mix(in srgb, var(--primary-color) 25%, transparent);
                color: color-mix(in srgb, var(--text-color) 65%, transparent);
            "
        >
            © <?php echo e(date('Y')); ?>

            <span class="font-semibold" style="color: var(--text-color)">
                <?php echo e(get_general_value('website_name_'.app()->getLocale())); ?>

            </span>
            — <?php echo e(app()->getLocale() === 'ar' ? 'جميع الحقوق محفوظة.' : 'All rights reserved.'); ?>

        </div>

    </div>
</footer>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/inc/footer.blade.php ENDPATH**/ ?>