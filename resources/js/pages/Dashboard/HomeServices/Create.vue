<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue'
    import Button from '@/components/ui/button/Button.vue'
    import Input from '@/components/ui/input/Input.vue'
    import Label from '@/components/ui/label/Label.vue'
    
    import { Head, Form } from '@inertiajs/vue3'
    import type { BreadcrumbItem } from '@/types'
    import { reactive, ref, watch } from 'vue'
    
    const breadcrumbs: BreadcrumbItem[] = [
      { title: 'لوحة التحكم', href: route('dashboard') },
      { title: 'الخدمات', href: route('dashboard.services.index') },
      { title: 'إضافة خدمة' },
    ]
    
    /**
     * form data
     */
    const service = reactive({
      title: { ar: '', en: '' },
      description: { ar: '', en: '' },
      icon: '',
      order: 0,
    })
    
    /**
     * icon or image
     */
    const mediaType = ref<'icon' | 'image'>('icon')
    
    /**
     * image preview
     */
    const imagePreview = ref<string | null>(null)
    
    function handleImageChange(e: Event) {
      const file = (e.target as HTMLInputElement).files?.[0]
      imagePreview.value = file ? URL.createObjectURL(file) : null
    }
    
    /**
     * reset fields on change
     */
    watch(mediaType, (type) => {
      if (type === 'icon') {
        imagePreview.value = null
      }
      if (type === 'image') {
        service.icon = ''
      }
    })
    </script>
    
    <template>
      <Head title="إضافة خدمة" />
    
      <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6 max-w">
    
          <Form
            method="post"
            :action="route('dashboard.services.store')"
            enctype="multipart/form-data"
            class="space-y-12"
          >
    
            <!-- ================= العنوان ================= -->
            <section>
              <h3 class="font-bold text-lg mb-4">العنوان</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <Input v-model="service.title.ar" name="title[ar]" placeholder="العنوان بالعربي" />
                <Input v-model="service.title.en" name="title[en]" placeholder="Title in English" />
              </div>
            </section>
    
            <!-- ================= الوصف ================= -->
            <section>
              <h3 class="font-bold text-lg mb-4">الوصف</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <Editor v-model="service.description.ar" class="editor-fixed" />
                <Editor v-model="service.description.en" class="editor-fixed" />
    
                <!-- inputs مخفية -->
                <input type="hidden" name="description[ar]" :value="service.description.ar" />
                <input type="hidden" name="description[en]" :value="service.description.en" />
              </div>
            </section>
    
            <!-- ================= اختيار الأيقونة / الصورة ================= -->
            <section>
              <h3 class="font-bold text-lg mb-4">عرض الخدمة</h3>
    
              <!-- selector -->
              <div class="flex gap-6 mb-6">
                <label class="flex items-center gap-2 cursor-pointer">
                  <input
                    type="radio"
                    value="icon"
                    v-model="mediaType"
                  />
                  <span>أيقونة</span>
                </label>
    
                <label class="flex items-center gap-2 cursor-pointer">
                  <input
                    type="radio"
                    value="image"
                    v-model="mediaType"
                  />
                  <span>صورة</span>
                </label>
              </div>
    
              <!-- icon -->
              <div v-if="mediaType === 'icon'" class="space-y-2">
                <Label>الأيقونة</Label>
                <Input
                  v-model="service.icon"
                  name="icon"
                  placeholder="fa-solid fa-gear"
                />
                <p class="text-xs text-gray-500">
                  مثال: fa-solid fa-gear
                </p>
              </div>
    
              <!-- image -->
              <div v-else class="space-y-2">
                <Label>صورة الخدمة</Label>
                <input
                  type="file"
                  name="image"
                  accept="image/*"
                  @change="handleImageChange"
                />
    
                <img
                  v-if="imagePreview"
                  :src="imagePreview"
                  class="w-32 mt-3 rounded border"
                />
              </div>
            </section>
    
            <!-- ================= الترتيب ================= -->
            <section>
              <Label class="block mb-2">الترتيب</Label>
              <Input type="number" v-model="service.order" name="order" />
            </section>
    
            <!-- ================= حفظ ================= -->
            <Button type="submit">
              حفظ الخدمة
            </Button>
    
          </Form>
    
        </div>
      </AppLayout>
    </template>
    
    <style>
    .editor-fixed {
      min-height: 280px;
    }
    </style>
    