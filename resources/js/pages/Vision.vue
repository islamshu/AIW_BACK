<script setup>
import VisionContent from '@/components/vision/VisionContent.vue';
import VisionGoles from '@/components/vision/VisionGoles.vue';
import VisionHeader from '@/components/vision/VisionHeader.vue';
import VisionPillars from '@/components/vision/VisionPillars.vue';
import MainLayout from '@/Layouts/MainLayout.vue'


</script>
<template>
    <MainLayout>

        <VisionHeader />
        <VisionContent />


        <VisionPillars />
        <VisionGoles />

        <!-- الأهداف -->

    </MainLayout>

</template>