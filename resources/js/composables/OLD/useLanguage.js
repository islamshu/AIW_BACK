import { ref, watch } from 'vue'

const currentLang = ref(localStorage.getItem('lang') || 'ar')
const direction = ref(currentLang.value === 'ar' ? 'rtl' : 'ltr')

export function useLanguage() {
    const setLang = (lang) => {
        currentLang.value = lang
        direction.value = lang === 'ar' ? 'rtl' : 'ltr'

        document.documentElement.lang = lang
        document.documentElement.dir = direction.value

        localStorage.setItem('lang', lang)

        applyTranslations()
    }

    const toggleLang = () => {
        setLang(currentLang.value === 'ar' ? 'en' : 'ar')
    }

    const applyTranslations = () => {
        document.querySelectorAll('[data-ar]').forEach(el => {
            el.textContent =
                currentLang.value === 'ar'
                    ? el.dataset.ar
                    : el.dataset.en
        })
    }

    watch(currentLang, applyTranslations)

    // init on load
    setTimeout(applyTranslations, 0)

    return {
        currentLang,
        direction,
        toggleLang,
        setLang
    }
}
