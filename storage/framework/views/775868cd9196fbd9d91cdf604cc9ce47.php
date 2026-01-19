<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title','AIW'); ?></title>
    
    <!-- Favicons متعددة التنسيقات -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('storage/' . get_general_value('website_logo'))); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('storage/' . get_general_value('website_logo'))); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('storage/' . get_general_value('website_logo'))); ?>">
    <link rel="manifest" href="<?php echo e(asset('storage/' . get_general_value('website_logo'))); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('storage/' . get_general_value('website_logo'))); ?>" type="image/x-icon">

    
    <script src="https://cdn.tailwindcss.com"></script>

    
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&family=Poppins:wght@300;400;500;600&display=swap"
          rel="stylesheet">

    
    <style>
        :root {
            --navy: #0a192f;
            --sky-blue: #00b4d8;
            --pink: #ff5d8f;
        }

        body {
            font-family: 'Cairo', sans-serif;
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
        body[dir="ltr"] {
            font-family: 'Poppins', sans-serif;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity .8s ease, transform .8s ease;
        }

        .fade-in.appear {
            opacity: 1;
            transform: translateY(0);
        }

        .slide-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: opacity .8s ease, transform .8s ease;
        }

        .slide-in-left.appear {
            opacity: 1;
            transform: translateX(0);
        }

        .slide-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition: opacity .8s ease, transform .8s ease;
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

        .card-hover {
            transition: all .3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px -15px rgba(2,12,27,.7);
        }
    </style>

    <?php echo $__env->yieldContent('style'); ?>
</head>

<body class="bg-[#0a192f] text-white">





<?php echo $__env->make('frontend.inc.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>



<main class="pt-32">
    <?php echo $__env->yieldContent('content'); ?>
</main>




<?php echo $__env->make('frontend.inc.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<div class="fixed bottom-8 left-8 flex flex-col gap-4 z-40">
    <button id="scrollTop"
            class="w-12 h-12 rounded-full bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f]
                   flex items-center justify-center">
        <i class="fas fa-arrow-up"></i>
    </button>
</div>


<script>
    document.getElementById('menuToggle')?.addEventListener('click', () => {
        document.getElementById('mobileMenu')?.classList.toggle('hidden');
    });

    document.getElementById('scrollTop')?.addEventListener('click', () => {
        window.scrollTo({top:0,behavior:'smooth'});
    });
</script>

<?php echo $__env->yieldContent('script'); ?>
<script>
document.addEventListener('DOMContentLoaded', () => {

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('appear');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.2
    });

    document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right')
        .forEach(el => observer.observe(el));

});
</script>
<?php echo $__env->yieldContent('scripts'); ?>

</body>
</html>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/layouts/frontend.blade.php ENDPATH**/ ?>