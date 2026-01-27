<?php
    use App\Models\Page;
    use App\Models\Job;
    use App\Models\News;
    use App\Models\HomeService;
    use App\Models\Sector;

    $navPages = Page::where('status', 'published')
        ->orderBy('order')
        ->get();

    $excludedSlugs = ['home', 'sectors', 'contact'];
    $logo = get_general_value('website_logo');

    /* =========================
       CONTENT CHECKS
    ========================= */

    $hasNews = News::where('is_active', 1)
        ->whereDate('published_at', '<=', now())
        ->exists();

    $hasHomeServices = HomeService::where('is_active', true)->exists();

    $hasSectors = Sector::where('is_active', 1)->exists();

    $hasJobs = Job::where('is_active', 1)
        ->whereDate('publish_from', '<=', now())
        ->where(function ($q) {
            $q->whereNull('publish_to')
              ->orWhereDate('publish_to', '>=', now());
        })
        ->exists();

    $hasExtraPages = $navPages->whereNotIn('slug', $excludedSlugs)->count();
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
                        class="h-14 md:h-16 max-w-[220px] object-contain
                               transition-transform duration-300
                               group-hover:scale-105">
                <?php else: ?>
                    <div
                        class="h-14 md:h-16 px-6 rounded-lg flex items-center
                               justify-center text-white font-bold text-xl"
                        style="background:linear-gradient(
                            135deg,
                            var(--primary-color),
                            var(--secondary-color)
                        );">
                        AIW
                    </div>
                <?php endif; ?>

                <span class="font-bold text-lg md:text-xl"
                      style="color:var(--text-color)">
                    <?php echo get_general_value('website_name_'.app()->getLocale()); ?>

                </span>
            </a>

            
            <div class="hidden md:flex items-center gap-7 text-[15px]">

                
                <a href="/"
                   class="flex gap-2 items-center font-bold"
                   style="color:var(--primary-color)">
                    <i class="fas fa-home"></i>
                    <?php echo e(app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home'); ?>

                </a>
                
                <?php if($hasExtraPages): ?>
                <div class="relative group">

                    <a href="javascript:void(0)"
                    class="flex items-center gap-2 transition-colors
                           relative group"
                    style="color:var(--text-color)">
                 
                     <i class="fas fa-file-alt"></i>
                     <?php echo e(app()->getLocale() === 'ar' ? 'الصفحات' : 'Pages'); ?>

                     <i class="fas fa-chevron-down text-xs opacity-70"></i>
                 </a>
                 

                    <div
                        class="absolute top-full right-0 mt-3 min-w-[230px]
                               bg-white rounded-xl shadow-xl border border-gray-100
                               opacity-0 invisible group-hover:opacity-100
                               group-hover:visible transition-all duration-300 z-50">

                        <ul class="py-2">
                            <?php $__currentLoopData = $navPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(in_array($page->slug, $excludedSlugs)) continue; ?>
                                <li>
                                    <a href="<?php echo e(url($page->slug)); ?>"
                                       class="flex items-center gap-3 px-4 py-2 text-sm
                                              hover:bg-gray-50 transition">
                                        <i class="fas fa-circle-dot text-[8px] text-gray-400"></i>
                                        <?php echo e($page->title[app()->getLocale()] ?? $page->title['ar']); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>

                
                <?php if(get_general_value('services_enabled') && $hasHomeServices): ?>
                <a href="/services"
                   class="flex gap-2 items-center transition-colors"
                   style="color:var(--text-color)">
                    <i class="fas fa-layer-group"></i>
                    <?php echo e(app()->getLocale() === 'ar' ? 'الخدمات' : 'Services'); ?>

                </a>
                <?php endif; ?>

                
                <?php if(get_general_value('news_enabled') && $hasNews): ?>
                <a href="/news"
                   class="flex gap-2 items-center transition-colors"
                   style="color:var(--text-color)">
                    <i class="fas fa-newspaper"></i>
                    <?php echo e(app()->getLocale() === 'ar' ? 'الأخبار' : 'News'); ?>

                </a>
                <?php endif; ?>

                
                <?php if(get_general_value('sectors_enabled') && $hasSectors): ?>
                <a href="/sectors"
                   class="flex gap-2 items-center transition-colors"
                   style="color:var(--text-color)">
                    <i class="fas fa-industry"></i>
                    <?php echo e(app()->getLocale() === 'ar' ? 'القطاعات' : 'Sectors'); ?>

                </a>
                <?php endif; ?>

                
                <?php if($hasJobs): ?>
                <a href="/jobs"
                   class="flex gap-2 items-center transition-colors"
                   style="color:var(--text-color)">
                    <i class="fas fa-briefcase"></i>
                    <?php echo e(app()->getLocale() === 'ar' ? 'الوظائف' : 'Jobs'); ?>

                </a>
                <?php endif; ?>

                

                
                <a href="/contact"
                   class="flex gap-2 items-center transition-colors"
                   style="color:var(--text-color)">
                    <i class="fas fa-envelope"></i>
                    <?php echo e(app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact Us'); ?>

                </a>

                
                <a href="<?php echo e(route('language.switch', app()->getLocale() === 'ar' ? 'en' : 'ar')); ?>"
                   class="px-5 py-2.5 rounded-full font-semibold text-white
                          transition-all hover:scale-105"
                   style="background:linear-gradient(
                        135deg,
                        var(--primary-color),
                        var(--secondary-color)
                   );">
                    <?php echo e(app()->getLocale() === 'ar' ? 'English' : 'العربية'); ?>

                </a>
            </div>

            
            <button id="menuToggle"
                    class="md:hidden text-2xl"
                    style="color:var(--text-color)">
                <i class="fas fa-bars"></i>
            </button>

        </div>

        
        <div id="mobileMenu" class="hidden md:hidden mt-4">
            <div class="flex flex-col gap-4 py-4">

                <a href="/"><?php echo e(app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home'); ?></a>

                <?php if(get_general_value('services_enabled') && $hasHomeServices): ?>
                    <a href="/services"><?php echo e(app()->getLocale() === 'ar' ? 'الخدمات' : 'Services'); ?></a>
                <?php endif; ?>

                <?php if(get_general_value('news_enabled') && $hasNews): ?>
                    <a href="/news"><?php echo e(app()->getLocale() === 'ar' ? 'الأخبار' : 'News'); ?></a>
                <?php endif; ?>

                <?php if(get_general_value('sectors_enabled') && $hasSectors): ?>
                    <a href="/sectors"><?php echo e(app()->getLocale() === 'ar' ? 'القطاعات' : 'Sectors'); ?></a>
                <?php endif; ?>

                <?php if($hasJobs): ?>
                    <a href="/jobs"><?php echo e(app()->getLocale() === 'ar' ? 'الوظائف' : 'Jobs'); ?></a>
                <?php endif; ?>

                
                <?php $__currentLoopData = $navPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(in_array($page->slug, $excludedSlugs)) continue; ?>
                    <a href="<?php echo e(url($page->slug)); ?>">
                        <?php echo e($page->title[app()->getLocale()] ?? $page->title['ar']); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <a href="/contact">
                    <?php echo e(app()->getLocale() === 'ar' ? 'اتصل بنا' : 'Contact Us'); ?>

                </a>
            </div>
        </div>

    </div>
</nav>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/inc/navbar.blade.php ENDPATH**/ ?>