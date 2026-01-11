<script setup lang="ts">
  import AppLayout from '@/layouts/AppLayout.vue'
  import Button from '@/components/ui/button/Button.vue'
  import { Head, Link, router } from '@inertiajs/vue3'
  import { type BreadcrumbItem } from '@/types'
  import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
  import { Rocket, GripVertical } from 'lucide-vue-next'
  import draggable from 'vuedraggable'
  
  import {
    Table,
    TableBody,
    TableCell,
    TableCaption,
    TableHead,
    TableHeader,
    TableRow,
  } from '@/components/ui/table'
import { ref } from 'vue'
  
  /**
   * Props
   */
  const props = defineProps<{
    services: Array<{
      id: number
      title: { ar: string; en: string }
      order: number
      is_active: boolean
    }>
  }>()
  
  /**
   * Local copy (required for draggable)
   */
  const items = ref([...props.services])
  
  /**
   * Breadcrumbs
   */
  const breadcrumbs: BreadcrumbItem[] = [
    { title: 'لوحة التحكم', href: route('dashboard') },
    { title: 'الخدمات' },
  ]
  
  /**
   * Delete
   */
  const handleDelete = (id: number) => {
    if (confirm('هل أنت متأكد من حذف هذه الخدمة؟')) {
      router.delete(route('dashboard.services.destroy', id))
    }
  }
  
  /**
   * Save order
   */
  const saveOrder = () => {
    const orderedIds = items.value.map((item, index) => ({
      id: item.id,
      order: index + 1,
    }))
  
    router.post(
      route('dashboard.services.reorder'),
      { items: orderedIds },
      { preserveScroll: true }
    )
  }
  </script>
  
  <template>
    <Head title="الخدمات" />
  
    <AppLayout :breadcrumbs="breadcrumbs">
      <div class="p-4 space-y-4">
  
        <!-- Flash -->
        <Alert
          v-if="$page.props.flash?.message"
          class="bg-blue-200 dark:bg-blue-900/50 border-blue-400"
        >
          <Rocket class="h-4 w-4" />
          <AlertTitle>تم بنجاح</AlertTitle>
          <AlertDescription>
            {{ $page.props.flash.message }}
          </AlertDescription>
        </Alert>
  
        <!-- Header -->
        <div class="flex items-center justify-between">
          <h2 class="text-xl font-bold">إدارة الخدمات</h2>
  
          <Link :href="route('dashboard.services.create')">
            <Button>إضافة خدمة</Button>
          </Link>
        </div>
  
        <!-- Table -->
        <Table>
          <TableCaption>اسحب الصفوف لتغيير الترتيب</TableCaption>
  
          <TableHeader>
            <TableRow>
              <TableHead class="w-[40px] text-center"></TableHead>
              <TableHead class="w-[60px] text-center">#</TableHead>
              <TableHead class="text-right">العنوان</TableHead>
              <TableHead class="text-center">الحالة</TableHead>
              <TableHead class="text-center">الإجراءات</TableHead>
            </TableRow>
          </TableHeader>
  
          <draggable
            v-model="items"
            tag="tbody"
            handle=".drag-handle"
            @end="saveOrder"
          >
            <template #item="{ element }">
              <TableRow>
  
                <!-- Drag Handle -->
                <TableCell class="text-center cursor-move drag-handle">
                  <GripVertical class="w-4 h-4 text-gray-500" />
                </TableCell>
  
                <TableCell class="text-center">
                  {{ element.id }}
                </TableCell>
  
                <TableCell>
                  {{ element.title.ar }}
                </TableCell>
  
  
                <TableCell class="text-center">
                  <span
                    class="px-2 py-1 rounded text-xs font-semibold"
                    :class="element.is_active
                      ? 'bg-green-100 text-green-700'
                      : 'bg-gray-200 text-gray-600'"
                  >
                    {{ element.is_active ? 'فعال' : 'مخفي' }}
                  </span>
                </TableCell>
  
                <TableCell class="text-center space-x-2">
                  <Link :href="route('dashboard.services.edit', element.id)">
                    <Button size="sm" class="bg-slate-500">تعديل</Button>
                  </Link>
  
                  <Button
                    size="sm"
                    class="bg-red-500"
                    @click="handleDelete(element.id)"
                  >
                    حذف
                  </Button>
                </TableCell>
  
              </TableRow>
            </template>
          </draggable>
        </Table>
  
      </div>
    </AppLayout>
  </template>
  