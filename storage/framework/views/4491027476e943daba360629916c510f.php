<?php
    // النصوص
    $textAr  = $data['text_ar'] ?? '';
    $textEn  = $data['text_en'] ?? '';
    $content = app()->getLocale() === 'ar' ? $textAr : $textEn;

    // صورة (URL)
    $image   = $data['image'] ?? null;

    $isAr     = app()->getLocale() === 'ar';
    $hasImage = !empty($image);
?>

<section class="relative">
    <div class="container mx-auto px-4">
        <div class="py-20">

            
            <div class="
                grid gap-14 items-center
                <?php echo e($hasImage ? 'grid-cols-1 lg:grid-cols-2' : 'grid-cols-1'); ?>

            ">

                
                <div class="
                    <?php echo e($hasImage
                        ? ($isAr ? 'lg:order-2 text-right' : 'lg:order-1 text-left')
                        : 'text-center'); ?>

                ">
                    <div class="relative h-full">

                        
                        <div class="
                            absolute inset-0
                            rounded-3xl
                            bg-white/5
                            backdrop-blur-md
                            border border-white/10
                        "></div>

                        <div class="relative px-10 py-14">

                            <div
                                class="
                                    prose prose-lg
                                    <?php echo e($hasImage ? 'max-w-none' : 'max-w-3xl mx-auto'); ?>


                                    prose-headings:text-white
                                    prose-headings:font-extrabold
                                    prose-headings:tracking-tight

                                    prose-h2:text-3xl
                                    prose-h3:text-2xl

                                    prose-p:text-[#a8b2d1]
                                    prose-p:leading-relaxed

                                    prose-strong:text-white

                                    prose-a:text-[#00b4d8]
                                    hover:prose-a:underline

                                    prose-ul:text-[#a8b2d1]
                                    prose-li:marker:text-[#00b4d8]

                                    prose-blockquote:border-s-4
                                    prose-blockquote:border-[#00b4d8]
                                    prose-blockquote:bg-white/5
                                    prose-blockquote:text-white
                                    prose-blockquote:rounded-xl
                                    prose-blockquote:px-6
                                    prose-blockquote:py-4
                                    prose-blockquote:not-italic
                                "
                            >
                                <?php echo $content; ?>

                            </div>

                        </div>
                    </div>
                </div>

                
                <?php if($hasImage): ?>
                    <div class="<?php echo e($isAr ? 'lg:order-1' : 'lg:order-2'); ?>">
                        <div class="relative flex justify-center">

                            
                            <div style="background-color: ;" class="
                                absolute -inset-4
                                rounded-[28px]
                                bg-gradient-to-r from-[#00b4d8]/20 to-[#ff5d8f]/20
                                blur-2xl
                            "></div>

                            
                            <img
                                src="<?php echo e($image); ?>"
                                alt="Section image"
                                class="
                                    relative
                                    w-full max-w-md
                                    rounded-[28px]
                                    shadow-2xl
                                    object-cover
                                "
                            >
                        </div>
                    </div>
                <?php endif; ?>

            </div>

        </div>
    </div>
</section>
<?php /**PATH C:\laragon\www\aiw_rtl\resources\views/website/sections/text.blade.php ENDPATH**/ ?>