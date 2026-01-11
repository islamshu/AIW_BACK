<script setup>

import AboutContent from '@/components/about/AboutContent.vue';
import AboutHeader from '@/components/about/AboutHeader.vue';
import MainLayout from '@/Layouts/MainLayout.vue'
</script>


<template>
    <MainLayout>
        <!-- رأس الصفحة -->
        <AboutHeader />

        <!-- محتوى الصفحة -->
        <AboutContent />
    </MainLayout>
</template>