<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="mb-3">
            <label class="form-label">Text (English)</label>
            <textarea
                name="content_en"
                class="form-control"
                rows="6"
                placeholder="Write your text here..."
            >{{ $data->content['en'] ?? '' }}</textarea>
        </div>

    </div>
</div>
