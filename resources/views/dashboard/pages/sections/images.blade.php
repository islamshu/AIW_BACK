{{-- ================= IMAGE SECTION ================= --}}
<div class="col-12">

    {{-- Title --}}
    <label class="fw-bold mb-2 d-flex align-items-center gap-2">
        <i class="fas fa-image text-primary"></i>
        الصورة الرئيسية
    </label>

    {{-- Image Box --}}
    <div class="section-image-preview text-center">

        {{-- hidden image id --}}
        <input type="hidden"
               name="sections[{{ $section->id }}][data][image_id]"
               id="section_image_{{ $section->id }}"
               value="{{ $data['image_id'] ?? '' }}">

        {{-- image preview --}}
        <img
            id="section_preview_{{ $section->id }}"
            src="{{ !empty($data['image_id']) ? get_image_path($data['image_id']) : '' }}"
            class="img-fluid rounded-4 mb-3"
            style="max-height:220px; {{ empty($data['image_id']) ? 'display:none' : '' }}"
        >

        {{-- buttons --}}
        <div class="d-flex justify-content-center gap-2">

            {{-- select image --}}
            <button type="button"
                    class="btn btn-primary btn-sm px-4 js-open-media"
                    data-section-id="{{ $section->id }}">
                <i class="fas fa-folder-open me-1"></i>
                اختيار صورة
            </button>

            {{-- remove image --}}
            <button type="button"
                    class="btn btn-outline-danger btn-sm px-4"
                    onclick="removeSectionImage({{ $section->id }})"
                    id="section_remove_{{ $section->id }}"
                    style="{{ empty($data['image_id']) ? 'display:none' : '' }}">
                <i class="fas fa-trash"></i>
                حذف
            </button>

        </div>

        <small class="text-muted d-block mt-3">
            يفضّل صورة بجودة عالية (PNG / JPG)
        </small>

    </div>

</div>

{{-- ================= IMAGE SETTINGS ================= --}}
<div class="col-12 mt-4 pt-3 border-top">

    <h6 class="fw-bold mb-3">
        <i class="fas fa-sliders-h me-2"></i>
        إعدادات عرض الصورة
    </h6>

    <div class="row g-3">

        {{-- Position --}}
        <div class="col-md-4">
            <label class="fw-bold">مكان الصورة</label>
            <select class="form-select"
                    name="sections[{{ $section->id }}][data][image_position]">
                <option value="top" {{ ($data['image_position'] ?? '') == 'top' ? 'selected' : '' }}>أعلى المحتوى</option>
                <option value="bottom" {{ ($data['image_position'] ?? '') == 'bottom' ? 'selected' : '' }}>أسفل المحتوى</option>
                <option value="left" {{ ($data['image_position'] ?? '') == 'left' ? 'selected' : '' }}>يسار النص</option>
                <option value="right" {{ ($data['image_position'] ?? '') == 'right' ? 'selected' : '' }}>يمين النص</option>
            </select>
        </div>

        {{-- Size --}}
        <div class="col-md-4">
            <label class="fw-bold">حجم الصورة</label>
            <select class="form-select"
                    name="sections[{{ $section->id }}][data][image_size]">
                <option value="sm" {{ ($data['image_size'] ?? '') == 'sm' ? 'selected' : '' }}>صغير</option>
                <option value="md" {{ ($data['image_size'] ?? 'md') == 'md' ? 'selected' : '' }}>متوسط</option>
                <option value="lg" {{ ($data['image_size'] ?? '') == 'lg' ? 'selected' : '' }}>كبير</option>
                <option value="full" {{ ($data['image_size'] ?? '') == 'full' ? 'selected' : '' }}>بعرض كامل</option>
            </select>
        </div>

        {{-- Shape --}}
        <div class="col-md-4">
            <label class="fw-bold">شكل الصورة</label>
            <select class="form-select"
                    name="sections[{{ $section->id }}][data][image_style]">
                <option value="rounded" {{ ($data['image_style'] ?? 'rounded') == 'rounded' ? 'selected' : '' }}>مستديرة</option>
                <option value="circle" {{ ($data['image_style'] ?? '') == 'circle' ? 'selected' : '' }}>دائرية</option>
                <option value="square" {{ ($data['image_style'] ?? '') == 'square' ? 'selected' : '' }}>مربعة</option>
            </select>
        </div>

        {{-- Shadow --}}
        <div class="col-md-4">
            <label class="fw-bold">ظل الصورة</label>
            <select class="form-select"
                    name="sections[{{ $section->id }}][data][image_shadow]">
                <option value="none">بدون</option>
                <option value="sm" {{ ($data['image_shadow'] ?? '') == 'sm' ? 'selected' : '' }}>خفيف</option>
                <option value="md" {{ ($data['image_shadow'] ?? 'md') == 'md' ? 'selected' : '' }}>متوسط</option>
                <option value="lg" {{ ($data['image_shadow'] ?? '') == 'lg' ? 'selected' : '' }}>قوي</option>
            </select>
        </div>

       

    </div>
</div>
