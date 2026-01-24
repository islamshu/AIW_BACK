<?php $__env->startSection('title', __('القطاعات الاستراتيجية')); ?>

<?php $__env->startSection('style'); ?>
<style>
/* ===============================
   GLOBAL ANIMATIONS
================================ */
.fade-in {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity .8s ease, transform .8s ease;
}
.fade-in.appear {
    opacity: 1;
    transform: translateY(0);
}

/* ===============================
   HOVER EFFECTS
================================ */
.card-hover {
    transition: .35s ease;
}
.card-hover:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px -20px
        color-mix(in srgb, var(--primary-color) 35%, transparent);
}

/* ===============================
   GRADIENT TEXT
================================ */
.gradient-text {
    background: linear-gradient(
        to right,
        var(--primary-color),
        var(--secondary-color)
    );
    -webkit-background-clip: text;
    color: transparent;
}

/* ===============================
   SECTOR CARD
================================ */
.sector-card {
    position: relative;
    overflow: hidden;
    background: color-mix(in srgb, var(--bg-color) 92%, white);
    border: 1px solid color-mix(in srgb, var(--primary-color) 10%, transparent);
    border-radius: 1.25rem;
}

.sector-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 90px;
    height: 90px;
    background: linear-gradient(
        135deg,
        var(--primary-color),
        var(--secondary-color)
    );
    border-radius: 0 0 0 90px;
    opacity: .08;
}

.sector-icon {
    transition: .4s ease;
}
.sector-card:hover .sector-icon {
    transform: scale(1.15) rotate(6deg);
}

/* ===============================
   BADGE
================================ */
.sector-badge {
    position: absolute;
    top: 16px;
    left: 16px;
    background: linear-gradient(
        135deg,
        var(--primary-color),
        var(--secondary-color)
    );
    color: #fff;
    padding: 6px 16px;
    border-radius: 999px;
    font-size: .75rem;
    font-weight: 700;
}

/* ===============================
   MARKET BAR
================================ */
.market-size-bar {
    height: 8px;
    border-radius: 999px;
    background: linear-gradient(
        to right,
        var(--primary-color),
        var(--secondary-color)
    );
    transition: width 1.5s ease;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<section
    class="pt-32 pb-20 relative overflow-hidden"
    style="
        background: linear-gradient(
            135deg,
            var(--bg-color),
            color-mix(in srgb, var(--bg-color) 85%, white)
        );
    "
>
    <div class="container mx-auto px-4 text-center">

        <h1 class="text-4xl md:text-5xl font-extrabold mb-6 gradient-text fade-in">
            <?php echo e(__('القطاعات الاستراتيجية')); ?>

        </h1>

        <p
            class="text-xl max-w-3xl mx-auto fade-in"
            style="color: color-mix(in srgb, var(--text-color) 70%, transparent);"
        >
            <?php echo e(__('نركز على القطاعات ذات النمو المرتفع والإمكانيات الكبيرة في الأسواق المحلية والإقليمية')); ?>

        </p>

    </div>
</section>


<section
    class="py-20"
    style="background: var(--bg-color)"
>
    <div class="container mx-auto px-4">

        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
            id="sectors-wrapper"
        >

            <?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="sector-card card-hover fade-in">

                    
                    <div class="relative h-48 overflow-hidden">

                        <?php if($sector->badge_text): ?>
                            <div class="sector-badge">
                                <?php echo e($sector->getTranslation('badge_text', app()->getLocale())); ?>

                            </div>
                        <?php endif; ?>

                        <div
                            class="w-full h-full flex items-center justify-center"
                            style="
                                background: linear-gradient(
                                    135deg,
                                    <?php echo e($sector->gradient_from); ?>,
                                    <?php echo e($sector->gradient_to); ?>

                                );
                            "
                        >
                            <?php if($sector->icon): ?>
                                <i class="<?php echo e($sector->icon); ?> text-white text-6xl sector-icon"></i>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="p-6">

                        <h3 class="text-xl font-bold mb-3" style="color: var(--text-color)">
                            <?php echo e($sector->getTranslation('title', app()->getLocale())); ?>

                        </h3>

                        <p
                            class="mb-4 text-sm leading-relaxed"
                            style="color: color-mix(in srgb, var(--text-color) 65%, transparent);"
                        >
                            <?php echo $sector->getTranslation('description', app()->getLocale()); ?>

                        </p>

                        
                        <?php if($sector->market_value && $sector->market_percent): ?>
                            <div class="mb-2 flex justify-between text-sm">
                                <span style="color: color-mix(in srgb, var(--text-color) 60%, transparent);">
                                    <?php echo e(__('حجم السوق')); ?>

                                </span>

                                <span class="font-bold" style="color: var(--primary-color)">
                                    <?php echo e($sector->market_value); ?>B
                                </span>
                            </div>

                            <div class="w-full bg-black/20 rounded-full overflow-hidden">
                                <div
                                    class="market-size-bar"
                                    style="width: <?php echo e($sector->market_percent); ?>%"
                                ></div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        
        <div class="text-center mt-14">
            <button
                id="load-more"
                class="px-12 py-3 rounded-full font-bold text-white
                       transition hover:scale-105 hover:shadow-xl"
                style="
                    background: linear-gradient(
                        135deg,
                        var(--primary-color),
                        var(--secondary-color)
                    );
                "
            >
                <?php echo e(__('تحميل المزيد')); ?>

            </button>
        </div>

    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
let offset = <?php echo e($sectors->count()); ?>;
let loading = false;

document.getElementById('load-more')?.addEventListener('click', () => {
    if (loading) return;
    loading = true;

    fetch(`<?php echo e(route('sectors.loadMore')); ?>?offset=${offset}`)
        .then(res => res.text())
        .then(html => {
            if (!html.trim()) {
                document.getElementById('load-more').remove();
                return;
            }

            document
                .getElementById('sectors-wrapper')
                .insertAdjacentHTML('beforeend', html);

            offset += 3;
            loading = false;
        });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sectors.blade.php ENDPATH**/ ?>