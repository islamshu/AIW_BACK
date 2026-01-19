<section class="py-20 bg-[#0a192f]">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-16 gradient-text fade-in" data-ar="لماذا تختار AIW؟"
            data-en="Why Choose AIW?">لماذا تختار AIW؟</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- بطاقة 1 -->
            @foreach (App\Models\HomeService::where('is_active', true)->orderBy('order')->get() as $service)
                <div class="bg-[#233554] rounded-2xl p-8 card-hover slide-in-left">
                    @if ($service->icon)
                        <!-- إذا كانت أيقونة FontAwesome -->
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f] rounded-full flex items-center justify-center mx-auto mb-6 floating-icon">
                            <i class="{{ $service->icon }} text-2xl text-white"></i>
                        </div>
                    @elseif($service->image)
                        <!-- إذا كانت صورة -->
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-[#00b4d8] to-[#ff5d8f] rounded-full flex items-center justify-center mx-auto mb-6 floating-icon overflow-hidden">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}"
                                class=" object-cover">
                        </div>
                    @endif

                    <h3 class="text-xl font-bold text-white mb-4 text-center"
                        data-ar="{{ $service->getTranslation('title', 'ar') }}"
                        data-en="{{ $service->getTranslation('title', 'en') }}">
                        {{ $service->title }}
                    </h3>

                    <p class="text-[#8892b0] text-center" data-ar="{{ $service->getTranslation('description', 'ar') }}"
                        data-en="{{ $service->getTranslation('description', 'en') }}">
                        {!! $service->description !!}

                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
