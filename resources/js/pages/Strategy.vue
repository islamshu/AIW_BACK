<script setup>
import StartgyHeader from '@/components/strategy/StartgyHeader.vue';
import MainLayout from '@/layouts/MainLayout.vue';


</script>
<template>
    <MainLayout>

        <StartgyHeader/>

        <!-- استراتيجية Invest & Operate -->
        <section class="py-20 bg-[#112240]">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold gradient-text mb-6 fade-in"
                        data-ar="استراتيجية Invest & Operate" data-en="Invest & Operate Strategy">استراتيجية Invest &
                        Operate</h2>
                    <p class="text-xl text-[#a8b2d1] max-w-3xl mx-auto fade-in"
                        data-ar="دمج التمويل مع التشغيل الفعال لبناء شركات مستدامة وقابلة للتوسع"
                        data-en="Combining financing with effective operation to build sustainable and scalable companies">
                        دمج التمويل مع التشغيل الفعال لبناء شركات مستدامة وقابلة للتوسع
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="slide-in-left">
                        <div class="bg-[#233554] rounded-2xl p-8 card-hover">
                            <!-- صورة رمزية لاستراتيجية -->
                            <div class="mb-6 overflow-hidden rounded-xl">
                                <div
                                    class="h-48 bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f] rounded-xl flex items-center justify-center">
                                    <i class="fas fa-chess-board text-white text-6xl"></i>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-4" data-ar="نموذج متكامل"
                                data-en="Integrated Model">نموذج متكامل</h3>
                            <p class="text-[#8892b0]"
                                data-ar="نقدم نموذجاً فريداً يجمع بين القوة المالية والخبرة التشغيلية لتحقيق أقصى قدر من القيمة للمستثمرين والشركاء"
                                data-en="We offer a unique model that combines financial strength with operational expertise to maximize value for investors and partners">
                                نقدم نموذجاً فريداً يجمع بين القوة المالية والخبرة التشغيلية لتحقيق أقصى قدر من القيمة
                                للمستثمرين والشركاء
                            </p>
                        </div>
                    </div>

                    <div class="slide-in-right">
                        <div class="space-y-8">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f] rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-white mb-2" data-ar="مشاركة تشغيلية فعلية"
                                        data-en="Active Operational Participation">مشاركة تشغيلية فعلية</h4>
                                    <p class="text-[#8892b0]"
                                        data-ar="لا نكتفي بالتمويل بل نشارك في الإدارة والتشغيل اليومي لضمان نجاح المشاريع"
                                        data-en="We don't just provide financing; we actively participate in daily management and operation to ensure project success">
                                        لا نكتفي بالتمويل بل نشارك في الإدارة والتشغيل اليومي لضمان نجاح المشاريع
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f] rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-white mb-2"
                                        data-ar="توظيف التقنية والذكاء الاصطناعي" data-en="Technology & AI Utilization">
                                        توظيف التقنية والذكاء الاصطناعي</h4>
                                    <p class="text-[#8892b0]"
                                        data-ar="نستخدم أحدث التقنيات لتحسين العمليات وزيادة الكفاءة وتحليل البيانات لاتخاذ قرارات أفضل"
                                        data-en="We use the latest technologies to improve processes, increase efficiency, and analyze data for better decision-making">
                                        نستخدم أحدث التقنيات لتحسين العمليات وزيادة الكفاءة وتحليل البيانات لاتخاذ
                                        قرارات أفضل
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f] rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-white mb-2"
                                        data-ar="بناء شركات مستقلة وقابلة للتوسع"
                                        data-en="Building Independent & Scalable Companies">بناء شركات مستقلة وقابلة
                                        للتوسع</h4>
                                    <p class="text-[#8892b0]"
                                        data-ar="نعمل على إنشاء كيانات مستقلة يمكنها النمو والتوسع بسرعة مع الحفاظ على الجودة والكفاءة"
                                        data-en="We work to create independent entities that can grow and expand rapidly while maintaining quality and efficiency">
                                        نعمل على إنشاء كيانات مستقلة يمكنها النمو والتوسع بسرعة مع الحفاظ على الجودة
                                        والكفاءة
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- الخطوات الزمنية -->
        <section class="py-20 bg-[#0a192f]">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-16 gradient-text fade-in"
                    data-ar="مراحل تنفيذ المشاريع" data-en="Project Implementation Stages">مراحل تنفيذ المشاريع</h2>

                <div class="strategy-timeline space-y-16 relative">
                    <!-- المرحلة 1 -->
                    <div class="flex flex-col md:flex-row items-center gap-8 relative">
                        <div class="md:w-1/2 md:text-right md:pr-12 fade-in">
                            <div class="bg-[#233554] rounded-2xl p-6 card-hover">
                                <div class="flex items-center gap-4 mb-4">
                                    <div
                                        class="w-14 h-14 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f] rounded-full flex items-center justify-center text-white font-bold text-xl">
                                        1
                                    </div>
                                    <h3 class="text-xl font-bold text-white" data-ar="التحديد والتحليل"
                                        data-en="Identification & Analysis">التحديد والتحليل</h3>
                                </div>
                                <p class="text-[#8892b0]"
                                    data-ar="تحليل الفرص الاستثمارية في القطاعات ذات النمو المرتفع وتحديد الأنشطة الواعدة من خلال دراسات السوق والجداول المالية المتقدمة"
                                    data-en="Analyzing investment opportunities in high-growth sectors and identifying promising activities through market studies and advanced financial tables">
                                    تحليل الفرص الاستثمارية في القطاعات ذات النمو المرتفع وتحديد الأنشطة الواعدة من خلال
                                    دراسات السوق والجداول المالية المتقدمة
                                </p>
                            </div>
                        </div>

                        <!-- صورة رمزية -->
                        <div class="md:w-1/2 md:pl-12 fade-in">
                            <div
                                class="h-48 bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f] rounded-xl flex items-center justify-center image-hover">
                                <i class="fas fa-search text-white text-6xl"></i>
                            </div>
                        </div>

                        <div class="timeline-dot"></div>
                    </div>

                    <!-- المرحلة 2 -->
                    <div class="flex flex-col md:flex-row items-center gap-8 relative">
                        <div class="md:w-1/2 md:order-2 md:pl-12 fade-in">
                            <div class="bg-[#233554] rounded-2xl p-6 card-hover">
                                <div class="flex items-center gap-4 mb-4">
                                    <div
                                        class="w-14 h-14 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f] rounded-full flex items-center justify-center text-white font-bold text-xl">
                                        2
                                    </div>
                                    <h3 class="text-xl font-bold text-white" data-ar="التخطيط الاستراتيجي"
                                        data-en="Strategic Planning">التخطيط الاستراتيجي</h3>
                                </div>
                                <p class="text-[#8892b0]"
                                    data-ar="وضع خطط عمل مفصلة تشمل نماذج الأعمال، الهياكل التنظيمية، الاستراتيجيات التسويقية، والتوقعات المالية مع تحديد مؤشرات الأداء الرئيسية"
                                    data-en="Developing detailed business plans including business models, organizational structures, marketing strategies, and financial forecasts with key performance indicators">
                                    وضع خطط عمل مفصلة تشمل نماذج الأعمال، الهياكل التنظيمية، الاستراتيجيات التسويقية،
                                    والتوقعات المالية مع تحديد مؤشرات الأداء الرئيسية
                                </p>
                            </div>
                        </div>

                        <!-- صورة رمزية -->
                        <div class="md:w-1/2 md:order-1 md:pr-12 fade-in">
                            <div
                                class="h-48 bg-gradient-to-r from-[#ff5d8f] to-[#00b4d8] rounded-xl flex items-center justify-center image-hover">
                                <i class="fas fa-chart-bar text-white text-6xl"></i>
                            </div>
                        </div>

                        <div class="timeline-dot"></div>
                    </div>

                    <!-- المرحلة 3 -->
                    <div class="flex flex-col md:flex-row items-center gap-8 relative">
                        <div class="md:w-1/2 md:text-right md:pr-12 fade-in">
                            <div class="bg-[#233554] rounded-2xl p-6 card-hover">
                                <div class="flex items-center gap-4 mb-4">
                                    <div
                                        class="w-14 h-14 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f] rounded-full flex items-center justify-center text-white font-bold text-xl">
                                        3
                                    </div>
                                    <h3 class="text-xl font-bold text-white" data-ar="التأسيس والتمويل"
                                        data-en="Establishment & Financing">التأسيس والتمويل</h3>
                                </div>
                                <p class="text-[#8892b0]"
                                    data-ar="تأسيس الشركات المتخصصة (SPVs) وتوفير التمويل اللازم مع هياكل استثمارية مرنة تلائم احتياجات كل مشروع وشريك"
                                    data-en="Establishing specialized companies (SPVs) and providing necessary financing with flexible investment structures that suit each project and partner's needs">
                                    تأسيس الشركات المتخصصة (SPVs) وتوفير التمويل اللازم مع هياكل استثمارية مرنة تلائم
                                    احتياجات كل مشروع وشريك
                                </p>
                            </div>
                        </div>

                        <!-- صورة رمزية -->
                        <div class="md:w-1/2 md:pl-12 fade-in">
                            <div
                                class="h-48 bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f] rounded-xl flex items-center justify-center image-hover">
                                <i class="fas fa-building text-white text-6xl"></i>
                            </div>
                        </div>

                        <div class="timeline-dot"></div>
                    </div>

                    <!-- المرحلة 4 -->
                    <div class="flex flex-col md:flex-row items-center gap-8 relative">
                        <div class="md:w-1/2 md:order-2 md:pl-12 fade-in">
                            <div class="bg-[#233554] rounded-2xl p-6 card-hover">
                                <div class="flex items-center gap-4 mb-4">
                                    <div
                                        class="w-14 h-14 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f] rounded-full flex items-center justify-center text-white font-bold text-xl">
                                        4
                                    </div>
                                    <h3 class="text-xl font-bold text-white" data-ar="التشغيل والإدارة"
                                        data-en="Operation & Management">التشغيل والإدارة</h3>
                                </div>
                                <p class="text-[#8892b0]"
                                    data-ar="المشاركة الفعالة في الإدارة والتشغيل مع توظيف الخبرات والكفاءات المتخصصة وتطبيق أفضل الممارسات العالمية في الحوكمة والإدارة"
                                    data-en="Active participation in management and operation with employment of specialized expertise and application of global best practices in governance and management">
                                    المشاركة الفعالة في الإدارة والتشغيل مع توظيف الخبرات والكفاءات المتخصصة وتطبيق أفضل
                                    الممارسات العالمية في الحوكمة والإدارة
                                </p>
                            </div>
                        </div>

                        <!-- صورة رمزية -->
                        <div class="md:w-1/2 md:order-1 md:pr-12 fade-in">
                            <div
                                class="h-48 bg-gradient-to-r from-[#ff5d8f] to-[#00b4d8] rounded-xl flex items-center justify-center image-hover">
                                <i class="fas fa-cogs text-white text-6xl"></i>
                            </div>
                        </div>

                        <div class="timeline-dot"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- مؤشرات الأداء -->
        <section class="py-20 bg-[#112240]">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-16 gradient-text fade-in"
                    data-ar="مؤشرات الأداء الرئيسية" data-en="Key Performance Indicators">مؤشرات الأداء الرئيسية</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center fade-in">
                        <div class="text-5xl font-bold gradient-text mb-4">15+</div>
                        <div class="text-xl text-white mb-2" data-ar="شركة قيد التشغيل"
                            data-en="Companies in Operation">شركة قيد التشغيل</div>
                        <div class="w-full bg-gray-700 rounded-full h-2 mt-4">
                            <div class="progress-bar h-2 rounded-full" style="width: 100%"></div>
                        </div>
                    </div>

                    <div class="text-center fade-in" style="transition-delay: 0.2s;">
                        <div class="text-5xl font-bold gradient-text mb-4">95%</div>
                        <div class="text-xl text-white mb-2" data-ar="معدل نجاح المشاريع"
                            data-en="Project Success Rate">معدل نجاح المشاريع</div>
                        <div class="w-full bg-gray-700 rounded-full h-2 mt-4">
                            <div class="progress-bar h-2 rounded-full" style="width: 95%"></div>
                        </div>
                    </div>

                    <div class="text-center fade-in" style="transition-delay: 0.4s;">
                        <div class="text-5xl font-bold gradient-text mb-4">25%</div>
                        <div class="text-xl text-white mb-2" data-ar="نمو سنوي مركب" data-en="CAGR">نمو سنوي مركب</div>
                        <div class="w-full bg-gray-700 rounded-full h-2 mt-4">
                            <div class="progress-bar h-2 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>

                    <div class="text-center fade-in" style="transition-delay: 0.6s;">
                        <div class="text-5xl font-bold gradient-text mb-4">24</div>
                        <div class="text-xl text-white mb-2" data-ar="شهر متوسط عمر الشركة"
                            data-en="Average Company Age">شهر متوسط عمر الشركة</div>
                        <div class="w-full bg-gray-700 rounded-full h-2 mt-4">
                            <div class="progress-bar h-2 rounded-full" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>