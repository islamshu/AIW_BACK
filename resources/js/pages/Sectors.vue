<script setup lang="ts">
import SectorHeader from '@/components/sectors/SectorHeader.vue';
import SectorPlan from '@/components/sectors/SectorPlan.vue';
import SectorStatistic from '@/components/sectors/SectorStatistic.vue';
import MainLayout from '@/layouts/MainLayout.vue';

</script>
<style>
    :root {
        --navy: #0a192f;
        --sky-blue: #00b4d8;
        --pink: #ff5d8f;
    }
    
    body {
        font-family: 'Cairo', sans-serif;
    }
    
    body[dir="ltr"] {
        font-family: 'Poppins', sans-serif;
    }
    
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }
    
    .fade-in.appear {
        opacity: 1;
        transform: translateY(0);
    }
    
    .slide-in-left {
        opacity: 0;
        transform: translateX(-50px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }
    
    .slide-in-left.appear {
        opacity: 1;
        transform: translateX(0);
    }
    
    .slide-in-right {
        opacity: 0;
        transform: translateX(50px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }
    
    .slide-in-right.appear {
        opacity: 1;
        transform: translateX(0);
    }
    
    .gradient-text {
        background: linear-gradient(to right, var(--sky-blue), var(--pink));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .nav-link-hover::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 0;
        height: 2px;
        background: var(--sky-blue);
        transition: all 0.3s ease;
    }
    
    .nav-link-hover:hover::after {
        width: 100%;
    }
    
    .card-hover {
        transition: all 0.3s ease;
    }
    
    .card-hover:hover {
        transform: translateY(-10px);
        border-color: var(--sky-blue);
        box-shadow: 0 10px 30px -15px rgba(2, 12, 27, 0.7);
    }
    
    .sector-card {
        position: relative;
        overflow: hidden;
    }
    
    .sector-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--sky-blue), var(--pink));
        border-radius: 0 0 0 80px;
        opacity: 0.1;
    }
    
    .sector-icon {
        transition: all 0.5s ease;
    }
    
    .sector-card:hover .sector-icon {
        transform: scale(1.1) rotate(5deg);
    }
    
    .sector-image {
        transition: all 0.5s ease;
    }
    
    .sector-image:hover {
        transform: scale(1.05);
    }
    
    .sector-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: linear-gradient(135deg, var(--sky-blue), var(--pink));
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: bold;
    }
    
    .market-size-bar {
        height: 8px;
        background: linear-gradient(to right, var(--sky-blue), var(--pink));
        border-radius: 4px;
        transition: width 1.5s ease-in-out;
    }
</style>

<template>
    <MainLayout>

       <SectorHeader />
       <SectorPlan />
       <SectorStatistic />
    </MainLayout>
</template>