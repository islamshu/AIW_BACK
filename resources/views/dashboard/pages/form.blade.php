@extends('layouts.master')
@section('title', $page->exists ? 'تعديل صفحة' : 'إضافة صفحة جديدة')
@section('style')
<style>
    /* =====================================================
   GENERAL
===================================================== */
    body {
        background: #f4f6fb;
    }

    /* =====================================================
   PAGE BUILDER WRAPPER
===================================================== */
    .page-builder {
        background: #f8fafc;
        padding: 24px;
        border-radius: 18px;
    }

    /* =====================================================
   RIGHT SIDEBAR (FULL HEIGHT FLOATING)
===================================================== */

    .right-sidebar {
        position: sticky;
        top: 20px;
        height: calc(100vh - 40px);
        /* المسافة العلوية والسفلية */
        display: flex;
    }

    .right-sidebar-card {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100%;
    }

    .right-sidebar-body {
        flex: 1;
        overflow-y: auto;
        padding-bottom: 20px;
    }

    /* تحسين الـ scrollbar */
    .right-sidebar-body::-webkit-scrollbar {
        width: 6px;
    }

    .right-sidebar-body::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .right-sidebar-body::-webkit-scrollbar-track {
        background: transparent;
    }


    /* =====================================================
   CARDS
===================================================== */
    .card {
        border-radius: 18px;
        border: none;
    }

    .card-header {
        border-radius: 18px 18px 0 0 !important;
        font-weight: 700;
        background: #ffffff;
    }

    .card.shadow-sm {
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
    }

    /* =====================================================
   LAYOUT PRESET (ADD LAYOUT MODAL)
===================================================== */
    .layout-preset {
        border: 2px solid #e2e8f0;
        border-radius: 14px;
        padding: 14px;
        cursor: pointer;
        transition: all .25s ease;
        background: #ffffff;
        height: 100%;
    }

    .layout-preset:hover {
        border-color: #0d6efd;
        transform: translateY(-2px);
    }

    .layout-preset.active {
        border-color: #0d6efd;
        background: linear-gradient(180deg, #f8fbff, #ffffff);
    }

    /* preview grid */
    .preset-preview {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 4px;
        margin-bottom: 10px;
    }

    .preset-preview span {
        height: 12px;
        border-radius: 4px;
        background: #e5e7eb;
    }

    .preset-preview span.fill {
        background: #0d6efd;
    }

    /* =====================================================
   LAYOUT ROW
===================================================== */
    .layout-row {
        border: 2px solid #e2e8f0;
        border-radius: 18px;
        padding: 18px;
        background: linear-gradient(180deg, #ffffff, #f8fafc);
        margin-bottom: 28px;
    }

    .layout-row-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .layout-row-title {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
    }

    /* =====================================================
   COLUMNS
===================================================== */
    .column-box {
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        padding: 14px;
        background: #ffffff;
        min-height: 160px;
        transition: all .25s ease;
    }

    .column-box:hover {
        border-color: #0d6efd;
        background: #f8fbff;
    }

    .column-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .column-title {
        font-size: 14px;
        font-weight: 600;
        color: #334155;
    }

    /* =====================================================
   SECTIONS
===================================================== */
    .section-chip {
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 14px 14px 14px 18px;
        margin-bottom: 14px;
        background: #f9fafb;
        position: relative;
    }

    .section-chip::before {
        content: "";
        position: absolute;
        inset-inline-start: 0;
        top: 14px;
        bottom: 14px;
        width: 4px;
        background: #0d6efd;
        border-radius: 4px;
    }

    .section-chip.deleted {
        opacity: .55;
        border-color: #dc3545;
        background: #fff1f2;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .section-title {
        font-weight: 600;
        font-size: 14px;
    }

    /* =====================================================
   EMPTY STATE
===================================================== */
    .empty-column {
        text-align: center;
        color: #64748b;
        font-size: 13px;
        padding: 24px 0;
    }

    /* =====================================================
   BUTTONS
===================================================== */
    .btn-primary {
        border-radius: 10px;
    }

    .btn-outline-primary,
    .btn-outline-danger,
    .btn-outline-secondary {
        border-radius: 10px;
    }

    /* =====================================================
   STATUS BADGES
===================================================== */
    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-draft {
        background: #fef3c7;
        color: #92400e;
    }

    .status-published {
        background: #d1fae5;
        color: #065f46;
    }

    /* =====================================================
   CKEDITOR
===================================================== */
    .ck-editor__editable {
        min-height: 160px;
        border-radius: 10px !important;
    }

    /* media button inside editor */
    .ck-media-btn {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 6px 12px;
        cursor: pointer;
        transition: all .2s;
    }

    .ck-media-btn:hover {
        background: #e2e8f0;
        border-color: #cbd5e1;
    }

    /* =====================================================
   CKEDITOR ENHANCEMENTS
===================================================== */
    .ck.ck-editor {
        border-radius: 10px !important;
        border: 1px solid #e2e8f0 !important;
    }

    .ck.ck-editor__main>.ck-editor__editable {
        min-height: 200px !important;
        max-height: 500px !important;
        padding: 1rem !important;
        border-radius: 0 0 10px 10px !important;
    }

    .ck.ck-toolbar {
        border-radius: 10px 10px 0 0 !important;
        border-bottom: none !important;
        background: #f8fafc !important;
    }

    /* زر المكتبة الوسائط المحسن */
    .ck-media-library-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        border: none !important;
        border-radius: 6px !important;
        padding: 6px 12px !important;
        font-weight: 600 !important;
        margin: 0 4px !important;
        transition: all 0.3s ease !important;
    }

    .ck-media-library-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4) !important;
    }

    /* تحسين مظهر الصور داخل المحرر */
    .ck.ck-content .image img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 8px !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
    }

    .ck.ck-content .image {
        text-align: center !important;
        margin: 1.5em 0 !important;
    }

    .ck.ck-content .image.image-style-side {
        float: right !important;
        margin-left: 1.5em !important;
        max-width: 50% !important;
    }

    /* أزرار التحكم بالصور */
    .ck-image-insert__panel {
        padding: 1rem !important;
    }

    .ck.ck-button.ck-button_with-text {
        border-radius: 6px !important;
    }

    /* تحسين لوحة الألوان */
    .ck.ck-color-ui-dropdown {
        min-width: 300px !important;
    }

    /* =====================================================
   IMAGE RESIZE ENHANCEMENTS
===================================================== */
    .ck-image-resizer {
        border: 2px solid #4299e1 !important;
        border-radius: 4px !important;
        background: rgba(66, 153, 225, 0.1) !important;
    }

    .ck-image-resizer__handle {
        background: #4299e1 !important;
        border: 2px solid white !important;
        width: 12px !important;
        height: 12px !important;
        border-radius: 50% !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3) !important;
    }

    /* تحسين واجهة إدراج الصور */
    .ck-image-insert__panel {
        max-height: 400px !important;
        overflow-y: auto !important;
    }

    .ck-image-insert__url-row {
        display: flex !important;
        gap: 10px !important;
        margin-bottom: 15px !important;
    }

    /* تخصيص محرر الأبعاد */
    .image-dimension-editor {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 15px;
        margin: 15px 0;
    }

    .dimension-controls {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 15px;
    }

    .dimension-input {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .dimension-input label {
        font-weight: 600;
        color: #334155;
        min-width: 80px;
    }

    .dimension-input input {
        flex: 1;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        padding: 8px 12px;
    }

    .dimension-input .unit {
        color: #64748b;
        font-size: 14px;
        min-width: 40px;
    }

    .aspect-ratio-toggle {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 15px;
        padding: 10px;
        background: #f1f5f9;
        border-radius: 6px;
    }

    .preset-sizes {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 15px;
    }

    .size-preset {
        padding: 8px 15px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        cursor: pointer;
        font-size: 13px;
        transition: all 0.2s;
    }

    .size-preset:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }

    .size-preset.active {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }

    /* معاينة الصورة */
    .image-preview-container {
        position: relative;
        margin: 15px 0;
        background: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
    }

    .image-preview {
        max-width: 100%;
        max-height: 300px;
        margin: 0 auto;
        display: block;
        border-radius: 6px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .preview-info {
        margin-top: 10px;
        font-size: 13px;
        color: #64748b;
    }

    .preview-info span {
        background: #e2e8f0;
        padding: 2px 8px;
        border-radius: 4px;
        margin: 0 5px;
    }

    /* =====================================================
   FLOATING RIGHT PANEL (NO GRID)
===================================================== */

    .page-main-content {
        width: 100%;
        padding-right: 260px;
        /* مساحة للـ panel */
    }

    /* اللوحة العائمة */
    .floating-right-panel {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 240px;
        height: calc(100vh - 40px);
        z-index: 1050;
    }

    /* الكارد */
    .floating-card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    /* المحتوى */
    .floating-body {
        flex: 1;
        overflow-y: auto;
        padding-bottom: 20px;
    }

    /* Scroll جميل */
    .floating-body::-webkit-scrollbar {
        width: 6px;
    }

    .floating-body::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
/* ============================
   MAIN CONTENT
============================ */
.page-content-full {
    width: 100%;
    max-width: 100%;
    padding: 24px;
}

/* ============================
   RIGHT SMALL FLOATING PANEL
============================ */

/* الكارد */
.settings-card {
    background: #ffffff;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
    display: flex;
    flex-direction: column;
    max-height: calc(100vh - 120px);
}

/* الهيدر */
.settings-header {
    padding: 12px 14px;
    font-weight: 700;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* المحتوى */
.settings-body {
    padding: 14px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* Scroll ناعم */
.settings-body::-webkit-scrollbar {
    width: 5px;
}

.settings-body::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

.page-settings-panel {
    position: fixed;
    top: 90px;
    right: 16px;
    width: 220px;
    z-index: 1050;
    cursor: grab;
}

.page-settings-panel.dragging {
    cursor: grabbing;
    opacity: 0.9;
}

    /* =====================================================
   RESPONSIVE
===================================================== */
    @media (max-width: 768px) {
        .page-builder {
            padding: 16px;
        }

        .layout-row {
            padding: 12px;
        }

        .column-box {
            padding: 10px;
        }
    }
</style>
@endsection


@section('content')

{{-- ================= ALERTS ================= --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul class="mb-0">
        @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="container-fluid">

    {{-- MAIN CONTENT (FULL WIDTH) --}}
    <div class="page-main-full">

        {{-- ================= PAGE FORM ================= --}}
        <form id="pageForm"
            method="POST"
            action="{{ $page->exists ? route('dashboard.pages.update',$page) : route('dashboard.pages.store') }}"
            class="mb-4">
            @csrf
            @if($page->exists) @method('PUT') @endif

            <div class="card shadow-sm page-builder">
                <div class="card-header fw-bold bg-white d-flex justify-content-between">
                    <span>بيانات الصفحة</span>
                    @if($page->exists)
                    <span class="badge bg-secondary">{{ $page->status }}</span>
                    @endif
                </div>

                <div class="card-body">
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">العنوان (عربي)</label>
                            <input type="text" name="title_ar" class="form-control"
                                value="{{ old('title_ar',$page->title['ar'] ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Title (English)</label>
                            <input type="text" name="title_en" class="form-control"
                                value="{{ old('title_en',$page->title['en'] ?? '') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Slug</label>
                        <input type="text" name="slug" class="form-control"
                            value="{{ old('slug',$page->slug ?? '') }}">
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>حفظ بيانات الصفحة
                        </button>
                    </div>
                </div>
            </div>
        </form>

        {{-- ================= LAYOUT BUILDER ================= --}}
        @if($page->exists)

        <form id="sectionsForm"
            method="POST"
            action="{{ route('dashboard.pages.sections.batchUpdate',$page) }}">
            @csrf
            @method('PUT')

            <div class="card shadow-sm page-builder">
                <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-layer-group me-2"></i>
                        Layout Builder
                        <small class="text-muted ms-2">({{ count($layouts) }} layout)</small>
                    </span>

                    <button type="button"
                        class="btn btn-sm btn-outline-primary"
                        data-toggle="modal"
                        data-target="#addLayoutModal">
                        <i class="fas fa-plus me-1"></i>
                        إضافة Layout
                    </button>
                </div>

                <div class="card-body">

                    @if(count($layouts))

                    @foreach($layouts as $layoutIndex=>$layout)
                    <div class="layout-row" id="layout-{{ $layout['id'] }}">

                        <div class="layout-row-header">
                            <div class="layout-row-title">
                                🧩 Layout Row #{{ $layoutIndex+1 }}
                                <small class="text-muted">(ID: {{ substr($layout['id'],0,8) }}...)</small>
                            </div>

                            {{-- زر حذف Layout (بدون form داخلي) --}}
                            <button type="submit"
                                class="btn btn-sm btn-outline-danger"
                                form="delete-layout-{{ $layout['id'] }}"
                                onclick="return confirm('هل أنت متأكد من حذف هذا الـ Layout بالكامل؟')">
                                <i class="fas fa-trash me-1"></i>
                                حذف Layout
                            </button>
                        </div>

                        <div class="row g-3 mt-3">

                            @foreach($layout['columns'] as $colIndex=>$column)
                            @php
                            $colWidth = (int)($column['col'] ?? 12);
                            $sections = $column['sections'];
                            @endphp

                            <div class="col-12 col-lg-{{ $colWidth }}">
                                <div class="column-box">

                                    <div class="column-header">
                                        <div class="column-title">
                                            <i class="fas fa-columns me-2"></i>
                                            Column {{ $colIndex+1 }}
                                            <span class="badge bg-primary ms-2">{{ $colWidth }}/12</span>
                                        </div>

                                        <button type="button"
                                            class="btn btn-sm btn-primary js-open-add-section"
                                            data-layout="{{ $layout['id'] }}"
                                            data-col="{{ $colIndex }}">
                                            <i class="fas fa-plus me-1"></i>
                                            إضافة قسم
                                        </button>
                                    </div>

                                    <div class="sections-container">

                                        @forelse($sections as $section)
                                        @php
                                        $meta = $sectionsRegistry[$section->type] ?? [];
                                        $data = is_array($section->data) ? $section->data : [];
                                        @endphp

                                        @if($section->type !== 'empty')
                                        <div class="section-chip js-section-chip">

                                            <input type="hidden" name="sections[{{ $section->id }}][id]" value="{{ $section->id }}">
                                            <input type="hidden" name="sections[{{ $section->id }}][layout_id]" value="{{ $layout['id'] }}">
                                            <input type="hidden" name="sections[{{ $section->id }}][column_index]" value="{{ $colIndex }}">
                                            <input type="hidden" name="sections[{{ $section->id }}][order]" value="{{ $section->order }}">
                                            <input type="hidden" name="sections[{{ $section->id }}][_delete]" class="js-delete-flag" value="0">
                                            <input type="hidden" name="sections[{{ $section->id }}][type]" value="{{ $section->type }}">
                                            <input type="hidden" name="sections[{{ $section->id }}][is_active]" value="0">

                                            <div class="section-header">
                                                <div class="section-title">
                                                    <strong>{{ $meta['icon'] ?? '🧱' }} {{ $meta['label'] ?? $section->type }}</strong>
                                                    @if(!$section->is_active)
                                                    <span class="badge bg-warning ms-2">مخفي</span>
                                                    @endif
                                                </div>

                                                <div class="d-flex gap-2">
                                                    <input type="checkbox"
                                                        name="sections[{{ $section->id }}][is_active]"
                                                        value="1"
                                                        {{ $section->is_active ? 'checked' : '' }}>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger js-mark-delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <hr>

                                            {{-- HERO --}}
                                            @if($section->type==='hero')
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="fw-bold">العنوان عربي</label>
                                                    <input type="text" class="form-control"
                                                        name="sections[{{ $section->id }}][data][title_ar]"
                                                        value="{{ $data['title_ar'] ?? '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Title English</label>
                                                    <input type="text" class="form-control"
                                                        name="sections[{{ $section->id }}][data][title_en]"
                                                        value="{{ $data['title_en'] ?? '' }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="fw-bold">الوصف عربي</label>
                                                    <textarea class="form-control js-editor"
                                                        name="sections[{{ $section->id }}][data][desc_ar]">{{ $data['desc_ar'] ?? '' }}</textarea>
                                                </div>
                                                <div class="col-12">
                                                    <label class="fw-bold">Description English</label>
                                                    <textarea class="form-control js-editor"
                                                        name="sections[{{ $section->id }}][data][desc_en]">{{ $data['desc_en'] ?? '' }}</textarea>
                                                </div>
                                                @include('dashboard.pages.sections.images')





                                            </div>
                                            @endif

                                            {{-- TEXT --}}
                                            @if($section->type==='text')
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label class="fw-bold">النص عربي</label>
                                                    <textarea class="form-control js-editor"
                                                        name="sections[{{ $section->id }}][data][text_ar]">{{ $data['text_ar'] ?? '' }}</textarea>
                                                </div>
                                                <div class="col-12">
                                                    <label class="fw-bold">Text English</label>
                                                    <textarea class="form-control js-editor"
                                                        name="sections[{{ $section->id }}][data][text_en]">{{ $data['text_en'] ?? '' }}</textarea>
                                                </div>
                                                @include('dashboard.pages.sections.images')

                                            </div>
                                            @endif
                                            {{-- REPEATER (WITH ICON PICKER STYLE) --}}
                                            @if($section->type === 'repeater')
                                            @php
                                            $items = $data['items'] ?? [];
                                            @endphp

                                            {{-- ================= SECTION TITLE ================= --}}
                                            <div class="row g-3 mb-4">
                                                <div class="col-md-6">
                                                    <label class="fw-bold">عنوان القسم (AR)</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="sections[{{ $section->id }}][data][title_ar]"
                                                        value="{{ $data['title_ar'] ?? '' }}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="fw-bold">Section Title (EN)</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="sections[{{ $section->id }}][data][title_en]"
                                                        value="{{ $data['title_en'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label class="fw-bold d-block mb-2">طريقة العرض</label>

                                                <select
                                                    class="form-select"
                                                    name="sections[{{ $section->id }}][data][display_mode]">
                                                    <option value="multi"
                                                        {{ ($data['display_mode'] ?? 'multi') === 'multi' ? 'selected' : '' }}>
                                                        كل عنصر داخل كارد مستقل
                                                    </option>

                                                    <option value="single"
                                                        {{ ($data['display_mode'] ?? '') === 'single' ? 'selected' : '' }}>
                                                        جميع العناصر داخل كارد واحد
                                                    </option>
                                                </select>
                                            </div>
                                            {{-- =================================================== --}}

                                            <div class="mb-3">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-primary js-add-repeater-item"
                                                    data-section="{{ $section->id }}">
                                                    <i class="fas fa-plus me-1"></i>
                                                    إضافة عنصر
                                                </button>
                                            </div>

                                            <div class="repeater-items" data-section="{{ $section->id }}">

                                                @foreach($items as $index => $item)
                                                <div class="border rounded p-3 mb-3 repeater-item">

                                                    <input type="hidden"
                                                        name="sections[{{ $section->id }}][data][items][{{ $index }}][order]"
                                                        value="{{ $item['order'] ?? $index }}">

                                                    <div class="row g-3">

                                                        {{-- TITLE --}}
                                                        <div class="col-md-6">
                                                            <label class="fw-bold">العنوان (AR)</label>
                                                            <input type="text"
                                                                class="form-control"
                                                                name="sections[{{ $section->id }}][data][items][{{ $index }}][title_ar]"
                                                                value="{{ $item['title_ar'] ?? '' }}">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="fw-bold">Title (EN)</label>
                                                            <input type="text"
                                                                class="form-control"
                                                                name="sections[{{ $section->id }}][data][items][{{ $index }}][title_en]"
                                                                value="{{ $item['title_en'] ?? '' }}">
                                                        </div>

                                                        {{-- DESCRIPTION --}}
                                                        <div class="col-md-6">
                                                            <label class="fw-bold">الوصف (AR)</label>
                                                            <textarea class="form-control"
                                                                rows="4"
                                                                name="sections[{{ $section->id }}][data][items][{{ $index }}][desc_ar]">{{ $item['desc_ar'] ?? '' }}</textarea>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="fw-bold">Description (EN)</label>
                                                            <textarea class="form-control"
                                                                rows="4"
                                                                name="sections[{{ $section->id }}][data][items][{{ $index }}][desc_en]">{{ $item['desc_en'] ?? '' }}</textarea>
                                                        </div>

                                                        {{-- ICON --}}
                                                        <div class="col-md-6">
                                                            <label class="fw-bold">الأيقونة</label>

                                                            <div class="input-group mb-2">
                                                                <input type="text"
                                                                    class="form-control icon-input"
                                                                    placeholder="fa-solid fa-star"
                                                                    name="sections[{{ $section->id }}][data][items][{{ $index }}][icon]"
                                                                    value="{{ $item['icon'] ?? '' }}">

                                                                <button type="button"
                                                                    class="btn btn-outline-secondary js-open-icon-picker">
                                                                    اختيار
                                                                </button>
                                                            </div>

                                                            {{-- COLOR PICKER --}}
                                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                                <label class="small text-muted mb-0">لون الأيقونة</label>

                                                                <input type="color"
                                                                    class="form-control form-control-color"
                                                                    style="width: 48px; height: 38px;"
                                                                    name="sections[{{ $section->id }}][data][items][{{ $index }}][icon_color]"
                                                                    value="{{ $item['icon_color'] ?? '#00b4d8' }}">
                                                            </div>

                                                            {{-- PREVIEW --}}
                                                            <div class="icon-preview mt-2">
                                                                @if(!empty($item['icon']))
                                                                <i
                                                                    class="{{ $item['icon'] }} fa-2x"
                                                                    style="color: {{ $item['icon_color'] ?? '#00b4d8' }}"></i>
                                                                @endif
                                                            </div>
                                                        </div>


                                                        {{-- DELETE --}}
                                                        <div class="col-md-3 d-flex align-items-end">
                                                            <button type="button"
                                                                class="btn btn-outline-danger w-100 js-remove-repeater-item">
                                                                <i class="fas fa-trash"></i>
                                                                حذف العنصر
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>
                                                @endforeach

                                            </div>
                                            @endif




                                        </div>
                                        @endif
                                        @empty
                                        <div class="empty-column">
                                            <p class="text-muted">لا يوجد أقسام بعد</p>
                                        </div>
                                        @endforelse

                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    @endforeach

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-save me-2"></i>
                            حفظ جميع الأقسام
                        </button>
                    </div>

                    @else
                    <div class="text-center py-5">
                        <h4>لا يوجد Layouts</h4>
                    </div>
                    @endif

                </div>
            </div>
        </form>

        {{-- DELETE LAYOUT FORMS --}}
        @foreach($layouts as $layout)
        <form id="delete-layout-{{ $layout['id'] }}"
            method="POST"
            action="{{ route('dashboard.layouts.destroy',[$page,$layout['id']]) }}"
            class="d-none">
            @csrf
            @method('DELETE')
        </form>
        @endforeach

        @else
        <div class="alert alert-info">
            بعد حفظ بيانات الصفحة يمكنك البدء ببناء الـ Layout.
        </div>
        @endif
    </div>

</div>

{{-- FLOATING RIGHT PANEL --}}
<div class="page-settings-panel">

<div class="settings-card">
        <div class="settings-header drag-handle">
            <i class="fas fa-cog"></i>
            الإعدادات
        </div>
        <div class="settings-body">

            {{-- PAGE STATUS SELECT --}}
            <div class="mb-3">
                <label class="form-label fw-bold">حالة النشر</label>
                <select name="status"
                    form="pageForm"
                    class="form-select {{ $page->status === 'published' ? 'border-success' : ($page->status === 'draft' ? 'border-warning' : '') }}"
                    style="font-weight: 500;">
                    <option value="draft"
                        @selected(old('status', $page->status ?? 'draft')=='draft')
                        class="text-warning">
                        📝 مسودة
                    </option>
                    <option value="published"
                        @selected(old('status', $page->status ?? 'draft')=='published')
                        class="text-success">
                        ✅ منشورة
                    </option>
                </select>

                {{-- Current Status Badge (for display only) --}}
                @if($page->exists)
                <div class="mt-2 text-center">
                    @if($page->status === 'published')
                    <span class="badge bg-success bg-opacity-10  border border-success border-opacity-25 px-3 py-2">
                        <i class="fas fa-check-circle me-1"></i>
                        الصفحة منشورة حالياً
                    </span>
                    @else
                    <span class="badge bg-warning bg-opacity-10  border border-warning border-opacity-25 px-3 py-2">
                        <i class="fas fa-edit me-1"></i>
                        الصفحة مسودة حالياً
                    </span>
                    @endif
                </div>
                @endif
            </div>

            {{-- SAVE PAGE --}}
            <button type="submit"
                form="pageForm"
                class="btn btn-primary w-100 mb-2">
                <i class="fas fa-save me-2"></i>
                حفظ الصفحة
            </button>


            {{-- PREVIEW --}}
            @if($page->exists)
            <a href="{{ route('dashboard.pages.preview', $page) }}"
                target="_blank"
                class="btn btn-outline-dark w-100 mb-2">
                <i class="fas fa-eye me-2"></i>
                معاينة الصفحة
            </a>
            @endif

            {{-- ADD LAYOUT QUICK BUTTON --}}
            @if($page->exists)
            <button type="button"
                        class="btn btn-sm btn-outline-primary"
                        data-toggle="modal"
                        data-target="#addLayoutModal">
                        <i class="fas fa-plus me-1"></i>
                        إضافة Layout
                    </button>
            @endif



        </div>
    </div>



</div>
</div>

</div>
{{-- ================= ADD LAYOUT MODAL ================= --}}
@if($page->exists)
<div class="modal fade" id="addLayoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-plus-circle me-2"></i>إضافة Layout جديد
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p class="text-muted mb-4">اختر تخطيطاً</p>
            
                <div class="row g-3 mb-4">
                    @php
                    $presets = ['12', '6,6', '8,4', '4,8', '4,4,4', '3,3,3,3'];
                    @endphp
            
                    @foreach($presets as $preset)
                    @php
                    $cols = explode(',', $preset);
                    $name = count($cols) > 1 ? implode(' / ', $cols) : 'Full';
                    @endphp
            
                    <div class="col-md-4 col-6">
                        <div class="layout-preset js-layout-preset {{ $loop->first ? 'active' : '' }}"
                            data-cols="{{ $preset }}">
                            <div class="preset-preview mb-2">
                                @php
                                $col_index = 0;
                                $current_col = 0;
                                @endphp
                                
                                @for($i = 0; $i < 12; $i++)
                                    @if($current_col >= $cols[$col_index])
                                        @php
                                        $col_index++;
                                        $current_col = 0;
                                        @endphp
                                    @endif
                                    
                                    <span class="col-group-{{ $col_index }} {{ $i < array_sum($cols) ? 'fill' : 'empty' }}"></span>
                                    
                                    @php $current_col++; @endphp
                                @endfor
                            </div>
                            <div class="fw-bold">{{ $name }}</div>
                            <small class="text-muted">{{ $preset }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            
                <form method="POST"
                    action="{{ route('dashboard.layouts.store', $page) }}"
                    id="addLayoutForm">
                    @csrf
                    <div id="layoutColsHolder"></div>
            
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-check-circle me-2"></i>
                            إنشاء Layout
                        </button>
                    </div>
                </form>
            </div>
            
            <style>
            .preset-preview {
                display: flex;
                flex-wrap: wrap;
                gap: 2px;
                height: 40px;
            }
            
            .preset-preview span {
                flex: 1;
                height: 100%;
                border-radius: 3px;
                transition: all 0.2s;
            }
            
            .preset-preview span.fill {
                opacity: 1;
            }
            
            .preset-preview span.empty {
                opacity: 0.2;
                background-color: #dee2e6 !important;
            }
            
            /* ألوان لمجموعات الأعمدة المختلفة */
            .preset-preview .col-group-0.fill { background-color: #0d6efd; } /* أزرق */
            .preset-preview .col-group-1.fill { background-color: #198754; } /* أخضر */
            .preset-preview .col-group-2.fill { background-color: #fd7e14; } /* برتقالي */
            .preset-preview .col-group-3.fill { background-color: #dc3545; } /* أحمر */
            .preset-preview .col-group-4.fill { background-color: #6f42c1; } /* بنفسجي */
            .preset-preview .col-group-5.fill { background-color: #20c997; } /* تركواز */
            
            /* تأثير عند المرور */
            .layout-preset:hover .preset-preview span.fill {
                opacity: 0.9;
                transform: translateY(-1px);
            }
            
            .layout-preset.active .preset-preview span.fill {
                box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25);
            }
            </style>
        </div>
    </div>
</div>
@endif


{{-- ================= ADD SECTION MODAL ================= --}}
@if($page->exists)
<div class="modal fade" id="addSectionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-plus-square me-2"></i>إضافة قسم جديد
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p class="text-muted mb-4">اختر نوع القسم</p>

                <div class="row g-3">
                    @foreach($sectionsRegistry as $type => $info)
                    @if($type !== 'empty')
                    <div class="col-md-6 col-12">
                        <div class="border rounded p-3 h-100 d-flex flex-column">
                            <div class="mb-2">
                                <span class="fs-4">{{ $info['icon'] ?? '🧱' }}</span>
                                <strong class="ms-2">{{ $info['label'] ?? $type }}</strong>
                            </div>

                            @if(isset($info['description']))
                            <p class="text-muted small flex-grow-1">
                                {{ $info['description'] }}
                            </p>
                            @endif

                            <button type="button"
                                class="btn btn-primary w-100 mt-2 js-add-section"
                                data-type="{{ $type }}">
                                <i class="fas fa-plus me-2"></i>إضافة
                            </button>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                <form method="POST"
                    action="{{ route('dashboard.pages.sections.add', $page) }}"
                    id="addSectionForm" style="display:none;">
                    @csrf
                    <input type="hidden" name="type" id="addSectionType">
                    <input type="hidden" name="layout_id" id="addSectionLayoutId">
                    <input type="hidden" name="column_index" id="addSectionColIndex">
                </form>

            </div>
        </div>
    </div>
</div>
@endif


@endsection
@section('script')

{{-- =====================================================
   GLOBAL STATE (ONE SOURCE OF TRUTH)
===================================================== --}}
<script>
    window.activeTinyEditor = null; // للـ Editor فقط
    window.activeSectionId = null; // للـ Section Image فقط
</script>

{{-- =====================================================
   SAVE ALL (PAGE + SECTIONS)
===================================================== --}}
<script>
    function saveAllChanges() {
        const loader = document.createElement('div');
        loader.className = 'position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex justify-content-center align-items-center';
        loader.style.zIndex = 9999;
        loader.innerHTML = `
        <div class="spinner-border text-primary"></div>
        <div class="ms-3 text-white fw-bold">جارٍ حفظ جميع التغييرات...</div>
    `;
        document.body.appendChild(loader);

        const pageForm = document.getElementById('pageForm');
        const pageFormData = new FormData(pageForm);

        fetch(pageForm.action, {
            method: pageForm.method,
            body: pageFormData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(() => {
            const sectionsForm = document.getElementById('sectionsForm');
            if (sectionsForm) {
                tinymce.editors.forEach(ed => {
                    const textarea = ed.targetElm;
                    if (textarea) textarea.value = ed.getContent();
                });
                sectionsForm.submit();
            }
        }).finally(() => {
            setTimeout(() => loader.remove(), 1000);
        });
    }
</script>

{{-- =====================================================
   LAYOUT PRESETS
===================================================== --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const presets = document.querySelectorAll('.js-layout-preset');
        const holder = document.getElementById('layoutColsHolder');

        presets.forEach(preset => {
            preset.addEventListener('click', function() {
                presets.forEach(p => p.classList.remove('active'));
                this.classList.add('active');

                holder.innerHTML = '';
                this.dataset.cols.split(',').forEach((col, i) => {
                    holder.insertAdjacentHTML('beforeend', `
                    <input type="hidden" name="columns[${i}][col]" value="${col}">
                    <input type="hidden" name="columns[${i}][order]" value="${i}">
                `);
                });
            });
        });

        if (presets.length) presets[0].click();
    });
</script>

{{-- =====================================================
   SECTION + REPEATER + DELETE
===================================================== --}}
<script>
    document.addEventListener('click', function(e) {

        /* إضافة قسم */
        const openAdd = e.target.closest('.js-open-add-section');
        if (openAdd) {
            document.getElementById('addSectionLayoutId').value = openAdd.dataset.layout;
            document.getElementById('addSectionColIndex').value = openAdd.dataset.col;
            new bootstrap.Modal(document.getElementById('addSectionModal')).show();
        }

        const addSection = e.target.closest('.js-add-section');
        if (addSection) {
            document.getElementById('addSectionType').value = addSection.dataset.type;
            document.getElementById('addSectionForm').submit();
        }

        /* حذف قسم */
        const del = e.target.closest('.js-mark-delete');
        if (del) {
            if (!confirm('حذف القسم؟')) return;
            const chip = del.closest('.js-section-chip');
            chip.querySelector('.js-delete-flag').value = 1;
            chip.classList.add('deleted');
            del.disabled = true;
            del.innerHTML = '✔';
        }

        /* Repeater */
        const addRepeater = e.target.closest('.js-add-repeater-item');
        if (addRepeater) {
            const sectionId = addRepeater.dataset.section;
            const container = document.querySelector(`.repeater-items[data-section="${sectionId}"]`);
            const index = container.children.length;

            container.insertAdjacentHTML('beforeend', `
            <div class="border rounded p-3 mb-3 repeater-item">
                <input type="hidden" name="sections[${sectionId}][data][items][${index}][order]" value="${index}">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label>العنوان AR</label>
                        <input type="text" class="form-control" name="sections[${sectionId}][data][items][${index}][title_ar]">
                    </div>
                    <div class="col-md-6">
                        <label>Title EN</label>
                        <input type="text" class="form-control" name="sections[${sectionId}][data][items][${index}][title_en]">
                    </div>
                    <div class="col-md-6">
                        <label>الوصف AR</label>
                        <textarea class="form-control" rows="3" name="sections[${sectionId}][data][items][${index}][desc_ar]"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label>Description EN</label>
                        <textarea class="form-control" rows="3" name="sections[${sectionId}][data][items][${index}][desc_en]"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label>Icon</label>
                        <div class="input-group">
                            <input type="text" class="form-control icon-input" name="sections[${sectionId}][data][items][${index}][icon]">
                            <button type="button" class="btn btn-outline-secondary js-open-icon-picker">اختيار</button>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-2">
        <label class="small text-muted mb-0">لون الأيقونة</label>

        <input type="color"
            class="form-control form-control-color"
            style="width: 48px; height: 38px;"
            name="sections[${sectionId}][data][items][${sectionId}}][icon_color]"
            value="{{ $item['icon_color'] ?? '#00b4d8' }}">
    </div>
                        <div class="icon-preview mt-2"></div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-danger w-100 js-remove-repeater-item">حذف</button>
                    </div>
                </div>
            </div>
        `);
        }

        if (e.target.closest('.js-remove-repeater-item')) {
            e.target.closest('.repeater-item').remove();
        }
    });
</script>

{{-- =====================================================
   ICON PICKER
===================================================== --}}
<script>
    let activeIconInput = null;

    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.js-open-icon-picker');
        if (!btn) return;

        activeIconInput = btn.closest('.repeater-item').querySelector('.icon-input');

        window.open(
            '{{ route("icons.index") }}',
            'IconPicker',
            'width=1000,height=650'
        );
    });

    window.addEventListener('message', function(event) {
        if (event.data?.type !== 'icon-selected') return;
        if (!activeIconInput) return;

        activeIconInput.value = event.data.icon;
        activeIconInput.closest('.repeater-item')
            .querySelector('.icon-preview')
            .innerHTML = `<i class="${event.data.icon} fa-2x text-primary"></i>`;
    });
</script>

{{-- =====================================================
   TINYMCE
===================================================== --}}


{{-- =====================================================
   SECTION MEDIA PICKER
===================================================== --}}
<script>
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.js-open-media');
        if (!btn) return;

        e.preventDefault();
        window.activeSectionId = btn.dataset.sectionId;

        window.open(
            '{{ route("dashboard.media.index") }}?select_mode=section',
            'MediaPicker',
            'width=1200,height=800'
        );
    });

    function removeSectionImage(sectionId) {
        document.getElementById(`section_image_${sectionId}`).value = '';
        document.getElementById(`section_preview_${sectionId}`).style.display = 'none';
        document.getElementById(`section_remove_${sectionId}`).style.display = 'none';
    }
</script>

{{-- =====================================================
   MEDIA MESSAGE RECEIVER (EDITOR + SECTION)
===================================================== --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    const panel = document.querySelector('.page-settings-panel');
    const handle = panel.querySelector('.drag-handle');

    let isDragging = false;
    let startX = 0;
    let startY = 0;
    let panelX = 0;
    let panelY = 0;

    handle.addEventListener('mousedown', function (e) {
        isDragging = true;
        panel.classList.add('dragging');

        startX = e.clientX;
        startY = e.clientY;

        const rect = panel.getBoundingClientRect();
        panelX = rect.left;
        panelY = rect.top;

        document.body.style.userSelect = 'none';
    });

    document.addEventListener('mousemove', function (e) {
        if (!isDragging) return;

        const dx = e.clientX - startX;
        const dy = e.clientY - startY;

        panel.style.left = panelX + dx + 'px';
        panel.style.top  = panelY + dy + 'px';
        panel.style.right = 'auto';
    });

    document.addEventListener('mouseup', function () {
        if (!isDragging) return;

        isDragging = false;
        panel.classList.remove('dragging');
        document.body.style.userSelect = '';
    });

});
</script>


@endsection