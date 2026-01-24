<?php
    use App\Models\Page;
    use App\Models\Job;

    $navPages = Page::where('status', 'published')
        ->orderBy('order')
        ->get();

    $excludedSlugs = ['home', 'sectors', 'contact'];
    $logo = get_general_value('website_logo');

    $navPages = Page::where('status', 'published')
        ->orderBy('order')
        ->get();

    $excludedSlugs = ['home', 'sectors', 'contact'];
    $logo = get_general_value('website_logo');

    // 👇 هل يوجد وظائف منشورة؟
    $hasJobs = Job::where('is_active', 1)
        ->whereDate('publish_from', '<=', now())
        ->where(function ($q) {
            $q->whereNull('publish_to')
              ->orWhereDate('publish_to', '>=', now());
        })
        ->exists();
?>


<nav
    class="fixed top-0 w-full backdrop-blur-sm z-50 py-4"
    style="
        background: color-mix(in srgb, var(--bg-color) 92%, transparent);
        border-bottom: 1px solid
            color-mix(in srgb, var(--primary-color) 25%, transparent);
    "
>
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">

            
            <a href="/" class="flex items-center gap-4 group">
                <?php if($logo): ?>
                    <img
                        src="<?php echo e(asset('storage/' . $logo)); ?>"
                        alt="Logo"
                        class="h-16 md:h-20 w-auto max-w-[280px] object-contain
                               transition-transform duration-300
                               group-hover:scale-105"
                    >
                <?php else: ?>
                    <div
                        class="h-16 md:h-20 px-6 rounded-lg flex items-center justify-center text-white font-bold text-2xl"
                        style="
                            background: linear-gradient(
                                135deg,
                                var(--primary-color),
                                var(--secondary-color)
                            );
                        "
                    >
                        AIW
                    </div>
                <?php endif; ?>

                <div class="flex flex-col">
                    <span class="font-bold text-xl md:text-2xl"
                          style="color: var(--text-color)">
                        <?php echo get_general_value('website_name_'.app()->getLocale()); ?>

                    </span>
                </div>
            </a>

            
            <div class="hidden md:flex items-center gap-8">

                
                <a href="/"
                   class="flex gap-2 items-center transition-colors duration-300"
                   style="color: var(--text-color)"
                   onmouseover="this.style.color='var(--primary-color)'"
                   onmouseout="this.style.color='var(--text-color)'">
                    <i class="fas fa-home"></i>
                    <?php echo e(app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home'); ?>

                </a>

                
                <?php $__currentLoopData = $navPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(in_array($page->slug, $excludedSlugs)) continue; ?>

                    <a href="<?php echo e(url($page->slug)); ?>"
                       class="flex gap-2 items-center transition-colors duration-300"
                       style="color: var(--text-color)"
                       onmouseover="this.style.color='var(--primary-color)'"
                       onmouseout="this.style.color='var(--text-color)'">
                        <i class="fas fa-circle-dot text-xs"></i>
                        <?php echo e($page->title[app()->getLocale()] ?? $page->title['ar']); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php if(get_general_value('sectors_enabled')): ?>
                <a href="/sectors"
                   class="flex gap-2 items-center transition-colors duration-300"
                   style="color: var(--text-color)"
                   onmouseover="this.style.color='var(--primary-color)'"
                   onmouseout="this.style.color='var(--text-color)'">
                    <i class="fas fa-industry"></i>
                    <?php echo e(app()->getLocale() === 'ar' ? 'القطاعات' : 'Sectors'); ?>

                </a>
                <?php endif; ?>
                <?php if($hasJobs): ?>
                <a href="/jobs"
                class="flex gap-2 items-center transition-colors duration-300"
                style="color: var(--text-color)"
                onmouseover="this.style.color='var(--primary-color)'"
                onmouseout="this.style.color='var(--text-color)'">
                    <i class="fas fa-briefcase"></i>
                    <?php echo e(app()->getLocale() === 'ar' ? 'الوظائف' : 'Jobs'); ?>

                </a>
                <?php endif; ?>


                
                <a href="/contact"
                   class="flex gap-2 items-center transition-colors duration-300"
                   style="color: var(--text-color)"
                   onmouseover="this.style.color='var(--primary-color)'"
                   onmouseout="this.style.color='var(--text-color)'">
                    <i class="fas fa-envelope"></i>
                    <?php echo e(app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact Us'); ?>

                </a>

                
                <a href="<?php echo e(route('language.switch', app()->getLocale() === 'ar' ? 'en' : 'ar')); ?>"
                   class="px-5 py-2.5 rounded-full font-semibold text-white transition-all duration-300 hover:scale-105"
                   style="
                        background: linear-gradient(
                            135deg,
                            var(--primary-color),
                            var(--secondary-color)
                        );
                   ">
                    <?php echo e(app()->getLocale() === 'ar' ? 'English' : 'العربية'); ?>

                </a>
            </div>

            
            <button id="menuToggle"
                class="md:hidden text-2xl transition-colors duration-300"
                style="color: var(--text-color)"
                onmouseover="this.style.color='var(--primary-color)'"
                onmouseout="this.style.color='var(--text-color)'">
                <i class="fas fa-bars"></i>
            </button>

        </div>

        
        <div id="mobileMenu" class="hidden md:hidden mt-4">
            <div class="flex flex-col gap-4 py-4">

                <?php $__currentLoopData = ['/' => 'الرئيسية']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($url); ?>"
                   class="transition-colors duration-300"
                   style="color: var(--text-color)"
                   onmouseover="this.style.color='var(--primary-color)'"
                   onmouseout="this.style.color='var(--text-color)'">
                    <?php echo e(app()->getLocale() === 'ar' ? $label : 'Home'); ?>

                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $navPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(in_array($page->slug, $excludedSlugs)) continue; ?>
                    <a href="<?php echo e(url($page->slug)); ?>"
                       class="transition-colors duration-300"
                       style="color: var(--text-color)"
                       onmouseover="this.style.color='var(--primary-color)'"
                       onmouseout="this.style.color='var(--text-color)'">
                        <?php echo e($page->title[app()->getLocale()] ?? $page->title['ar']); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(get_general_value('sectors_enabled')): ?>

                <a href="/sectors"
                   class="transition-colors duration-300"
                   style="color: var(--text-color)"
                   onmouseover="this.style.color='var(--primary-color)'"
                   onmouseout="this.style.color='var(--text-color)'">
                    <?php echo e(app()->getLocale() === 'ar' ? 'القطاعات' : 'Sectors'); ?>

                </a>
                <?php endif; ?>
                <?php if($hasJobs): ?>
                <a href="/jobs"
                class="transition-colors duration-300"
                style="color: var(--text-color)"
                onmouseover="this.style.color='var(--primary-color)'"
                onmouseout="this.style.color='var(--text-color)'">
                    <?php echo e(app()->getLocale() === 'ar' ? 'الوظائف' : 'Jobs'); ?>

                </a>
                <?php endif; ?>

                <a href="/contact"
                   class="transition-colors duration-300"
                   style="color: var(--text-color)"
                   onmouseover="this.style.color='var(--primary-color)'"
                   onmouseout="this.style.color='var(--text-color)'">
                    <?php echo e(app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact Us'); ?>

                </a>

            </div>
        </div>

    </div>
</nav>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/inc/navbar.blade.php ENDPATH**/ ?>