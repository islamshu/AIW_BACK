<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import Button from '@/components/ui/button/Button.vue'
import { Head, Link, usePage } from '@inertiajs/vue3'
import type { BreadcrumbItem } from '@/types'
import { computed } from 'vue'

import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Rocket } from 'lucide-vue-next'

import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'

/* =======================
   Props
======================= */
defineProps<{
    pages: {
        id: number
        title: string
        slug: string
    }[]
}>()

/* =======================
   Breadcrumbs
======================= */
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'الصفحات',
        href: route('dashboard.pages.index'),
    },
]

/* =======================
   Flash message (SAFE)
======================= */
const page = usePage()
const flashMessage = computed(() => page.props.flash?.message)
</script>

<template>

    <Head title="Pages" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 space-y-6">

            <!-- Flash Message -->
            <Alert v-if="flashMessage"
                class="bg-blue-200 dark:bg-blue-900/50 border-blue-400 dark:border-blue-800 text-blue-900 dark:text-blue-100">
                <Rocket class="h-4 w-4" />
                <AlertTitle>Notification</AlertTitle>
                <AlertDescription>
                    {{ flashMessage }}
                </AlertDescription>
            </Alert>

            <!-- Page Header -->
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold">
                    الصفحات
                </h1>
            </div>

            <!-- Pages Table -->
            <div class="rounded-xl border bg-card">
                <Table>
                    <TableCaption>
                       قائمة صفحات الموقع.
                    </TableCaption>

                    <TableHeader>
                        <TableRow>
                            <!-- RTL: الرقم أولًا -->
                            <TableHead class="w-[80px] text-right">#</TableHead>

                            <TableHead class="text-right">العنوان</TableHead>

                            <TableHead class="text-right">الرابط</TableHead>

                            <TableHead class="text-center w-[160px]">
                                الاجراءات
                            </TableHead>
                        </TableRow>
                    </TableHeader>

                    <TableBody>
                        <TableRow v-for="pageItem in pages" :key="pageItem.id">
                            <TableCell class="text-right">
                                {{ pageItem.id }}
                            </TableCell>

                            <TableCell class="text-right">
                                {{ pageItem.title }}
                            </TableCell>

                            <TableCell class="text-right text-muted-foreground">
                                {{ pageItem.slug }}
                            </TableCell>

                            <TableCell class="text-center">
                                <Link :href="route('dashboard.pages.edit', pageItem.id)">
                                    <Button class="bg-orange-400">
                                        تعديل
                                    </Button>
                                </Link>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>

            </div>

        </div>
    </AppLayout>
</template>