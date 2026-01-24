<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>"
      dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title','AIW'); ?></title>

    
    <link rel="icon" href="<?php echo e(asset('storage/' . get_general_value('website_logo'))); ?>">

    
    <script src="https://cdn.tailwindcss.com"></script>

    
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&family=Poppins:wght@300;400;500;600&display=swap"
          rel="stylesheet">

    
    <style>
        :root {
            /* ألوان من لوحة التحكم */
            --bg-color: <?php echo e(get_general_value('bg_color') ?? '#0a192f'); ?>;
            --text-color: <?php echo e(get_general_value('text_color') ?? '#e6f1ff'); ?>;
            --primary-color: <?php echo e(get_general_value('prime_color') ?? '#00b4d8'); ?>;
            --secondary-color: <?php echo e(get_general_value('second_color') ?? '#ff5d8f'); ?>;
        }

        body {
            margin: 0;
            font-family: 'Cairo', sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
        }

        body[dir="ltr"] {
            font-family: 'Poppins', sans-serif;
        }

        /* ================= UTILITIES ================= */

        .gradient-bg {
            background: linear-gradient(
                135deg,
                var(--primary-color),
                var(--secondary-color)
            );
        }

        .gradient-text {
            background: linear-gradient(
                135deg,
                var(--primary-color),
                var(--secondary-color)
            );
            -webkit-background-clip: text;
            color: transparent;
        }

        .text-primary {
            color: var(--primary-color);
        }

        .border-primary {
            border-color: var(--primary-color);
        }

        .soft-bg {
            background:
                linear-gradient(
                    135deg,
                    color-mix(in srgb, var(--primary-color) 10%, transparent),
                    color-mix(in srgb, var(--secondary-color) 10%, transparent)
                );
        }

        /* ================= BUTTONS ================= */

        .btn-primary {
            background: linear-gradient(
                135deg,
                var(--primary-color),
                var(--secondary-color)
            );
            color: #fff;
            transition: all .3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px
                color-mix(in srgb, var(--primary-color) 40%, transparent);
        }

        /* ================= ANIMATIONS ================= */

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

        .card-hover {
            transition: all .3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px -20px
                color-mix(in srgb, var(--primary-color) 50%, transparent);
        }
    </style>

    <?php echo $__env->yieldContent('style'); ?>
</head>

<body>


<?php echo $__env->make('frontend.inc.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<main class="pt-32">
    <?php echo $__env->yieldContent('content'); ?>
</main>


<?php echo $__env->make('frontend.inc.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<div class="fixed bottom-8 left-8 flex flex-col gap-4 z-40">

    
    <a href="<?php echo e(route('language.switch', app()->getLocale() === 'ar' ? 'en' : 'ar')); ?>"
       class="w-12 h-12 rounded-full gradient-bg
              flex items-center justify-center
              text-white shadow-2xl
              transition hover:scale-110">
        <i class="fas fa-language text-lg"></i>
    </a>

    
    <button id="scrollTop"
        class="w-12 h-12 rounded-full gradient-bg
               flex items-center justify-center
               text-white shadow-2xl
               transition hover:scale-110">
        <i class="fas fa-arrow-up"></i>
    </button>

</div>


<script>
    document.getElementById('menuToggle')?.addEventListener('click', () => {
        document.getElementById('mobileMenu')?.classList.toggle('hidden');
    });

    document.getElementById('scrollTop')?.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('appear');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right')
        .forEach(el => observer.observe(el));

});
</script>

<?php echo $__env->yieldContent('script'); ?>
<?php echo $__env->yieldContent('scripts'); ?>

</body>
</html>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/layouts/frontend.blade.php ENDPATH**/ ?>