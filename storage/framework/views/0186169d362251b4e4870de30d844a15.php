<?php $__env->startSection('title', app()->getLocale() == 'ar' ? 'تواصل معنا' : 'Contact Us'); ?>

<?php $__env->startSection('style'); ?>
<style>
/* ================= BASE ================= */
body {
    font-family: 'Cairo', sans-serif;
    background: var(--bg-color);
    color: var(--text-color);
}
body[dir="ltr"] {
    font-family: 'Poppins', sans-serif;
}

:root {
    --section-bg: color-mix(in srgb, var(--bg-color) 92%, black);
    --card-bg: color-mix(in srgb, var(--bg-color) 88%, black);
    --input-bg: color-mix(in srgb, var(--bg-color) 82%, black);
    --border-color: color-mix(in srgb, var(--primary-color) 20%, transparent);
    --text-muted: color-mix(in srgb, var(--text-color) 65%, transparent);
}

/* ================= TEXT ================= */
.gradient-text {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    -webkit-background-clip: text;
    color: transparent;
}

/* ================= SECTION ================= */
.contact-section {
    background:
        radial-gradient(
            circle at top,
            color-mix(in srgb, var(--primary-color) 15%, transparent),
            transparent 60%
        ),
        var(--section-bg);
}

/* ================= CARD ================= */
.contact-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 1.25rem;
    padding: 2.5rem;
}

/* ================= CONTACT INFO ================= */
.contact-info-item {
    display: flex;
    gap: 1.25rem;
    padding: 1.25rem 0;
    border-bottom: 1px solid color-mix(in srgb, var(--border-color) 50%, transparent);
}
.contact-info-item:last-child {
    border-bottom: none;
}

.contact-info-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(
        135deg,
        color-mix(in srgb, var(--primary-color) 20%, transparent),
        color-mix(in srgb, var(--secondary-color) 20%, transparent)
    );
    color: var(--primary-color);
    font-size: 1.2rem;
}

.contact-info-label {
    font-weight: 600;
    margin-bottom: .25rem;
}

.contact-info-value {
    color: var(--text-muted);
    font-size: .95rem;
    line-height: 1.7;
}

/* ================= FORM ================= */
.form-group label {
    display: block;
    font-size: .9rem;
    color: var(--text-muted);
    margin-bottom: .4rem;
}

.form-control {
    width: 100%;
    background: var(--input-bg);
    border: 1px solid var(--border-color);
    color: var(--text-color);
    padding: .85rem 1rem;
    border-radius: .85rem;
    transition: .25s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    background: color-mix(in srgb, var(--input-bg) 90%, black);
    box-shadow: 0 0 0 3px
        color-mix(in srgb, var(--primary-color) 30%, transparent);
}

select.form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg fill='%23cccccc' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-size: 1.2rem;
    background-position: left 1rem center;
    padding-left: 3rem;
}

body[dir="ltr"] select.form-control {
    background-position: right 1rem center;
    padding-left: 1rem;
    padding-right: 3rem;
}

/* ================= BUTTON ================= */
.btn-gradient {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: #fff;
    font-weight: 600;
    border-radius: 1rem;
    padding: .9rem 1.5rem;
    transition: .3s ease;
}

.btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 40px
        color-mix(in srgb, var(--primary-color) 35%, transparent);
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="contact-section py-28">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14">

            
            <div class="contact-card">
                <h2 class="text-3xl font-bold mb-10 gradient-text">
                    <?php echo e(app()->getLocale() == 'ar' ? 'معلومات التواصل' : 'Contact Information'); ?>

                </h2>

                <div class="contact-info-item">
                    <div class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="contact-info-label"><?php echo e(app()->getLocale() == 'ar' ? 'العنوان' : 'Address'); ?></div>
                        <div class="contact-info-value"><?php echo get_general_value('address_'.app()->getLocale()); ?></div>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div class="contact-info-label"><?php echo e(app()->getLocale() == 'ar' ? 'البريد الإلكتروني' : 'Email'); ?></div>
                        <div class="contact-info-value"><?php echo e(get_general_value('website_email')); ?></div>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon"><i class="fas fa-phone-alt"></i></div>
                    <div>
                        <div class="contact-info-label"><?php echo e(app()->getLocale() == 'ar' ? 'الهاتف' : 'Phone'); ?></div>
                        <div class="contact-info-value"><?php echo e(get_general_value('phone')); ?></div>
                    </div>
                </div>
            </div>

            
            <div class="contact-card">
                <h2 class="text-3xl font-bold mb-10 gradient-text">
                    <?php echo e(app()->getLocale() == 'ar' ? 'أرسل لنا رسالة' : 'Send Us a Message'); ?>

                </h2>

                <form id="contactForm" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label><?php echo e(app()->getLocale() == 'ar' ? 'الاسم الكامل' : 'Full Name'); ?></label>
                            <input name="name" class="form-control">
                            <p class="text-red-400 text-sm mt-1" data-error="name"></p>
                        </div>

                        <div class="form-group">
                            <label><?php echo e(app()->getLocale() == 'ar' ? 'البريد الإلكتروني' : 'Email'); ?></label>
                            <input type="email" name="email" class="form-control">
                            <p class="text-red-400 text-sm mt-1" data-error="email"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><?php echo e(app()->getLocale() == 'ar' ? 'الشركة' : 'Company'); ?></label>
                        <input name="company" class="form-control">
                    </div>

                    <div class="form-group">
                        <label><?php echo e(app()->getLocale() == 'ar' ? 'نوع الاستفسار' : 'Inquiry Type'); ?></label>
                        <select name="inquiry_type" class="form-control">
                            <option value=""><?php echo e(app()->getLocale() == 'ar' ? 'اختر نوع الاستفسار' : 'Select inquiry type'); ?></option>
                            <option value="partnership">شراكة استراتيجية</option>
                            <option value="investment">فرص استثمارية</option>
                            <option value="career">وظائف</option>
                        </select>
                        <p class="text-red-400 text-sm mt-1" data-error="inquiry_type"></p>
                    </div>

                    <div class="form-group">
                        <label><?php echo e(app()->getLocale() == 'ar' ? 'الرسالة' : 'Message'); ?></label>
                        <textarea name="message" rows="5" class="form-control"></textarea>
                        <p class="text-red-400 text-sm mt-1" data-error="message"></p>
                    </div>

                    <button class="w-full btn-gradient">
                        <?php echo e(app()->getLocale() == 'ar' ? 'إرسال الرسالة' : 'Send Message'); ?>

                    </button>
                </form>
            </div>

        </div>
    </div>
</section>


<div id="toast"
     style="z-index:9999"
     class="fixed top-6 right-6 hidden px-6 py-4 rounded-xl text-white shadow-xl">
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
const form = document.getElementById('contactForm');
const toast = document.getElementById('toast');

function showToast(message, type = 'success') {
    toast.classList.remove('hidden');
    toast.classList.remove('bg-green-600','bg-red-600');
    toast.classList.add(type === 'success' ? 'bg-green-600' : 'bg-red-600');
    toast.textContent = message;

    setTimeout(() => toast.classList.add('hidden'), 3000);
}

function clearErrors() {
    document.querySelectorAll('[data-error]').forEach(e => e.innerText = '');
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

    if (res.status === 422) {
        Object.keys(data.errors).forEach(k => {
            const el = document.querySelector(`[data-error="${k}"]`);
            if (el) el.innerText = data.errors[k][0];
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