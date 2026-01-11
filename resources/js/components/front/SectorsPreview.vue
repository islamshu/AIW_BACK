<template>
    <section class="py-20 bg-[#112240]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold gradient-text mb-6 fade-in" data-ar="القطاعات الاستراتيجية" data-en="Strategic Sectors">القطاعات الاستراتيجية</h2>
                <p class="text-xl text-[#a8b2d1] max-w-3xl mx-auto fade-in" data-ar="نركز على القطاعات ذات النمو المرتفع والإمكانيات الكبيرة في الأسواق المحلية والإقليمية" data-en="We focus on high-growth sectors with significant potential in local and regional markets">
                    نركز على القطاعات ذات النمو المرتفع والإمكانيات الكبيرة في الأسواق المحلية والإقليمية
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- قطاع 1 -->
                <div class="bg-[#233554] rounded-2xl overflow-hidden card-hover fade-in">
                    <div class="relative h-48 overflow-hidden">
                        <div class="sector-badge" data-ar="نمو مرتفع" data-en="High Growth">نمو مرتفع</div>
                        <div class="w-full h-full bg-gradient-to-r from-[#00b4d8] to-[#0096c7] flex items-center justify-center">
                            <i class="fas fa-robot text-white text-6xl floating-icon"></i>
                        </div>
                        <div class="image-overlay">
                            <h4 class="text-white font-bold text-lg" data-ar="التقنية والذكاء الاصطناعي" data-en="Technology & AI">التقنية والذكاء الاصطناعي</h4>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-3" data-ar="التقنية والذكاء الاصطناعي" data-en="Technology & AI">التقنية والذكاء الاصطناعي</h3>
                        <p class="text-[#8892b0]" data-ar="حلول الذكاء الاصطناعي، برمجيات المؤسسات، التقنيات الناشئة" data-en="AI solutions, enterprise software, emerging technologies">
                            حلول الذكاء الاصطناعي، برمجيات المؤسسات، التقنيات الناشئة
                        </p>
                        <a href="sectors.html" class="text-[#00b4d8] font-medium mt-4 inline-flex items-center gap-2" data-ar="المزيد" data-en="More">
                            <span>المزيد</span>
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
                
                <!-- قطاع 2 -->
                <div class="bg-[#233554] rounded-2xl overflow-hidden card-hover fade-in" style="transition-delay: 0.1s;">
                    <div class="relative h-48 overflow-hidden">
                        <div class="sector-badge" data-ar="مستدام" data-en="Sustainable">مستدام</div>
                        <div class="w-full h-full bg-gradient-to-r from-[#38b000] to-[#70e000] flex items-center justify-center">
                            <i class="fas fa-solar-panel text-white text-6xl floating-icon" style="animation-delay: 0.5s;"></i>
                        </div>
                        <div class="image-overlay">
                            <h4 class="text-white font-bold text-lg" data-ar="الطاقة المتجددة" data-en="Renewable Energy">الطاقة المتجددة</h4>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-3" data-ar="الطاقة المتجددة" data-en="Renewable Energy">الطاقة المتجددة</h3>
                        <p class="text-[#8892b0]" data-ar="مشاريع الطاقة الشمسية، طاقة الرياح، حلول التخزين" data-en="Solar energy projects, wind energy, storage solutions">
                            مشاريع الطاقة الشمسية، طاقة الرياح، حلول التخزين
                        </p>
                        <a href="sectors.html" class="text-[#00b4d8] font-medium mt-4 inline-flex items-center gap-2" data-ar="المزيد" data-en="More">
                            <span>المزيد</span>
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
                
                <!-- قطاع 3 -->
                <div class="bg-[#233554] rounded-2xl overflow-hidden card-hover fade-in" style="transition-delay: 0.2s;">
                    <div class="relative h-48 overflow-hidden">
                        <div class="sector-badge" data-ar="أساسي" data-en="Essential">أساسي</div>
                        <div class="w-full h-full bg-gradient-to-r from-[#ff5d8f] to-[#ff97b7] flex items-center justify-center">
                            <i class="fas fa-heartbeat text-white text-6xl floating-icon" style="animation-delay: 1s;"></i>
                        </div>
                        <div class="image-overlay">
                            <h4 class="text-white font-bold text-lg" data-ar="الرعاية الصحية" data-en="Healthcare">الرعاية الصحية</h4>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-3" data-ar="الرعاية الصحية" data-en="Healthcare">الرعاية الصحية</h3>
                        <p class="text-[#8892b0]" data-ar="التطبيب عن بُعد، التقنيات الطبية، الصحة الرقمية" data-en="Telemedicine, medical technologies, digital health">
                            التطبيب عن بُعد، التقنيات الطبية، الصحة الرقمية
                        </p>
                        <a href="sectors.html" class="text-[#00b4d8] font-medium mt-4 inline-flex items-center gap-2" data-ar="المزيد" data-en="More">
                            <span>المزيد</span>
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12 fade-in">
                <a href="sectors.html" class="bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f] text-white font-bold py-3 px-8 rounded-full inline-flex items-center gap-2 hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-ar="عرض جميع القطاعات" data-en="View All Sectors">
                    <span>عرض جميع القطاعات</span>
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </section>
</template>