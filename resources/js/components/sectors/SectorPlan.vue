<template>
            <!-- خريطة القطاعات -->
            <section class="py-20 bg-[#112240]">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold gradient-text mb-6 fade-in" data-ar="خريطة استثماراتنا"
                        data-en="Our Investment Map">خريطة استثماراتنا</h2>
                    <p class="text-xl text-[#a8b2d1] max-w-3xl mx-auto fade-in"
                        data-ar="نستثمر في ستة قطاعات رئيسية تمثل محركات النمو في الاقتصاد الحديث"
                        data-en="We invest in six main sectors that represent growth drivers in the modern economy">
                        نستثمر في ستة قطاعات رئيسية تمثل محركات النمو في الاقتصاد الحديث
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- قطاع 1: التقنية والذكاء الاصطناعي -->
                    <div class="sector-card bg-[#233554] rounded-2xl overflow-hidden card-hover fade-in">
                        <div class="relative">
                            <div class="sector-badge" data-ar="نمو مرتفع" data-en="High Growth">نمو مرتفع</div>
                            <div
                                class="h-48 bg-gradient-to-r from-[#00b4d8] to-[#0096c7] flex items-center justify-center sector-image">
                                <i class="fas fa-robot text-white text-6xl sector-icon"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-3" data-ar="التقنية والذكاء الاصطناعي"
                                data-en="Technology & AI">التقنية والذكاء الاصطناعي</h3>
                            <p class="text-[#8892b0] mb-4"
                                data-ar="حلول الذكاء الاصطناعي، برمجيات المؤسسات، التقنيات الناشئة، ومنصات البيانات الضخمة"
                                data-en="AI solutions, enterprise software, emerging technologies, and big data platforms">
                                حلول الذكاء الاصطناعي، برمجيات المؤسسات، التقنيات الناشئة، ومنصات البيانات الضخمة
                            </p>
                            <div class="mb-2 flex justify-between">
                                <span class="text-sm text-[#a8b2d1]" data-ar="حجم السوق" data-en="Market Size">حجم
                                    السوق</span>
                                <span class="text-sm font-bold text-[#00b4d8]">$85B</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="market-size-bar h-2 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- قطاع 2: الطاقة المتجددة -->
                    <div class="sector-card bg-[#233554] rounded-2xl overflow-hidden card-hover fade-in"
                        style="transition-delay: 0.1s;">
                        <div class="relative">
                            <div class="sector-badge" data-ar="مستدام" data-en="Sustainable">مستدام</div>
                            <div
                                class="h-48 bg-gradient-to-r from-[#38b000] to-[#70e000] flex items-center justify-center sector-image">
                                <i class="fas fa-solar-panel text-white text-6xl sector-icon"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-3" data-ar="الطاقة المتجددة"
                                data-en="Renewable Energy">الطاقة المتجددة</h3>
                            <p class="text-[#8892b0] mb-4"
                                data-ar="مشاريع الطاقة الشمسية، طاقة الرياح، حلول التخزين، وكفاءة الطاقة للمؤسسات"
                                data-en="Solar energy projects, wind energy, storage solutions, and energy efficiency for enterprises">
                                مشاريع الطاقة الشمسية، طاقة الرياح، حلول التخزين، وكفاءة الطاقة للمؤسسات
                            </p>
                            <div class="mb-2 flex justify-between">
                                <span class="text-sm text-[#a8b2d1]" data-ar="حجم السوق" data-en="Market Size">حجم
                                    السوق</span>
                                <span class="text-sm font-bold text-[#00b4d8]">$78B</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="market-size-bar h-2 rounded-full" style="width: 78%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- قطاع 3: الرعاية الصحية -->
                    <div class="sector-card bg-[#233554] rounded-2xl overflow-hidden card-hover fade-in"
                        style="transition-delay: 0.2s;">
                        <div class="relative">
                            <div class="sector-badge" data-ar="أساسي" data-en="Essential">أساسي</div>
                            <div
                                class="h-48 bg-gradient-to-r from-[#ff5d8f] to-[#ff97b7] flex items-center justify-center sector-image">
                                <i class="fas fa-heartbeat text-white text-6xl sector-icon"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-3" data-ar="الرعاية الصحية" data-en="Healthcare">
                                الرعاية الصحية</h3>
                            <p class="text-[#8892b0] mb-4"
                                data-ar="التطبيب عن بُعد، التقنيات الطبية، إدارة المستشفيات، والصحة الرقمية"
                                data-en="Telemedicine, medical technologies, hospital management, and digital health">
                                التطبيب عن بُعد، التقنيات الطبية، إدارة المستشفيات، والصحة الرقمية
                            </p>
                            <div class="mb-2 flex justify-between">
                                <span class="text-sm text-[#a8b2d1]" data-ar="حجم السوق" data-en="Market Size">حجم
                                    السوق</span>
                                <span class="text-sm font-bold text-[#00b4d8]">$92B</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="market-size-bar h-2 rounded-full" style="width: 92%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- قطاع 4: التجارة الإلكترونية -->
                    <div class="sector-card bg-[#233554] rounded-2xl overflow-hidden card-hover fade-in"
                        style="transition-delay: 0.3s;">
                        <div class="relative">
                            <div class="sector-badge" data-ar="سريع النمو" data-en="Fast Growing">سريع النمو</div>
                            <div
                                class="h-48 bg-gradient-to-r from-[#ff9e00] to-[#ffd000] flex items-center justify-center sector-image">
                                <i class="fas fa-shopping-cart text-white text-6xl sector-icon"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-3" data-ar="التجارة الإلكترونية"
                                data-en="E-commerce">التجارة الإلكترونية</h3>
                            <p class="text-[#8892b0] mb-4"
                                data-ar="منصات البيع بالتجزئة، حلول الدفع الإلكتروني، الخدمات اللوجستية، والتجارة الاجتماعية"
                                data-en="Retail platforms, electronic payment solutions, logistics, and social commerce">
                                منصات البيع بالتجزئة، حلول الدفع الإلكتروني، الخدمات اللوجستية، والتجارة الاجتماعية
                            </p>
                            <div class="mb-2 flex justify-between">
                                <span class="text-sm text-[#a8b2d1]" data-ar="حجم السوق" data-en="Market Size">حجم
                                    السوق</span>
                                <span class="text-sm font-bold text-[#00b4d8]">$88B</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="market-size-bar h-2 rounded-full" style="width: 88%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- قطاع 5: التعليم التقني -->
                    <div class="sector-card bg-[#233554] rounded-2xl overflow-hidden card-hover fade-in"
                        style="transition-delay: 0.4s;">
                        <div class="relative">
                            <div class="sector-badge" data-ar="معرفي" data-en="Knowledge">معرفي</div>
                            <div
                                class="h-48 bg-gradient-to-r from-[#9d4edd] to-[#c77dff] flex items-center justify-center sector-image">
                                <i class="fas fa-graduation-cap text-white text-6xl sector-icon"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-3" data-ar="التعليم التقني"
                                data-en="Technical Education">التعليم التقني</h3>
                            <p class="text-[#8892b0] mb-4"
                                data-ar="منصات التعلم الإلكتروني، التدريب المهني، تطوير المهارات الرقمية، والتعليم الموجه للصناعة"
                                data-en="E-learning platforms, vocational training, digital skills development, and industry-oriented education">
                                منصات التعلم الإلكتروني، التدريب المهني، تطوير المهارات الرقمية، والتعليم الموجه للصناعة
                            </p>
                            <div class="mb-2 flex justify-between">
                                <span class="text-sm text-[#a8b2d1]" data-ar="حجم السوق" data-en="Market Size">حجم
                                    السوق</span>
                                <span class="text-sm font-bold text-[#00b4d8]">$75B</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="market-size-bar h-2 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- قطاع 6: الزراعة الحديثة -->
                    <div class="sector-card bg-[#233554] rounded-2xl overflow-hidden card-hover fade-in"
                        style="transition-delay: 0.5s;">
                        <div class="relative">
                            <div class="sector-badge" data-ar="إستراتيجي" data-en="Strategic">إستراتيجي</div>
                            <div
                                class="h-48 bg-gradient-to-r from-[#52b788] to-[#95d5b2] flex items-center justify-center sector-image">
                                <i class="fas fa-seedling text-white text-6xl sector-icon"></i>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-3" data-ar="الزراعة الحديثة"
                                data-en="Modern Agriculture">الزراعة الحديثة</h3>
                            <p class="text-[#8892b0] mb-4"
                                data-ar="الزراعة الذكية، تقنيات الري الحديث، إنتاج الأغذية، وسلاسل التوريد الزراعية"
                                data-en="Smart agriculture, modern irrigation technologies, food production, and agricultural supply chains">
                                الزراعة الذكية، تقنيات الري الحديث، إنتاج الأغذية، وسلاسل التوريد الزراعية
                            </p>
                            <div class="mb-2 flex justify-between">
                                <span class="text-sm text-[#a8b2d1]" data-ar="حجم السوق" data-en="Market Size">حجم
                                    السوق</span>
                                <span class="text-sm font-bold text-[#00b4d8]">$70B</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="market-size-bar h-2 rounded-full" style="width: 70%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

</template>