@extends('layouts.master')
@section('title', 'القطاع')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">

            <h3 class="mb-3">
                {{ isset($sector) ? 'تعديل قطاع' : 'إضافة قطاع' }}
            </h3>

            <form method="POST" enctype="multipart/form-data"
                action="{{ isset($sector) ? route('sectors.update', $sector) : route('sectors.store') }}">
                @csrf
                @if (isset($sector))
                    @method('PUT')
                @endif

                <div class="row">

                    {{-- ================= العنوان ================= --}}
                    <div class="col-md-6 mb-2">
                        <label>العنوان (عربي)</label>
                        <input type="text" name="title[ar]" class="form-control"
                            value="{{ old('title.ar', optional($sector)->getTranslation('title', 'ar')) }}">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>العنوان (إنجليزي)</label>
                        <input type="text" name="title[en]" class="form-control"
                            value="{{ old('title.en', optional($sector)->getTranslation('title', 'en')) }}">
                    </div>

                    {{-- ================= الوصف ================= --}}
                    <div class="col-md-6 mb-2">
                        <label>الوصف (عربي)</label>
                        <textarea name="description[ar]" id="desc_ar" class="form-control js-editor" rows="4">
{{ old('description.ar', optional($sector)->getTranslation('description', 'ar')) }}
</textarea>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>الوصف (إنجليزي)</label>
                        <textarea name="description[en]" id="desc_en" class="form-control js-editor" rows="4">
{{ old('description.en', optional($sector)->getTranslation('description', 'en')) }}
</textarea>
                    </div>

                    {{-- ================= البادج ================= --}}
                    <div class="col-md-6 mb-2">
                        <label>نص البادج (عربي)</label>
                        <input type="text" name="badge_text[ar]" class="form-control"
                            value="{{ old('badge_text.ar', optional($sector)->getTranslation('badge_text', 'ar')) }}">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>نص البادج (إنجليزي)</label>
                        <input type="text" name="badge_text[en]" class="form-control"
                            value="{{ old('badge_text.en', optional($sector)->getTranslation('badge_text', 'en')) }}">
                    </div>

                    {{-- ================= نوع العرض ================= --}}
                    @php
                        $type = old('type') ?? (optional($sector)->image ? 'image' : 'icon');
                    @endphp

                    <div class="col-md-12 mb-3">
                        <label class="d-block mb-1">نوع العرض</label>

                        <label class="me-3">
                            <input type="radio" name="type" value="icon" {{ $type == 'icon' ? 'checked' : '' }}>
                            أيقونة
                        </label>

                        <label>
                            <input type="radio" name="type" value="image" {{ $type == 'image' ? 'checked' : '' }}>
                            صورة
                        </label>
                    </div>

                    {{-- ================= الأيقونة ================= --}}
                    <div class="col-md-6 mb-3" id="iconWrapper">
                        <label>الأيقونة</label>

                        <div class="input-group">
                            <input type="text" name="icon" class="form-control icon-input"
                                placeholder="fa-solid fa-robot" value="{{ old('icon', optional($sector)->icon) }}">

                            <button type="button" class="btn btn-outline-secondary" onclick="openIconPicker(this)">
                                اختيار
                            </button>
                        </div>

                        <div class="icon-preview mt-2">
                            @if (old('icon', optional($sector)->icon))
                                <i class="{{ old('icon', optional($sector)->icon) }} fa-2x text-primary"></i>
                            @endif
                        </div>
                    </div>

                    {{-- ================= الصورة ================= --}}
                    <div class="col-md-6 mb-3" id="imageWrapper">
                        <label>الصورة</label>
                        <input type="hidden" name="image" id="imageInput"
                            value="{{ old('image', $sector->image ?? '') }}">

                        <button type="button" class="btn btn-outline-primary w-100" onclick="openMediaLibrary()">
                            📁 اختيار صورة من المكتبة
                        </button>

                        {{-- IMAGE PREVIEW --}}
                        <div class="mt-2">
                            <img id="imagePreview"
                                src="{{ isset($sector) && $sector->image ? asset('storage/' . $sector->image) : '' }}"
                                class="img-thumbnail"
                                style="max-height:120px; {{ isset($sector) && $sector->image ? '' : 'display:none' }}">
                        </div>
                    </div>

                    {{-- ================= الألوان ================= --}}
                    <div class="col-md-6 mb-2">
                        <label>لون البداية</label>
                        <input type="color" name="gradient_from" class="form-control"
                            value="{{ old('gradient_from', optional($sector)->gradient_from ?? '#000000') }}">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>لون النهاية</label>
                        <input type="color" name="gradient_to" class="form-control"
                            value="{{ old('gradient_to', optional($sector)->gradient_to ?? '#ffffff') }}">
                    </div>

                    {{-- ================= السوق ================= --}}
                    <div class="col-md-6 mb-2">
                        <label>حجم السوق (B)</label>
                        <input type="number" name="market_value" class="form-control"
                            value="{{ old('market_value', optional($sector)->market_value) }}">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>نسبة السوق (%)</label>
                        <input type="number" name="market_percent" class="form-control"
                            value="{{ old('market_percent', optional($sector)->market_percent) }}">
                    </div>



                </div>

                <button class="btn btn-primary mt-3">حفظ</button>

            </form>
        </div>
    </div>
@endsection

@section('script')

    <script>
        /* نوع العرض */
        const iconWrapper = document.getElementById('iconWrapper');
        const imageWrapper = document.getElementById('imageWrapper');

        function toggleType(val) {
            iconWrapper.style.display = val === 'icon' ? 'block' : 'none';
            imageWrapper.style.display = val === 'image' ? 'block' : 'none';
        }

        document.querySelectorAll('input[name="type"]').forEach(r => {
            r.addEventListener('change', () => toggleType(r.value));
        });

        toggleType("{{ $type }}");

        /* Image Preview */
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');

        imageInput?.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        /* Icon Picker (نفس الخدمات) */
        let activeIconInput = null;

        function openIconPicker(button) {
            activeIconInput = button.closest('.col-md-6')
                .querySelector('.icon-input');

            window.open(
                '{{ route('icons.index') }}',
                'IconPicker',
                'width=1000,height=650'
            );
        }

        window.addEventListener('message', function(event) {
            if (event.data.type !== 'icon-selected') return;

            activeIconInput.value = event.data.icon;

            const preview = activeIconInput
                .closest('.col-md-6')
                .querySelector('.icon-preview');

            preview.innerHTML = `<i class="${event.data.icon} fa-2x text-primary"></i>`;
        });
    </script>
@endsection
