import { ref, computed, watchEffect } from 'vue'
import { router } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'

export function useLanguage() {
    const { props } = usePage()
    
    // الحصول على اللغة من props Laravel
    const currentLang = ref(props.locale || 'ar')
    const direction = computed(() => currentLang.value === 'ar' ? 'rtl' : 'ltr')

    // مراقبة تغيير locale من السيرفر
    watchEffect(() => {
        const newLocale = props.locale
        if (newLocale && newLocale !== currentLang.value) {
            currentLang.value = newLocale
            applyTranslations(newLocale)
        }
    })

    const setLang = (lang) => {
        if (!['ar', 'en'].includes(lang)) return
        
        // استخدام GET بدلاً من POST
        router.visit(route('lang.switch', { lang }), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                currentLang.value = lang
                applyTranslations(lang)
                updateHtmlAttributes(lang)
            }
        })
    }

    const toggleLang = () => {
        const newLang = currentLang.value === 'ar' ? 'en' : 'ar'
        setLang(newLang)
    }

    const updateHtmlAttributes = (lang) => {
        const dir = lang === 'ar' ? 'rtl' : 'ltr'
        document.documentElement.dir = dir
        document.documentElement.lang = lang
        
        // إضافة class للـ body لسهولة الـ styling
        document.body.classList.remove('ltr', 'rtl')
        document.body.classList.add(dir)
    }

    const applyTranslations = (lang) => {
        // تحديث النصوص التي تحتوي على data attributes
        document.querySelectorAll('[data-ar]').forEach(el => {
            const text = lang === 'ar' 
                ? el.getAttribute('data-ar') 
                : el.getAttribute('data-en')
            
            if (text) {
                el.textContent = text
            }
        })

        // تحديث الـ placeholders
        document.querySelectorAll('[data-ar-placeholder]').forEach(el => {
            const placeholder = lang === 'ar'
                ? el.getAttribute('data-ar-placeholder')
                : el.getAttribute('data-en-placeholder')
            
            if (placeholder) {
                el.setAttribute('placeholder', placeholder)
            }
        })

        // تحديث القيم
        document.querySelectorAll('[data-ar-value]').forEach(el => {
            const value = lang === 'ar'
                ? el.getAttribute('data-ar-value')
                : el.getAttribute('data-en-value')
            
            if (value) {
                el.value = value
            }
        })
    }

    // التهيئة الأولية
    const initLanguage = () => {
        if (currentLang.value) {
            applyTranslations(currentLang.value)
            updateHtmlAttributes(currentLang.value)
        }
    }

    // تشغيل التهيئة بعد تحميل الصفحة
    if (typeof window !== 'undefined') {
        setTimeout(initLanguage, 100)
    }

    return {
        currentLang,
        direction,
        toggleLang,
        setLang,
        applyTranslations
    }
}
