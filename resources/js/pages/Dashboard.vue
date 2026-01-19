<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue'
    import { Head } from '@inertiajs/vue3'
    import { dashboard } from '@/routes'
    import type { BreadcrumbItem } from '@/types'
    
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: dashboard().url,
        },
    ]
    
    // بيانات مؤقتة (لاحقًا نربطها من Laravel)
    const stats = [
        {
            title: 'الصفحات',
            value: 3,
            icon: '📄',
        },
        {
            title: 'القطاعات',
            value: 6,
            icon: '🏭',
        },
        {
            title: 'الرسائل',
            value: 12,
            icon: '✉️',
        },
    ]
    </script>
    
    <template>
        <Head title="Dashboard"   />
    
        <AppLayout :breadcrumbs="breadcrumbs">
            <div class="flex flex-col gap-6 p-4">
    
                <!-- العنوان -->
                <div>
                    <h1 class="text-2xl font-bold">
                        Dashboard
                    </h1>
                    <p class="text-sm text-muted-foreground">
                        نظرة عامة على محتوى وإدارة موقع AIW
                    </p>
                </div>
    
                <!-- كروت الإحصائيات -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div
                        v-for="stat in stats"
                        :key="stat.title"
                        class="rounded-xl border border-sidebar-border/70 bg-white p-6 shadow-sm transition hover:shadow-md dark:border-sidebar-border dark:bg-neutral-900"
                    >
                        <div class="flex items-center justify-between">
                            <span class="text-3xl">
                                {{ stat.icon }}
                            </span>
                            <span class="text-sm text-muted-foreground">
                                {{ stat.title }}
                            </span>
                        </div>
    
                        <div class="mt-4 text-3xl font-bold">
                            {{ stat.value }}
                        </div>
                    </div>
                </div>
    
                <!-- آخر التحديثات -->
                <div
                    class="rounded-xl border border-sidebar-border/70 bg-white p-6 shadow-sm dark:border-sidebar-border dark:bg-neutral-900"
                >
                    <h2 class="mb-4 text-lg font-semibold">
                        آخر التحديثات
                    </h2>
    
                    <ul class="space-y-3 text-sm text-muted-foreground">
                        <li>✔ تم تعديل صفحة "من نحن"</li>
                        <li>✔ تم تحديث رؤية الشركة</li>
                        <li>✔ تم إضافة قطاع جديد</li>
                    </ul>
                </div>
    
            </div>
        </AppLayout>
    </template>
    