
<?php $__env->startSection('title','القطاعات'); ?>
<?php $__env->startSection('style'); ?>
<style>
    :root {
        --navy: #0a192f;
        --sky-blue: #00b4d8;
        --pink: #ff5d8f;
    }
    
    body {
        font-family: 'Cairo', sans-serif;
    }
    
    body[dir="ltr"] {
        font-family: 'Poppins', sans-serif;
    }
    
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }
    
    .fade-in.appear {
        opacity: 1;
        transform: translateY(0);
    }
    
    .slide-in-left {
        opacity: 0;
        transform: translateX(-50px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }
    
    .slide-in-left.appear {
        opacity: 1;
        transform: translateX(0);
    }
    
    .slide-in-right {
        opacity: 0;
        transform: translateX(50px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }
    
    .slide-in-right.appear {
        opacity: 1;
        transform: translateX(0);
    }
    
    .gradient-text {
        background: linear-gradient(to right, var(--sky-blue), var(--pink));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .nav-link-hover::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 0;
        height: 2px;
        background: var(--sky-blue);
        transition: all 0.3s ease;
    }
    
    .nav-link-hover:hover::after {
        width: 100%;
    }
    
    .card-hover {
        transition: all 0.3s ease;
    }
    
    .card-hover:hover {
        transform: translateY(-10px);
        border-color: var(--sky-blue);
        box-shadow: 0 10px 30px -15px rgba(2, 12, 27, 0.7);
    }
    
    .sector-card {
        position: relative;
        overflow: hidden;
    }
    
    .sector-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--sky-blue), var(--pink));
        border-radius: 0 0 0 80px;
        opacity: 0.1;
    }
    
    .sector-icon {
        transition: all 0.5s ease;
    }
    
    .sector-card:hover .sector-icon {
        transform: scale(1.1) rotate(5deg);
    }
    
    .sector-image {
        transition: all 0.5s ease;
    }
    
    .sector-image:hover {
        transform: scale(1.05);
    }
    
    .sector-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: linear-gradient(135deg, var(--sky-blue), var(--pink));
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: bold;
    }
    
    .market-size-bar {
        height: 8px;
        background: linear-gradient(to right, var(--sky-blue), var(--pink));
        border-radius: 4px;
        transition: width 1.5s ease-in-out;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="pt-32 pb-20 bg-gradient-to-br from-[#0a192f] to-[#112240] relative overflow-hidden">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">
            <?php echo e(__('القطاعات الاستراتيجية')); ?>

        </h1>
        <p class="text-xl text-[#a8b2d1] max-w-3xl mx-auto">
            <?php echo e(__('نركز على القطاعات ذات النمو المرتفع والإمكانيات الكبيرة في الأسواق المحلية والإقليمية')); ?>

        </p>
    </div>
</section>


<section class="py-20 bg-[#112240]">
    <div class="container mx-auto px-4">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="sectors-wrapper">
            <?php echo $__env->make('frontend.sectors_partials', ['sectors' => $sectors], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        
        <div class="text-center mt-12">
            <button id="load-more"
                class="bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f]
                text-white font-bold py-3 px-10 rounded-full
                hover:shadow-xl transition">
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

document.getElementById('load-more').addEventListener('click', function () {
    if (loading) return;
    loading = true;

    fetch(`<?php echo e(route('sectors.loadMore')); ?>?offset=${offset}`)
        .then(res => res.text())
        .then(html => {
            if (html.trim() === '') {
                document.getElementById('load-more').remove();
                return;
            }

            document.getElementById('sectors-wrapper').insertAdjacentHTML('beforeend', html);
            offset += 3;
            loading = false;
        });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/sectors.blade.php ENDPATH**/ ?>