<script setup>
    import { Link } from '@inertiajs/vue3'
    </script>
    
<template>
      <footer class="bg-[#0a192f] pt-16 pb-8 border-t border-[#00b4d8]/10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- العمود 1 -->
                <div>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f] rounded-lg flex items-center justify-center">
                            <span class="font-bold text-xl">AIW</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Advanced Innovation Works</h3>
                            <p class="text-[#00b4d8] text-sm">Multi-Sector Investment & Operations Group</p>
                        </div>
                    </div>
                    <p class="text-[#8892b0]" data-ar="مجموعة أعمال تعمل وفق نموذج الاستثمار المصحوب بالتشغيل في قطاعات استراتيجية متنوعة. نؤمن بأن الاستثمار الحقيقي يتحقق من خلال تشغيل فعال وبناء شركات مستدامة." data-en="A business group operating under the Invest & Operate model in various strategic sectors. We believe that real investment is achieved through effective operation and building sustainable companies.">
                        مجموعة أعمال تعمل وفق نموذج الاستثمار المصحوب بالتشغيل في قطاعات استراتيجية متنوعة. نؤمن بأن الاستثمار الحقيقي يتحقق من خلال تشغيل فعال وبناء شركات مستدامة.
                    </p>
                </div>
                
                <!-- العمود 2 -->
                <div>
                    <h4 class="text-xl font-bold mb-6 relative pb-3" data-ar="روابط سريعة" data-en="Quick Links">
                        روابط سريعة
                        <div class="absolute bottom-0 right-0 w-12 h-1 bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f] rounded-full"></div>
                    </h4>
                    <ul class="space-y-3">
                        <li><Link href="index" class="text-[#00b4d8] font-medium flex items-center gap-2" data-ar="الرئيسية" data-en="Home"><i class="fas fa-arrow-left text-xs"></i> الرئيسية</Link></li>
                        <li><Link href="about" class="text-[#8892b0] hover:text-[#00b4d8] transition-colors duration-300 flex items-center gap-2" data-ar="من نحن" data-en="About Us"><i class="fas fa-arrow-left text-xs"></i> من نحن</Link></li>
                        <li><Link href="vision" class="text-[#8892b0] hover:text-[#00b4d8] transition-colors duration-300 flex items-center gap-2" data-ar="الرؤية" data-en="Vision"><i class="fas fa-arrow-left text-xs"></i> الرؤية</Link></li>
                        <li><Link href="strategy" class="text-[#8892b0] hover:text-[#00b4d8] transition-colors duration-300 flex items-center gap-2" data-ar="الإستراتيجية" data-en="Strategy"><i class="fas fa-arrow-left text-xs"></i> الإستراتيجية</Link></li>
                        <li><Link href="sectors" class="text-[#8892b0] hover:text-[#00b4d8] transition-colors duration-300 flex items-center gap-2" data-ar="القطاعات" data-en="Sectors"><i class="fas fa-arrow-left text-xs"></i> القطاعات</Link></li>
                        <li><Link href="contact" class="text-[#8892b0] hover:text-[#00b4d8] transition-colors duration-300 flex items-center gap-2" data-ar="اتصل بنا" data-en="Contact"><i class="fas fa-arrow-left text-xs"></i> اتصل بنا</Link></li>
                    </ul>
                </div>
                
                <!-- العمود 3 -->
                <div>
                    <h4 class="text-xl font-bold mb-6 relative pb-3" data-ar="اتصل بنا" data-en="Contact Us">
                        اتصل بنا
                        <div class="absolute bottom-0 right-0 w-12 h-1 bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f] rounded-full"></div>
                    </h4>
                    <ul class="space-y-4 mb-6">
                        <li class="flex items-center gap-3 text-[#8892b0]">
                            <i class="fas fa-map-marker-alt text-[#00b4d8]"></i>
                            <span data-ar="الرياض، المملكة العربية السعودية" data-en="Riyadh, Saudi Arabia">الرياض، المملكة العربية السعودية</span>
                        </li>
                        <li class="flex items-center gap-3 text-[#8892b0]">
                            <i class="fas fa-envelope text-[#00b4d8]"></i>
                            <span>info@aiw-group.com</span>
                        </li>
                        <li class="flex items-center gap-3 text-[#8892b0]">
                            <i class="fas fa-phone text-[#00b4d8]"></i>
                            <span>+966 11 123 4567</span>
                        </li>
                    </ul>
                    <div class="flex gap-4">
                        <Link href="#" class="w-10 h-10 bg-[#233554] rounded-full flex items-center justify-center text-white hover:bg-gradient-to-r hover:from-[#00b4d8] hover:to-[#ff5d8f] transition-all duration-300">
                            <i class="fab fa-twitter"></i>
                        </Link>
                        <Link href="#" class="w-10 h-10 bg-[#233554] rounded-full flex items-center justify-center text-white hover:bg-gradient-to-r hover:from-[#00b4d8] hover:to-[#ff5d8f] transition-all duration-300">
                            <i class="fab fa-linkedin"></i>
                        </Link>
                        <Link href="#" class="w-10 h-10 bg-[#233554] rounded-full flex items-center justify-center text-white hover:bg-gradient-to-r hover:from-[#00b4d8] hover:to-[#ff5d8f] transition-all duration-300">
                            <i class="fab fa-instagram"></i>
                        </Link>
                        <Link href="#" class="w-10 h-10 bg-[#233554] rounded-full flex items-center justify-center text-white hover:bg-gradient-to-r hover:from-[#00b4d8] hover:to-[#ff5d8f] transition-all duration-300">
                            <i class="fab fa-youtube"></i>
                        </Link>
                    </div>
                </div>
            </div>
            
            <!-- حقوق النشر -->
            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-[#8892b0] text-sm">
                    &copy; <span data-ar="2023 AIW Group. جميع الحقوق محفوظة." data-en="2023 AIW Group. All rights reserved.">2023 AIW Group. جميع الحقوق محفوظة.</span>
                </p>
                <p class="text-[#00b4d8] text-sm" data-ar="ملف بروفايل الشركات متعدد الأنشطة – النسخة الاستراتيجية" data-en="Multi-Activity Company Profile – Strategic Version">
                    ملف بروفايل الشركات متعدد الأنشطة – النسخة الاستراتيجية
                </p>
            </div>
        </div>
    </footer>
</template>