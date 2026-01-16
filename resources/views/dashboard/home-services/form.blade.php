@extends('layouts.master')
@section('title','الخدمة')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">

        <h3 class="mb-3">
            {{ isset($homeService) ? 'تعديل خدمة' : 'إضافة خدمة' }}
        </h3>

        <form method="POST"
            enctype="multipart/form-data"
            action="{{ isset($homeService)
                ? route('home-services.update',$homeService)
                : route('home-services.store') }}">
            @csrf
            @if(isset($homeService)) @method('PUT') @endif

            <div class="row">

                {{-- ================= TITLE ================= --}}
                <div class="col-md-6 mb-2">
                    <label>العنوان (AR)</label>
                    <input type="text"
                        name="title[ar]"
                        class="form-control"
                        value="{{ old('title.ar', $homeService->getTranslation('title','ar') ?? '') }}">
                </div>

                <div class="col-md-6 mb-2">
                    <label>Title (EN)</label>
                    <input type="text"
                        name="title[en]"
                        class="form-control"
                        value="{{ old('title.en', $homeService->getTranslation('title','en') ?? '') }}">
                </div>

                {{-- ================= DESCRIPTION ================= --}}
                <div class="col-md-6 mb-2">
                    <label>الوصف (AR)</label>
                    <textarea id="desc_ar"
                        name="description[ar]"
                        class="form-control"
                        rows="5">{!! old('description.ar', $homeService->getTranslation('description','ar') ?? '') !!}</textarea>
                </div>

                <div class="col-md-6 mb-2">
                    <label>Description (EN)</label>
                    <textarea id="desc_en"
                        name="description[en]"
                        class="form-control"
                        rows="5">{!! old('description.en', $homeService->getTranslation('description','en') ?? '') !!}</textarea>
                </div>

                {{-- ================= TYPE ================= --}}
                @php
                $type = old('type')
                ?? (isset($homeService) && $homeService->image ? 'image' : 'icon');
                @endphp

                <div class="col-md-12 mb-3">
                    <label class="form-label d-block mb-2">نوع العرض</label>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                            type="radio"
                            name="type"
                            value="icon"
                            {{ $type === 'icon' ? 'checked' : '' }}>
                        <label class="form-check-label">أيقونة</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                            type="radio"
                            name="type"
                            value="image"
                            {{ $type === 'image' ? 'checked' : '' }}>
                        <label class="form-check-label">صورة</label>
                    </div>
                </div>

                {{-- ================= ICON ================= --}}
                <div class="col-md-6 mb-3" id="iconWrapper">
                    <label>الأيقونة</label>

                    <div class="input-group">
                        <input type="text"
                            name="icon"
                            class="form-control icon-input"
                            placeholder="fa-solid fa-truck"
                            value="{{ old('icon', $homeService->icon ?? '') }}">

                        <button type="button"
                            class="btn btn-outline-secondary"
                            onclick="openIconPicker(this)">
                            اختيار
                        </button>
                    </div>

                    {{-- ICON PREVIEW --}}
                    <div class="icon-preview mt-2">
                        @if(old('icon', $homeService->icon ?? null))
                        <i class="{{ old('icon', $homeService->icon) }} fa-2x text-primary"></i>
                        @endif
                    </div>
                </div>

                {{-- ================= IMAGE ================= --}}
                <div class="col-md-6 mb-3" id="imageWrapper">
                    <label>الصورة</label>
                    <input type="file"
                        name="image"
                        id="imageInput"
                        class="form-control"
                        accept="image/*">

                    {{-- IMAGE PREVIEW --}}
                    <div class="mt-2">
                        <img id="imagePreview"
                            src="{{ isset($homeService) && $homeService->image ? asset('storage/'.$homeService->image) : '' }}"
                            class="img-thumbnail"
                            style="max-height:120px; {{ isset($homeService) && $homeService->image ? '' : 'display:none' }}">
                    </div>
                </div>

            </div>

            <button class="btn btn-primary mt-3">حفظ</button>
        </form>

    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

<script>
    /* ================= CKEDITOR ================= */
    ClassicEditor.create(document.querySelector('#desc_ar'), {
        language: 'ar'
    });
    ClassicEditor.create(document.querySelector('#desc_en'), {
        language: 'en'
    });

    /* ================= TOGGLE TYPE ================= */
    const iconWrapper = document.getElementById('iconWrapper');
    const imageWrapper = document.getElementById('imageWrapper');

    function toggleType(type) {
        iconWrapper.style.display = type === 'icon' ? 'block' : 'none';
        imageWrapper.style.display = type === 'image' ? 'block' : 'none';
    }

    document.querySelectorAll('input[name="type"]').forEach(radio => {
        radio.addEventListener('change', () => toggleType(radio.value));
    });

    toggleType(document.querySelector('input[name="type"]:checked').value);

    /* ================= IMAGE PREVIEW ================= */
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

    /* ================= ICON PICKER ================= */
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