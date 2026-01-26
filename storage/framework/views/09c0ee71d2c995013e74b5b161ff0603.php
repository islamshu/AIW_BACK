
<?php
$latestNews = App\Models\News::where('is_active', true)
    ->whereNotNull('published_at')
    ->orderByDesc('published_at')
    ->take(3)
    ->get();
$count = App\Models\News::where('is_active', true)->count();

?>
<?php if($count > 0): ?>
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
   
        
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold mb-2">
                <?php echo e(app()->getLocale() === 'ar' ? 'آخر الاخبار' : 'Latest News'); ?>


            </h2>
            <p class="text-gray-500">
                <?php echo e(app()->getLocale() === 'ar' ? 'تابع أحدث المستجدات وأخبار الشركة' : 'Follow the latest updates and company news.'); ?>

            </p>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <?php $__currentLoopData = $latestNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">

                    
                    <div class="h-48 overflow-hidden">
                        <img src="<?php echo e(asset('storage/' . $news->image)); ?>" class="w-full h-full object-cover">
                    </div>

                    
                    <div class="p-6">
                        <span class="text-sm text-gray-400">
                            <?php echo e($news->published_at->format('Y-m-d')); ?>

                        </span>

                        <h3 class="font-bold text-lg mt-2 mb-3">
                            <?php echo e($news->title); ?>

                        </h3>

                        <p class="text-gray-600 text-sm mb-4">
                            <?php echo e(Str::limit($news->excerpt, 120)); ?>

                        </p>

                        <a href="<?php echo e(route('news.show', $news)); ?>" class="text-primary font-semibold hover:underline">
                            <?php echo e(app()->getLocale() === 'ar' ? 'اقرأ المزيد' : 'Read More'); ?>

                            →
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        
        <?php if(get_general_value(key: 'news_enabled') && $count > count($latestNews)): ?>
            <div class="text-center mt-16 fade-in">
                <a href="<?php echo e(route('news.index')); ?>"
                    class="inline-flex items-center gap-3 px-12 py-4 rounded-full font-bold text-white
                       transition-all duration-300 hover:scale-105 hover:shadow-2xl"
                    style="
                    background: linear-gradient(
                        135deg,
                        var(--primary-color),
                        var(--secondary-color)
                    );
                ">
                    <?php echo e(app()->getLocale() === 'ar' ? 'رؤية جميع الاخبار' : 'View All News'); ?>

                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sections/news.blade.php ENDPATH**/ ?>