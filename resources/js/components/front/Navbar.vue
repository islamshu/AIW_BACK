<script setup>
import { ref, computed } from 'vue'
import { useLanguage } from '@/composables/useLanguage'
import { Link } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'

const { toggleLang, currentLang, direction } = useLanguage()
const mobileMenuOpen = ref(false)

const { props } = usePage()
const website = computed(() => props.website || {})
</script>

<template>
  <!-- NAVBAR -->
  <nav
    class="fixed top-0 w-full bg-[#0a192f]/95 backdrop-blur-sm z-50 py-4 border-b border-[#00b4d8]/10"
    :dir="direction"
  >
    <div class="container mx-auto px-4">
      <div class="flex justify-between items-center">

        <!-- LOGO -->
        <Link href="/" class="flex items-center gap-4">
          <div
            class="w-12 h-12 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f] rounded-lg flex items-center justify-center"
          >
            <span class="font-bold text-xl text-white">AIW</span>
          </div>
          <div class="hidden sm:flex flex-col">
            <span class="font-bold text-lg text-white">
              {{ currentLang === 'ar' ? website.name_ar : website.name_en }}
            </span>
            <span class="text-[#00b4d8] text-sm" 
                  data-ar="مجموعة الاستثمار والتشغيل متعددة القطاعات" 
                  data-en="Multi-Sector Investment & Operations Group">
              {{ currentLang === 'ar' ? 'مجموعة الاستثمار والتشغيل متعددة القطاعات' : 'Multi-Sector Investment & Operations Group' }}
            </span>
          </div>
        </Link>

        <!-- DESKTOP MENU -->
        <div class="hidden md:flex items-center gap-8">
          <Link href="/" class="text-[#00b4d8] font-medium flex items-center gap-2">
            <i class="fas fa-home"></i>
            <span data-ar="الرئيسية" data-en="Home">
              {{ currentLang === 'ar' ? 'الرئيسية' : 'Home' }}
            </span>
          </Link>

          <Link href="/about" class="text-[#a8b2d1] hover:text-[#00b4d8] flex items-center gap-2">
            <i class="fas fa-users"></i>
            <span data-ar="من نحن" data-en="About Us">
              {{ currentLang === 'ar' ? 'من نحن' : 'About Us' }}
            </span>
          </Link>

          <Link href="/vision" class="text-[#a8b2d1] hover:text-[#00b4d8] flex items-center gap-2">
            <i class="fas fa-eye"></i>
            <span data-ar="الرؤية" data-en="Vision">
              {{ currentLang === 'ar' ? 'الرؤية' : 'Vision' }}
            </span>
          </Link>

          <Link href="/strategy" class="text-[#a8b2d1] hover:text-[#00b4d8] flex items-center gap-2">
            <i class="fas fa-chess-board"></i>
            <span data-ar="الإستراتيجية" data-en="Strategy">
              {{ currentLang === 'ar' ? 'الإستراتيجية' : 'Strategy' }}
            </span>
          </Link>

          <Link href="/sectors" class="text-[#a8b2d1] hover:text-[#00b4d8] flex items-center gap-2">
            <i class="fas fa-industry"></i>
            <span data-ar="القطاعات" data-en="Sectors">
              {{ currentLang === 'ar' ? 'القطاعات' : 'Sectors' }}
            </span>
          </Link>

          <Link href="/contact" class="text-[#a8b2d1] hover:text-[#00b4d8] flex items-center gap-2">
            <i class="fas fa-envelope"></i>
            <span data-ar="اتصل بنا" data-en="Contact">
              {{ currentLang === 'ar' ? 'اتصل بنا' : 'Contact' }}
            </span>
          </Link>

          <!-- LANGUAGE BUTTON -->
          <Link
  :href="route('lang.switch', { lang: currentLang === 'ar' ? 'en' : 'ar' })"
  method="get"
  preserve-scroll
  preserve-state
  class="bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f] text-white px-4 py-2 rounded-full font-semibold flex items-center gap-2 hover:opacity-90 transition-opacity"
>
  <i class="fas fa-globe"></i>
  <span>
    {{ currentLang === 'ar' ? 'English' : 'العربية' }}
  </span>
</Link>
        </div>

        <!-- MOBILE BUTTON -->
        <button
          @click="mobileMenuOpen = !mobileMenuOpen"
          class="md:hidden text-white text-2xl"
        >
          <i :class="mobileMenuOpen ? 'fas fa-times' : 'fas fa-bars'"></i>
        </button>

      </div>
    </div>
  </nav>

  <!-- MOBILE MENU -->
  <div
    v-if="mobileMenuOpen"
    class="md:hidden fixed top-[72px] inset-x-0 bg-[#0a192f]/95 backdrop-blur-xl border-t border-[#00b4d8]/10 z-40"
    :dir="direction"
  >
    <div class="flex flex-col px-6 py-6 space-y-4">

      <Link @click="mobileMenuOpen = false" href="/" class="text-white flex items-center gap-3">
        <i class="fas fa-home"></i>
        <span data-ar="الرئيسية" data-en="Home">
          {{ currentLang === 'ar' ? 'الرئيسية' : 'Home' }}
        </span>
      </Link>

      <Link @click="mobileMenuOpen = false" href="/about" class="text-white flex items-center gap-3">
        <i class="fas fa-users"></i>
        <span data-ar="من نحن" data-en="About Us">
          {{ currentLang === 'ar' ? 'من نحن' : 'About Us' }}
        </span>
      </Link>

      <Link @click="mobileMenuOpen = false" href="/vision" class="text-white flex items-center gap-3">
        <i class="fas fa-eye"></i>
        <span data-ar="الرؤية" data-en="Vision">
          {{ currentLang === 'ar' ? 'الرؤية' : 'Vision' }}
        </span>
      </Link>

      <Link @click="mobileMenuOpen = false" href="/strategy" class="text-white flex items-center gap-3">
        <i class="fas fa-chess-board"></i>
        <span data-ar="الإستراتيجية" data-en="Strategy">
          {{ currentLang === 'ar' ? 'الإستراتيجية' : 'Strategy' }}
        </span>
      </Link>

      <Link @click="mobileMenuOpen = false" href="/sectors" class="text-white flex items-center gap-3">
        <i class="fas fa-industry"></i>
        <span data-ar="القطاعات" data-en="Sectors">
          {{ currentLang === 'ar' ? 'القطاعات' : 'Sectors' }}
        </span>
      </Link>

      <Link @click="mobileMenuOpen = false" href="/contact" class="text-white flex items-center gap-3">
        <i class="fas fa-envelope"></i>
        <span data-ar="اتصل بنا" data-en="Contact">
          {{ currentLang === 'ar' ? 'اتصل بنا' : 'Contact' }}
        </span>
      </Link>

      <!-- LANGUAGE BUTTON MOBILE -->
      <button
        @click="toggleLang; mobileMenuOpen = false"
        class="mt-4 bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f] text-white py-2 rounded-full font-semibold flex items-center justify-center gap-2 hover:opacity-90 transition-opacity"
      >
        <i class="fas fa-globe"></i>
        <span>
          {{ currentLang === 'ar' ? 'English' : 'العربية' }}
        </span>
      </button>

    </div>
  </div>
</template>
