import '../css/app.css'

import './vendor/main.js'
import '@fortawesome/fontawesome-free/css/all.min.css'

import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import type { DefineComponent } from 'vue'
import { createApp, h, watchEffect } from 'vue'
import { ZiggyVue } from 'ziggy-js'
import { initializeTheme } from './composables/useAppearance'

import PrimeVue from 'primevue/config'
import Editor from 'primevue/editor'
import Button from 'primevue/button'

import Lara from '@primevue/themes/lara'
import 'primeicons/primeicons.css'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),

    resolve: (name) =>
        resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./pages/**/*.vue'),
        ),

    setup({ el, App, props, plugin }) {
        const vueApp = createApp({
            render: () => h(App, props),
        })

        vueApp
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue, {
                theme: {
                    preset: Lara,
                },
                ripple: true,
            })

        vueApp.component('Editor', Editor)
        vueApp.component('PVButton', Button)

        // دالة لضبط اتجاه الصفحة بناءً على اللغة
        const setDocumentDirection = (locale: string) => {
            const dir = locale === 'ar' ? 'rtl' : 'ltr'
            document.documentElement.dir = dir
            document.documentElement.lang = locale
            
            // إضافة/إزالة class بناءً على الاتجاه
            document.body.classList.remove('ltr', 'rtl')
            document.body.classList.add(dir)
        }

        // مراقبة تغيير props.locale
        watchEffect(() => {
            const locale = props.initialPage.props.locale || 'ar'
            setDocumentDirection(locale)
        })

        // التطبيق الأولي للاتجاه
        const initialLocale = props.initialPage.props.locale || 'ar'
        setDocumentDirection(initialLocale)

        vueApp.mount(el)
    },

    progress: {
        color: '#4B5563',
    },
})

initializeTheme()
