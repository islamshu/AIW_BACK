<div class="card mb-3 section-card" data-id="{{ $section->id }}">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>Repeater Section</strong>

        <div class="d-flex gap-2">
            <button type="button"
                    class="btn btn-sm btn-outline-secondary"
                    data-bs-toggle="collapse"
                    data-bs-target="#section-body-{{ $section->id }}">
                ⌄
            </button>

            <button type="button" class="btn btn-sm btn-outline-dark move-up">↑</button>
            <button type="button" class="btn btn-sm btn-outline-dark move-down">↓</button>
        </div>
    </div>

    <div id="section-body-{{ $section->id }}" class="collapse show">
        <div class="card-body">

            <input type="hidden"
                   name="sections[{{ $section->id }}][order]"
                   value="{{ $section->order }}"
                   class="section-order">

            <div class="repeater-items">
            @foreach($section->content['items'] ?? [] as $index => $item)

                    @include('dashboard.pages.sections.types.repeater-item', [
                        'section' => $section,
                        'index' => $index,
                        'item' => $item
                    ])
                @endforeach
            </div>

            <button type="button"
                    class="btn btn-sm btn-success add-repeater-item"
                    data-section="{{ $section->id }}">
                ➕ إضافة عنصر
            </button>

        </div>
    </div>
</div>
