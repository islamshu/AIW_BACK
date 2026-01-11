// متغيرات عامة
let currentLanguage = 'ar';
let isMenuOpen = false;

function initUI() {
    // فتح/إغلاق القائمة
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');

    if (menuToggle && mobileMenu) {
        // لمنع تكرار إضافة نفس الـ listeners مع Inertia
        if (!menuToggle.dataset.bound) {
            menuToggle.dataset.bound = '1';

            menuToggle.addEventListener('click', function () {
                isMenuOpen = !isMenuOpen;
                mobileMenu.classList.toggle('hidden');
                menuToggle.innerHTML = isMenuOpen
                    ? '<i class="fas fa-times"></i>'
                    : '<i class="fas fa-bars"></i>';
            });
        }

        // إغلاق القائمة عند النقر على رابط
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            if (!link.dataset.bound) {
                link.dataset.bound = '1';
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
                    isMenuOpen = false;
                });
            }
        });
    }

    // زر العودة للأعلى
    const scrollTopBtn = document.getElementById('scrollTop');
    if (scrollTopBtn) {
        if (!scrollTopBtn.dataset.bound) {
            scrollTopBtn.dataset.bound = '1';

            scrollTopBtn.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            window.addEventListener('scroll', function () {
                if (window.scrollY > 500) {
                    scrollTopBtn.style.display = 'flex';
                } else {
                    scrollTopBtn.style.display = 'none';
                }
            });
        }

        // إخفاء الزر في البداية
        scrollTopBtn.style.display = 'none';
    }

    // زر تبديل اللغة العائم
    const languageFloat = document.getElementById('languageFloat');
    if (languageFloat) {
        if (!languageFloat.dataset.bound) {
            languageFloat.dataset.bound = '1';
            languageFloat.addEventListener('click', function () {
                const toggle = document.getElementById('languageToggle');
                if (toggle) toggle.click();
            });
        }
    }

    // تحديد الصفحة النشطة في القائمة (Inertia routes)
    const path = window.location.pathname; // مثل / أو /about
    const navLinks = document.querySelectorAll('.nav-link-hover');

    navLinks.forEach(link => {
        const href = link.getAttribute('href') || '';
        // ممكن عندك href="/about" أو "about.html"
        const isActive =
            href === path ||
            (path === '/' && (href === '/' || href.includes('index')));

        if (isActive) {
            link.classList.remove('text-[#a8b2d1]');
            link.classList.add('text-[#00b4d8]');
        } else {
            // لا تفرض شكل على الكل إذا عندك تصميم مختلف، لكن هذا منطقي
            link.classList.add('text-[#a8b2d1]');
            link.classList.remove('text-[#00b4d8]');
        }
    });
}

let observer = null;

function initAnimations() {
    // إذا كنت تنتقل بين الصفحات، أنشئ observer جديد
    if (observer) observer.disconnect();

    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('appear');
            }
        });
    }, observerOptions);

    const elements = document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right');

    elements.forEach(el => observer.observe(el));
}

function initLanguageCache() {
    const savedLanguage = localStorage.getItem('aiw-language');
    if (savedLanguage) currentLanguage = savedLanguage;
}

/**
 * ✅ نقطة تشغيل واحدة لكل شيء
 */
function boot() {
    initLanguageCache();
    initUI();
    initAnimations();
}

/**
 * ✅ يعمل عند أول تحميل حقيقي
 */
window.addEventListener('load', boot);

/**
 * ✅ يعمل بعد كل تنقل Inertia
 * (هذا هو المهم في SPA)
 */
document.addEventListener('inertia:finish', boot);
