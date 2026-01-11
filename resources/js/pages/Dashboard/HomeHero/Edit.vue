<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import Button from '@/components/ui/button/Button.vue'
import Input from '@/components/ui/input/Input.vue'
import Label from '@/components/ui/label/Label.vue'

import { Head, Form, usePage } from '@inertiajs/vue3'
import type { BreadcrumbItem } from '@/types'
import { computed, ref } from 'vue'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'

/**
 * Props
 */
const props = defineProps<{
  hero: {
    id: number
    title: { ar: string; en: string }
    subtitle: { ar: string; en: string }
    button_text: { ar: string; en: string }
    button_link: string | null
    image: string | null
  }
}>()

/**
 * Breadcrumbs
 */
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'لوحة التحكم', href: route('dashboard') },
  { title: 'القسم الرئيسي (Hero)' },
]

/**
 * Image Preview
 */
const imagePreview = ref<string | null>(null)
const pageData = usePage()

const flashMessage = computed(() => pageData.props.flash?.message)

function handleImageChange(event: Event) {
  const target = event.target as HTMLInputElement
  const file = target.files?.[0] ?? null
  imagePreview.value = file ? URL.createObjectURL(file) : null
}
</script>

<template>

  <Head title="القسم الرئيسي (Hero)" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-6 max-w">
      <!-- Flash Message -->
      <Alert v-if="flashMessage"
        class="bg-blue-200 dark:bg-blue-900/50 border-blue-400 dark:border-blue-800 text-blue-900 dark:text-blue-100">
        <Rocket class="h-4 w-4" />
        <AlertTitle>Notification</AlertTitle>
        <AlertDescription>
          {{ flashMessage }}
        </AlertDescription>
      </Alert>
      <Form method="post" :action="route('dashboard.home.hero.update')" enctype="multipart/form-data" class="space-y-12"
        #default="{ errors, processing }">

        <!-- ================= العنوان ================= -->
        <section>
          <h3 class="font-bold text-lg mb-4">العنوان الرئيسي</h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <Label class="block mb-2">العنوان (عربي)</Label>
              <Input v-model="hero.title.ar" name="title[ar]" class="w-full" />
              <p v-if="errors['title.ar']" class="text-sm text-red-600 mt-1">
                {{ errors['title.ar'] }}
              </p>
            </div>

            <div>
              <Label class="block mb-2">العنوان (English)</Label>
              <Input v-model="hero.title.en" name="title[en]" class="w-full" />
              <p v-if="errors['title.en']" class="text-sm text-red-600 mt-1">
                {{ errors['title.en'] }}
              </p>
            </div>
          </div>
        </section>

        <!-- ================= الوصف ================= -->
        <section>
          <h3 class="font-bold text-lg mb-4">الوصف المختصر</h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- عربي -->
            <div>
              <Label class="block mb-2">الوصف (عربي)</Label>

              <Editor v-model="hero.subtitle.ar" class="editor-fixed w-full" />

              <!-- ✅ مهم: input مخفي -->
              <input type="hidden" name="subtitle[ar]" :value="hero.subtitle.ar" />
            </div>

            <!-- English -->
            <div>
              <Label class="block mb-2">Description (English)</Label>

              <Editor v-model="hero.subtitle.en" class="editor-fixed w-full" />

              <!-- ✅ مهم: input مخفي -->
              <input type="hidden" name="subtitle[en]" :value="hero.subtitle.en" />
            </div>
          </div>
        </section>

        <!-- ================= نص الزر ================= -->
        <section>
          <h3 class="font-bold text-lg mb-4">زر الإجراء</h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <Label class="block mb-2">نص الزر (عربي)</Label>
              <Input v-model="hero.button_text.ar" name="button_text[ar]" class="w-full" />
            </div>

            <div>
              <Label class="block mb-2">Button Text (English)</Label>
              <Input v-model="hero.button_text.en" name="button_text[en]" class="w-full" />
            </div>
          </div>

          <div class="mt-6">
            <Label class="block mb-2">رابط الزر</Label>
            <Input v-model="hero.button_link" name="button_link" class="w-full" />
          </div>
        </section>

        <!-- ================= الصورة ================= -->
        <section>
          <h3 class="font-bold text-lg mb-4">صورة القسم الرئيسي</h3>

          <input type="file" name="image" accept="image/*" @change="handleImageChange" class="block w-full text-sm" />

          <div class="flex gap-6 mt-4">
            <div v-if="imagePreview">
              <p class="text-sm text-gray-500 mb-1">معاينة الصورة الجديدة</p>
              <img :src="imagePreview" class="w-64 rounded-lg border" />
            </div>

            <div v-else-if="hero.image">
              <p class="text-sm text-gray-500 mb-1">الصورة الحالية</p>
              <img :src="`/storage/${hero.image}`" class="w-64 rounded-lg border" />
            </div>
          </div>
        </section>

        <!-- ================= حفظ ================= -->
        <div class="pt-6">
          <Button type="submit" :disabled="processing">
            حفظ التعديلات
          </Button>
        </div>

      </Form>
    </div>
  </AppLayout>
</template>