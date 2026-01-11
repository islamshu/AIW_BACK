<script setup lang="ts">
import ContactForm from '@/components/contact/ContactForm.vue';
import ContactHeader from '@/components/contact/ContactHeader.vue';
import ContactMap from '@/components/contact/ContactMap.vue';
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
    
    .contact-input {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }
    
    .contact-input:focus {
        outline: none;
        border-color: var(--sky-blue);
        box-shadow: 0 0 0 3px rgba(0, 180, 216, 0.1);
        background: rgba(255, 255, 255, 0.08);
    }
    
    .map-container {
        border-radius: 15px;
        overflow: hidden;
        position: relative;
    }
    
    .map-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(10, 25, 47, 0.8) 0%, rgba(0, 180, 216, 0.2) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .pulse-contact {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .floating-icon {
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
</style>

<template>
    <MainLayout>
        <ContactHeader />
        <ContactForm />
        <ContactMap />

      

       
    </MainLayout>
</template>