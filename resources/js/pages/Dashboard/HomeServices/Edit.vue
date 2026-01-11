<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue'
    import Button from '@/components/ui/button/Button.vue'
    import Input from '@/components/ui/input/Input.vue'
    import Label from '@/components/ui/label/Label.vue'
    
    import { Head, Form } from '@inertiajs/vue3'
    import type { BreadcrumbItem } from '@/types'
    import { reactive, ref, watch, computed } from 'vue'
    
    /**
     * Props coming from controller
     * ملاحظة: عدّل الحقول حسب جدولك (image, icon, description..)
     */
    const props = defineProps<{
      service: {
        id: number
        title: { ar: string; en: string }
        description: { ar: string; en: string }
        icon: string | null
        image: string | null // مسار/رابط الصورة إن موجود
        order: number
      }
    }>()
    
    const breadcrumbs: BreadcrumbItem[] = [
      { title: 'لوحة التحكم', href: route('dashboard') },
      { title: 'الخدمات', href: route('dashboard.services.index') },
      { title: 'تعديل خدمة' },
    ]
    
    /**
     * form data (local reactive copy)
     */
    const service = reactive({
      id: props.service.id,
      title: {
        ar: props.service.title?.ar ?? '',
        en: props.service.title?.en ?? '',
      },
      description: {
        ar: props.service.description?.ar ?? '',
        en: props.service.description?.en ?? '',
      },
      icon: props.service.icon ?? '',
      order: props.service.order ?? 0,
    })
    
    /**
     * Decide initial media type:
     * إذا فيه image نختار image، وإلا icon
     */
    const mediaType = ref<'icon' | 'image'>(props.service.image ? 'image' : 'icon')
    
    /**
     * Show current image (from server) + new preview (from file input)
     */
    const currentImageUrl = computed(() => props.service.image || null)
    const imagePreview = ref<string | null>(null)
    
    /**
     * Handle new image selection
     */
    function handleImageChange(e: Event) {
      const file = (e.target as HTMLInputElement).files?.[0]
      imagePreview.value = file ? URL.createObjectURL(file) : null
    }
    
    /**
     * Reset fields on change
     */
    watch(mediaType, (type) => {
      if (type === 'icon') {
        // المستخدم اختار أيقونة: نلغي preview للصورة الجديدة
        imagePreview.value = null
        // ملاحظة: لا نمسح currentImageUrl لأنه من السيرفر (فقط عرض)
      }
      if (type === 'image') {
        // المستخدم اختار صورة: نمسح icon حتى لا يختلط الأمر بالسيرفر
        service.icon = ''
      }
    })
    </script>
    
    <template>
      <Head title="تعديل خدمة" />
    
      <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6 max-w">
    
          <Form
            method="put"
            :action="route('dashboard.services.update', service.id)"
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
                  <input type="radio" value="icon" v-model="mediaType" />
                  <span>أيقونة</span>
                </label>
    
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="radio" value="image" v-model="mediaType" />
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
    
                <!-- إذا عندك صورة قديمة وتريد إخفاءها عند اختيار icon -->
                <p v-if="currentImageUrl" class="text-xs text-gray-400">
                  لديك صورة محفوظة مسبقًا، لكن سيتم اعتماد الأيقونة إذا حفظت بهذا الاختيار.
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
    
                <!-- Current image from DB -->
                <div v-if="currentImageUrl && !imagePreview" class="mt-3">
                  <p class="text-xs text-gray-500 mb-2">الصورة الحالية:</p>
                  <img
                    :src="currentImageUrl"
                    class="w-32 rounded border"
                    alt="current"
                  />
                </div>
    
                <!-- New preview -->
                <div v-if="imagePreview" class="mt-3">
                  <p class="text-xs text-gray-500 mb-2">معاينة الصورة الجديدة:</p>
                  <img
                    :src="imagePreview"
                    class="w-32 rounded border"
                    alt="preview"
                  />
                </div>
              </div>
            </section>
    
            <!-- ================= الترتيب ================= -->
            <section>
              <Label class="block mb-2">الترتيب</Label>
              <Input type="number" v-model="service.order" name="order" />
            </section>
    
            <!-- ================= حفظ ================= -->
            <div class="flex gap-3">
              <Button type="submit">حفظ التعديلات</Button>
              <Button type="button" variant="outline" as-child>
                <a :href="route('dashboard.services.index')">إلغاء</a>
              </Button>
            </div>
    
          </Form>
    
        </div>
      </AppLayout>
    </template>
    
    <style>
    .editor-fixed {
      min-height: 280px;
    }
    </style>
    