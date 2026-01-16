<div class="col-12">
    <label class="fw-bold">الصور</label>

    <div class="border rounded p-3 bg-light text-center">

        {{-- image id --}}
        <input type="hidden"
               name="sections[{{ $section->id }}][data][image_id]"
               id="section_image_{{ $section->id }}"
               value="{{ $data['image_id'] ?? '' }}">

        {{-- preview --}}
        <img
            id="section_preview_{{ $section->id }}"
            src="{{ get_image_path(@$data['image_id']) ?? '' }}"
            class="img-fluid rounded mb-2"
            style="max-height:180px; {{ empty($data['image_id']) ? 'display:none' : '' }}"
        >

        <button type="button"
        class="btn btn-outline-primary btn-sm js-open-media"
        data-section-id="{{ $section->id }}">
    اختيار صورة
</button>


        {{-- remove --}}
        <button type="button"
                class="btn btn-outline-danger btn-sm ms-2"
                onclick="removeSectionImage({{ $section->id }})"
                id="section_remove_{{ $section->id }}"
                style="{{ empty($data['image_id']) ? 'display:none' : '' }}">
            حذف
        </button>

    </div>
</div>
