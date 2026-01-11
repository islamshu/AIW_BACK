<template>
     <!-- الخريطة -->
     <section class="py-20 bg-[#0a192f]">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 gradient-text fade-in"
                    data-ar="موقعنا على الخريطة" data-en="Our Location on Map">موقعنا على الخريطة</h2>

                <div class="map-container h-96 card-hover">
                    <!-- خريطة رمزية -->
                    <div class="w-full h-full bg-gradient-to-br from-[#0a192f] to-[#112240] relative">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f] rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-2" data-ar="المقر الرئيسي - الرياض"
                                    data-en="Headquarters - Riyadh">المقر الرئيسي - الرياض</h3>
                                <p class="text-[#a8b2d1]" data-ar="حي المالية، برج الأعمال، الطابق 12"
                                    data-en="Financial District, Business Tower, 12th Floor">
                                    حي المالية، برج الأعمال، الطابق 12
                                </p>
                            </div>
                        </div>
                        <div class="map-overlay">
                            <div class="text-center p-8">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f] rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-location-dot text-white text-xl"></i>
                                </div>
                                <h4 class="text-xl font-bold text-white mb-2" data-ar="زيارتنا" data-en="Visit Us">
                                    زيارتنا</h4>
                                <p class="text-[#a8b2d1]" data-ar="نرحب بزيارتكم في مقرنا الرئيسي بعد تحديد موعد مسبق"
                                    data-en="We welcome your visit to our headquarters with a prior appointment">
                                    نرحب بزيارتكم في مقرنا الرئيسي بعد تحديد موعد مسبق
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

</template>