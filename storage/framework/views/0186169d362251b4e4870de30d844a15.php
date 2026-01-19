

<?php $__env->startSection('title', app()->getLocale() == 'ar' ? 'تواصل معنا' : 'Contact Us'); ?>

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

    .gradient-text {
        background: linear-gradient(to right, var(--sky-blue), var(--pink));
        -webkit-background-clip: text;
        color: transparent;
    }

    .card-hover {
        transition: .3s;
    }

    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,.4);
    }

    .contact-input {
        background: rgba(255,255,255,.05);
        border: 1px solid rgba(255,255,255,.15);
        color: #fff;
        transition: .3s;
    }

    .contact-input:focus {
        outline: none;
        border-color: var(--sky-blue);
        background: rgba(255,255,255,.08);
        box-shadow: 0 0 0 3px rgba(0,180,216,.15);
    }

    /* SELECT FIX */
    select.contact-input {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg fill='white' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-size: 1.2rem;
        background-position: left 1rem center;
        padding-left: 3rem;
    }

    body[dir="ltr"] select.contact-input {
        background-position: right 1rem center;
        padding-left: 1rem;
        padding-right: 3rem;
    }

    select.contact-input option {
        background: var(--navy);
        color: #fff;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="py-20 bg-[#112240]">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            
            <div>
                <div class="bg-[#233554] rounded-2xl p-8 card-hover">
                    <h2 class="text-3xl font-bold mb-8 gradient-text">
                        <?php echo e(app()->getLocale() == 'ar' ? 'معلومات التواصل' : 'Contact Information'); ?>

                    </h2>

                    <div class="space-y-6 text-[#a8b2d1]">
                        <p>
                            <strong class="text-white">
                                <?php echo e(app()->getLocale() == 'ar' ? 'العنوان:' : 'Address:'); ?>

                            </strong><br>
                            <?php echo get_general_value('address_'.app()->getLocale()); ?>

                        </p>

                        <p>
                            <strong class="text-white">
                                <?php echo e(app()->getLocale() == 'ar' ? 'البريد الإلكتروني:' : 'Email:'); ?>

                            </strong><br>
                            <?php echo e(get_general_value('website_email')); ?>

                        </p>

                        <p>
                            <strong class="text-white">
                                <?php echo e(app()->getLocale() == 'ar' ? 'الهاتف:' : 'Phone:'); ?>

                            </strong><br>
                            <?php echo e(get_general_value('phone')); ?>


                        </p>
                    </div>
                </div>
            </div>

            
            <div>
                <div class="bg-[#233554] rounded-2xl p-8 card-hover">
                    <h2 class="text-3xl font-bold mb-8 gradient-text">
                        <?php echo e(app()->getLocale() == 'ar' ? 'أرسل لنا رسالة' : 'Send Us a Message'); ?>

                    </h2>

                    <form id="contactForm" class="space-y-6">
                        <?php echo csrf_field(); ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-[#a8b2d1]">
                                    <?php echo e(app()->getLocale() == 'ar' ? 'الاسم الكامل' : 'Full Name'); ?>

                                </label>
                                <input name="name" class="w-full p-3 contact-input rounded-lg">
                                <p class="text-red-400 text-sm mt-1" data-error="name"></p>
                            </div>

                            <div>
                                <label class="text-[#a8b2d1]">
                                    <?php echo e(app()->getLocale() == 'ar' ? 'البريد الإلكتروني' : 'Email Address'); ?>

                                </label>
                                <input name="email" type="email" class="w-full p-3 contact-input rounded-lg">
                                <p class="text-red-400 text-sm mt-1" data-error="email"></p>
                            </div>
                        </div>

                        <div>
                            <label class="text-[#a8b2d1]">
                                <?php echo e(app()->getLocale() == 'ar' ? 'الشركة' : 'Company'); ?>

                            </label>
                            <input name="company" class="w-full p-3 contact-input rounded-lg">
                        </div>

                        <div>
                            <label class="text-[#a8b2d1]">
                                <?php echo e(app()->getLocale() == 'ar' ? 'نوع الاستفسار' : 'Inquiry Type'); ?>

                            </label>
                            <select name="inquiry_type" class="w-full p-3 contact-input rounded-lg">
                                <option value="">
                                    <?php echo e(app()->getLocale() == 'ar' ? 'اختر نوع الاستفسار' : 'Select Inquiry Type'); ?>

                                </option>
                                <option value="partnership">
                                    <?php echo e(app()->getLocale() == 'ar' ? 'شراكة استراتيجية' : 'Strategic Partnership'); ?>

                                </option>
                                <option value="investment">
                                    <?php echo e(app()->getLocale() == 'ar' ? 'فرص استثمارية' : 'Investment Opportunities'); ?>

                                </option>
                                <option value="career">
                                    <?php echo e(app()->getLocale() == 'ar' ? 'وظائف' : 'Careers'); ?>

                                </option>
                            </select>
                            <p class="text-red-400 text-sm mt-1" data-error="inquiry_type"></p>
                        </div>

                        <div>
                            <label class="text-[#a8b2d1]">
                                <?php echo e(app()->getLocale() == 'ar' ? 'الرسالة' : 'Message'); ?>

                            </label>
                            <textarea name="message" rows="5"
                                class="w-full p-3 contact-input rounded-lg"></textarea>
                            <p class="text-red-400 text-sm mt-1" data-error="message"></p>
                        </div>

                        <button class="w-full py-3 rounded-lg font-bold text-white
                            bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f]">
                            <?php echo e(app()->getLocale() == 'ar' ? 'إرسال الرسالة' : 'Send Message'); ?>

                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>


<div id="toast"
     class="fixed top-6 right-6 hidden px-6 py-4 rounded-xl text-white shadow-xl"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
const form = document.getElementById('contactForm');
const toast = document.getElementById('toast');

function showToast(msg, type='success') {
    toast.className = `fixed top-6 right-6 px-6 py-4 rounded-xl text-white shadow-xl ${type==='success'?'bg-green-600':'bg-red-600'}`;
    toast.innerText = msg;
    toast.classList.remove('hidden');
    setTimeout(()=>toast.classList.add('hidden'),3000);
}

function clearErrors() {
    document.querySelectorAll('[data-error]').forEach(e=>e.innerText='');
}

form.addEventListener('submit', async e => {
    e.preventDefault();
    clearErrors();

    const res = await fetch("<?php echo e(route('contact.send')); ?>", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
            'Accept': 'application/json'
        },
        body: new FormData(form)
    });

    const data = await res.json();

    if (!res.ok && data.errors) {
        Object.keys(data.errors).forEach(k=>{
            document.querySelector(`[data-error="${k}"]`).innerText = data.errors[k][0];
        });
        showToast("<?php echo e(app()->getLocale()=='ar'?'تحقق من البيانات':'Check the form data'); ?>",'error');
        return;
    }

    form.reset();
    showToast("<?php echo e(app()->getLocale()=='ar'?'تم الإرسال بنجاح':'Message sent successfully'); ?>");
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\aiw_rtl\resources\views/frontend/contact.blade.php ENDPATH**/ ?>