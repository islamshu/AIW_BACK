<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue'
    import Button from '@/components/ui/button/Button.vue'
    import { Head, useForm, usePage, Link } from '@inertiajs/vue3'
    import type { BreadcrumbItem } from '@/types'
    import { computed } from 'vue'
    
    import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
    import { Rocket } from 'lucide-vue-next'
    
    /* =======================
       Props
    ======================= */
    const props = defineProps<{
        page: {
            id: number
            title: string
            slug: string
            content: string | null
        }
    }>()
    
    /* =======================
       Breadcrumbs
    ======================= */
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Pages',
            href: route('dashboard.pages.index'),
        },
        {
            title: 'Edit Page',
        },
    ]
    
    /* =======================
       Form
    ======================= */
    const form = useForm({
        title: props.page.title,
        content: props.page.content ?? '',
    })
    
    /* =======================
       Flash message (SAFE)
    ======================= */
    const pageData = usePage()
    const flashMessage = computed(() => pageData.props.flash?.message)
    </script>
    
    <template>
        <Head :title="`Edit - ${props.page.title}`" />
    
        <AppLayout :breadcrumbs="breadcrumbs">
            <div class="p-4 space-y-6 max-w-4xl">
    
                <!-- Flash Message -->
                <Alert
                    v-if="flashMessage"
                    class="bg-blue-200 dark:bg-blue-900/50 border-blue-400 dark:border-blue-800 text-blue-900 dark:text-blue-100"
                >
                    <Rocket class="h-4 w-4" />
                    <AlertTitle>Notification</AlertTitle>
                    <AlertDescription>
                        {{ flashMessage }}
                    </AlertDescription>
                </Alert>
    
                <!-- Header -->
                <div>
                    <h1 class="text-xl font-bold">
                        Edit Page
                    </h1>
                    <p class="text-sm text-muted-foreground">
                        Slug: <span class="font-mono">{{ props.page.slug }}</span>
                    </p>
                </div>
    
                <!-- Form -->
                <form
                    @submit.prevent="form.put(route('dashboard.pages.update', props.page.id))"
                    class="space-y-6"
                >
                    <!-- Title -->
                    <div>
                        <label class="block mb-1 font-medium">
                            Title
                        </label>
                        <input
                            v-model="form.title"
                            type="text"
                            class="w-full rounded-md border bg-background p-2"
                        />
                        <div
                            v-if="form.errors.title"
                            class="text-sm text-red-500 mt-1"
                        >
                            {{ form.errors.title }}
                        </div>
                    </div>
    
                    <!-- Content -->
                    <div>
                        <label class="block mb-1 font-medium">
                            Content
                        </label>
                        <textarea
                            v-model="form.content"
                            rows="10"
                            class="w-full rounded-md border bg-background p-2"
                        />
                        <div
                            v-if="form.errors.content"
                            class="text-sm text-red-500 mt-1"
                        >
                            {{ form.errors.content }}
                        </div>
                    </div>
    
                    <!-- Actions -->
                    <div class="flex items-center gap-3">
                        <Button
                            type="submit"
                            :disabled="form.processing"
                        >
                            Save
                        </Button>
    
                        <Link
                            :href="route('dashboard.pages.index')"
                            class="text-sm text-muted-foreground hover:underline"
                        >
                            Cancel
                        </Link>
                    </div>
                </form>
    
            </div>
        </AppLayout>
    </template>
    