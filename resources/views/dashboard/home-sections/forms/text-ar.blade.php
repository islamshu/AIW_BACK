<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="mb-3">
            <label class="form-label">النص (عربي)</label>
            <textarea
                name="content_ar"
                class="form-control"
                rows="6"
                placeholder="اكتب النص هنا..."
            >{{ $data->content['ar'] ?? '' }}</textarea>
        </div>

    </div>
</div>
