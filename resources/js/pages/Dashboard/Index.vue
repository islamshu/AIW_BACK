<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
</script>

<template>
    <AppLayout :breadcrumbs="[
        { title: 'Dashboard', href: '/dashboard' }
    ]">
        <h1 class="text-2xl font-bold mb-6">
            Dashboard
        </h1>

        <div class="bg-white p-6 rounded-xl shadow">
            🎉 الداشبورد شغالة بنجاح
        </div>
    </AppLayout>
</template>