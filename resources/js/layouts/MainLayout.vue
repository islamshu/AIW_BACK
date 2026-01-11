[file name]: layouts/MainLayout.vue
<script setup>
import { onMounted } from 'vue'
import { useLanguage } from '@/composables/useLanguage'
import Navbar from '@/components/front/Navbar.vue'

const { currentLang, direction } = useLanguage()

// ضبط اتجاه الصفحة عند التحميل
onMounted(() => {
  document.documentElement.dir = direction.value
  document.documentElement.lang = currentLang.value
})
</script>

<template>
  <div :dir="direction" :lang="currentLang" class="min-h-screen">
    <Navbar />
    <main class="pt-16">
      <slot />
    </main>
  </div>
</template>