<script setup>
    
import MainLayout from '@/Layouts/MainLayout.vue'
import CallToAction from '@/components/front/CallToAction.vue';
import FeaturesSection from '@/components/front/FeaturesSection.vue';
import HeroSection from '@/components/front/HeroSection.vue'
import LeadershipSection from '@/components/front/LeadershipSection.vue';
import PartnersSection from '@/components/front/PartnersSection.vue';
import SectorsPreview from '@/components/front/SectorsPreview.vue';
import StatsSection from '@/components/front/StatsSection.vue';
    </script>
    
    <template>
      <MainLayout>
        <HeroSection />
        <StatsSection />
        <FeaturesSection />
        <SectorsPreview />
        <PartnersSection />
        <LeadershipSection />
        <CallToAction />
      </MainLayout>
    </template>
    