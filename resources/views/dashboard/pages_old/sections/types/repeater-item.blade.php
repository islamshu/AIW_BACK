<div class="border rounded p-3 mb-3 repeater-item">

    <input type="hidden"
        name="sections[{{ $section->id }}][content][items][{{ $index }}][order]"
        value="{{ $item['order'] ?? $index }}">

    <div class="row">
        <div class="col-md-3">
            <label>Icon</label>
            <input type="text"
                class="form-control"
                name="sections[{{ $section->id }}][content][items][{{ $index }}][icon]"
                value="{{ $item['icon'] ?? '' }}">
        </div>

        <div class="col-md-3">
            <label>Title AR</label>
            <input type="text"
                class="form-control"
                name="sections[{{ $section->id }}][content][items][{{ $index }}][title_ar]"
                value="{{ $item['title_ar'] ?? '' }}">
        </div>

        <div class="col-md-3">
            <label>Title EN</label>
            <input type="text"
                class="form-control"
                name="sections[{{ $section->id }}][content][items][{{ $index }}][title_en]"
                value="{{ $item['title_en'] ?? '' }}">
        </div>

        <div class="col-md-3">
            <label>Order</label>
            <input type="number"
                class="form-control"
                value="{{ $item['order'] ?? $index }}">
        </div>

        <div class="col-md-6 mt-2">
            <label>Description AR</label>
            <textarea class="form-control"
                name="sections[{{ $section->id }}][content][items][{{ $index }}][description_ar]">{{ $item['description_ar'] ?? '' }}</textarea>
        </div>

        <div class="col-md-6 mt-2">
            <label>Description EN</label>
            <textarea class="form-control"
                name="sections[{{ $section->id }}][content][items][{{ $index }}][description_en]">{{ $item['description_en'] ?? '' }}</textarea>
        </div>
    </div>
</div>
