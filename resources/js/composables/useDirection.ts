import { computed } from 'vue'

export function useDirection() {
    const dir = computed(() =>
        document.documentElement.getAttribute('dir') || 'ltr'
    )

    const isRTL = computed(() => dir.value === 'rtl')

    return { dir, isRTL }
}
