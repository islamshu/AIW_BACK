@extends('layouts.master')
@section('title', $page->exists ? 'تعديل صفحة' : 'إضافة صفحة جديدة')
@section('style')
<style>
    /* CSS العام */
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-builder {
        background: #fff;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .page-settings-panel {
        position: fixed;
        top: 100px;
        right: 25px;
        width: 280px;
        z-index: 1000;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        border: 1px solid #e9ecef;
    }

    .settings-card {
        border-radius: 10px;
    }

    .settings-header {
        background: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #e9ecef;
        border-radius: 10px 10px 0 0;
        font-weight: 600;
        color: #495057;
    }

    .settings-body {
        padding: 20px;
    }

    /* Layouts */
    .layout-row {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        position: relative;
    }

    .layout-row-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e9ecef;
    }

    .layout-row-title {
        font-weight: 600;
        color: #495057;
        font-size: 16px;
    }

    /* Columns */
    .column-box {
        border: 2px dashed #adb5bd;
        border-radius: 8px;
        padding: 15px;
        background: #f8f9fa;
        min-height: 200px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .column-box:hover {
        border-color: #007bff;
        background: #f0f8ff;
    }

    .column-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #dee2e6;
    }

    .column-title {
        font-weight: 600;
        color: #495057;
        font-size: 14px;
    }

    /* Sections */
    .section-chip {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        position: relative;
        border-left: 4px solid #007bff;
    }

    .section-chip.deleted {
        opacity: 0.6;
        background: #fff3f3;
        border-color: #dc3545;
        border-left-color: #dc3545;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .section-title {
        font-weight: 600;
        color: #495057;
        font-size: 14px;
    }

    /* Layout Presets Modal */
    .layout-preset {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fff;
        margin-bottom: 15px;
    }

    .layout-preset:hover {
        border-color: #007bff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,123,255,0.1);
    }

    .layout-preset.active {
        border-color: #007bff;
        background: #f0f8ff;
    }

    .preset-preview {
        display: flex;
        gap: 3px;
        margin-bottom: 10px;
        height: 30px;
    }

    .preset-preview span {
        flex: 1;
        border-radius: 4px;
        background: #e9ecef;
    }

    .preset-preview span.fill {
        background: #007bff;
    }

    /* Section Types Modal */
    .section-type-card {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fff;
        margin-bottom: 15px;
        height: 100%;
    }

    .section-type-card:hover {
        border-color: #007bff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,123,255,0.1);
    }

    .section-type-icon {
        font-size: 24px;
        margin-bottom: 10px;
        color: #007bff;
    }

    /* Repeater Items */
    .repeater-item {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        position: relative;
    }

    /* Error Messages */
    .validation-errors {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        max-width: 500px;
    }

    .alert-fixed {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        animation: slideInRight 0.3s ease;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Form Controls */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .invalid-feedback {
        display: block;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }

    /* Empty State */
    .empty-column {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .empty-column i {
        font-size: 48px;
        color: #dee2e6;
        margin-bottom: 15px;
    }

    /* Drag Handle */
    .drag-handle {
        cursor: move;
        user-select: none;
    }

    .drag-handle:hover {
        background: #f8f9fa;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-settings-panel {
            position: relative;
            top: auto;
            right: auto;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .layout-row {
            padding: 15px;
        }
        
        .column-box {
            padding: 10px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- حاوية أخطاء Ajax -->
    <div id="ajax-errors-container" class="validation-errors"></div>
    
    <!-- رسائل Laravel -->
    @if(session('success'))
    <div class="alert alert-success alert-fixed alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert alert-danger alert-fixed alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    
    @if($errors->any())
    <div class="alert alert-danger alert-fixed alert-dismissible fade show" role="alert">
        <h6 class="alert-heading font-weight-bold">يوجد أخطاء في البيانات:</h6>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    
    <!-- المحتوى الرئيسي -->
    <div class="row">
        <!-- المحتوى الأيسر -->
        <div class="col-lg-12 col-md-12">
            <!-- نموذج بيانات الصفحة -->
            <form id="pageForm" method="POST" 
                  action="{{ $page->exists ? route('dashboard.pages.update', $page) : route('dashboard.pages.store') }}"
                  class="page-builder">
                @csrf
                @if($page->exists)
                    @method('PUT')
                @endif
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">
                        <i class="fas fa-file-alt mr-2"></i>
                        {{ $page->exists ? 'تعديل الصفحة' : 'صفحة جديدة' }}
                    </h4>
                    @if($page->exists)
                    <span class="badge badge-{{ $page->status === 'published' ? 'success' : 'secondary' }}">
                        {{ $page->status === 'published' ? 'منشورة' : 'مسودة' }}
                    </span>
                    @endif
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title_ar" class="font-weight-bold">العنوان (عربي) *</label>
                            <input type="text" name="title_ar" id="title_ar" 
                                   class="form-control" 
                                   value="{{ old('title_ar', $page->title['ar'] ?? '') }}"
                                   required>
                            <div class="invalid-feedback" id="title_ar_error"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title_en" class="font-weight-bold">Title (English) *</label>
                            <input type="text" name="title_en" id="title_en" 
                                   class="form-control" 
                                   value="{{ old('title_en', $page->title['en'] ?? '') }}"
                                   required>
                            <div class="invalid-feedback" id="title_en_error"></div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="slug" class="font-weight-bold">الرابط (Slug)</label>
                    <div class="input-group">
                        <input type="text" name="slug" id="slug" 
                               class="form-control" 
                               value="{{ old('slug', $page->slug ?? '') }}"
                               placeholder="سيتم إنشاؤه تلقائياً">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" onclick="generateSlug()">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                    <small class="form-text text-muted">يترك فارغاً لإنشاء رابط تلقائي</small>
                    <div class="invalid-feedback" id="slug_error"></div>
                </div>
                
                <div class="text-right mt-4">
                    <button type="submit" class="btn btn-primary btn-lg" id="savePageBtn">
                        <i class="fas fa-save mr-2"></i>
                        {{ $page->exists ? 'تحديث الصفحة' : 'إنشاء الصفحة' }}
                    </button>
                </div>
            </form>
            
            <!-- Layout Builder -->
            @if($page->exists)
            <form id="sectionsForm" method="POST" 
                  action="{{ route('dashboard.pages.sections.batchUpdate', $page) }}"
                  class="page-builder">
                @csrf
                @method('PUT')
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">
                        <i class="fas fa-layer-group mr-2"></i>
                        Layout Builder
                        <small class="text-muted">({{ count($layouts) }} layouts)</small>
                    </h4>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addLayoutModal">
                        <i class="fas fa-plus mr-1"></i>
                        إضافة Layout
                    </button>
                </div>
                
                @if(count($layouts) > 0)
                    @foreach($layouts as $layoutIndex => $layout)
                    <div class="layout-row" id="layout-{{ $layout['id'] }}">
                        <div class="layout-row-header">
                            <div class="layout-row-title">
                                <i class="fas fa-grip-horizontal mr-2"></i>
                                Layout Row #{{ $layoutIndex + 1 }}
                                <small class="text-muted">({{ substr($layout['id'], 0, 8) }}...)</small>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm delete-layout-btn" 
                                    data-layout-id="{{ $layout['id'] }}">
                                <i class="fas fa-trash mr-1"></i>
                                حذف Layout
                            </button>
                        </div>
                        
                        <div class="row">
                            @foreach($layout['columns'] as $colIndex => $column)
                            @php
                                $colWidth = (int)($column['col'] ?? 12);
                                $sections = $column['sections'];
                            @endphp
                            
                            <div class="col-12 col-lg-{{ $colWidth }}">
                                <div class="column-box">
                                    <div class="column-header">
                                        <div class="column-title">
                                            <i class="fas fa-columns mr-2"></i>
                                            Column {{ $colIndex + 1 }}
                                            <span class="badge badge-primary ml-2">{{ $colWidth }}/12</span>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-sm js-open-add-section" 
                                                data-layout="{{ $layout['id'] }}" 
                                                data-col="{{ $colIndex }}">
                                            <i class="fas fa-plus mr-1"></i>
                                            إضافة قسم
                                        </button>
                                    </div>
                                    
                                    <div class="sections-container">
                                        @if($sections->count() > 0)
                                            @foreach($sections as $section)
                                                @if($section->type !== 'empty')
                                                    @include('dashboard.pages.partials.section-item', [
                                                        'section' => $section,
                                                        'layout' => $layout,
                                                        'colIndex' => $colIndex,
                                                        'sectionsRegistry' => $sectionsRegistry
                                                    ])
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="empty-column">
                                                <i class="fas fa-inbox"></i>
                                                <p class="mt-2">لا يوجد أقسام في هذا العمود</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-success btn-lg" id="saveSectionsBtn">
                            <i class="fas fa-save mr-2"></i>
                            حفظ جميع الأقسام
                        </button>
                    </div>
                @else
                    <div class="empty-column text-center py-5">
                        <i class="fas fa-layer-group fa-3x mb-3"></i>
                        <h5>لا يوجد Layouts</h5>
                        <p class="text-muted">ابدأ بإضافة Layout لبناء صفحتك</p>
                        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addLayoutModal">
                            <i class="fas fa-plus mr-2"></i>
                            إضافة أول Layout
                        </button>
                    </div>
                @endif
            </form>
            @else
            <div class="alert alert-info page-builder">
                <i class="fas fa-info-circle mr-2"></i>
                بعد حفظ بيانات الصفحة يمكنك البدء ببناء الـ Layout.
            </div>
            @endif
        </div>
        
        <!-- اللوحة الجانبية -->
        <div class="col-lg-3 col-md-12">
            <div class="page-settings-panel">
                <div class="settings-card">
                    <div class="settings-header drag-handle">
                        <i class="fas fa-cog mr-2"></i>
                        إعدادات الصفحة
                    </div>
                    <div class="settings-body">
                        <!-- حالة النشر -->
                        <div class="form-group">
                            <label class="font-weight-bold d-block mb-2">حالة النشر</label>
                            <select name="status" form="pageForm" 
                                    class="form-control {{ $page->status === 'published' ? 'border-success' : 'border-warning' }}">
                                <option value="draft" {{ old('status', $page->status ?? 'draft') == 'draft' ? 'selected' : '' }} class="text-warning">
                                    📝 مسودة
                                </option>
                                <option value="published" {{ old('status', $page->status ?? 'draft') == 'published' ? 'selected' : '' }} class="text-success">
                                    ✅ منشورة
                                </option>
                            </select>
                            
                            @if($page->exists)
                            <div class="mt-2 text-center">
                                @if($page->status === 'published')
                                <span class="badge badge-success p-2">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    الصفحة منشورة
                                </span>
                                @else
                                <span class="badge badge-warning p-2">
                                    <i class="fas fa-edit mr-1"></i>
                                    الصفحة مسودة
                                </span>
                                @endif
                            </div>
                            @endif
                        </div>
                        
                        <!-- الأزرار الرئيسية -->
                        <div class="d-grid gap-2">
                            <button type="submit" form="pageForm" class="btn btn-primary btn-block">
                                <i class="fas fa-save mr-2"></i>
                                حفظ الصفحة
                            </button>
                            
                            <button type="button" id="saveAllBtn" class="btn btn-success btn-block">
                                <i class="fas fa-save mr-2"></i>
                                حفظ الكل
                            </button>
                            
                            @if($page->exists)
                            <a href="{{ route('dashboard.pages.preview', $page) }}" 
                               target="_blank" 
                               class="btn btn-outline-dark btn-block">
                                <i class="fas fa-eye mr-2"></i>
                                معاينة الصفحة
                            </a>
                            
                            <button type="button" class="btn btn-outline-primary btn-block" 
                                    data-toggle="modal" data-target="#addLayoutModal">
                                <i class="fas fa-plus mr-2"></i>
                                إضافة Layout
                            </button>
                            @endif
                        </div>
                        
                        <!-- معلومات الصفحة -->
                        @if($page->exists)
                        <hr class="my-3">
                        <div class="page-info">
                            <h6 class="font-weight-bold mb-3">
                                <i class="fas fa-info-circle mr-2"></i>
                                معلومات الصفحة
                            </h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <small class="text-muted d-block">تاريخ الإنشاء</small>
                                    <span>{{ $page->created_at->format('Y/m/d') }}</span>
                                </li>
                                <li class="mb-2">
                                    <small class="text-muted d-block">آخر تحديث</small>
                                    <span>{{ $page->updated_at->format('Y/m/d H:i') }}</span>
                                </li>
                                <li>
                                    <small class="text-muted d-block">عدد الأقسام</small>
                                    <span>{{ $page->sections->count() }}</span>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- مودال إضافة Layout -->
@if($page->exists)
<div class="modal fade" id="addLayoutModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-plus-circle mr-2"></i>
                    إضافة Layout جديد
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-4">اختر تخطيطاً من القائمة أو قم بتخصيص أعمدة يدوياً</p>
                
                <!-- Layout Presets -->
                <div class="row mb-4">
                    @php
                        $presets = [
                            ['cols' => [12], 'name' => 'Full Width', 'icon' => 'fas fa-square'],
                            ['cols' => [6, 6], 'name' => 'نصف ونصف', 'icon' => 'fas fa-columns'],
                            ['cols' => [8, 4], 'name' => '8/4', 'icon' => 'fas fa-th-large'],
                            ['cols' => [4, 8], 'name' => '4/8', 'icon' => 'fas fa-th-large'],
                            ['cols' => [4, 4, 4], 'name' => 'ثلاثة أعمدة', 'icon' => 'fas fa-grip-horizontal'],
                            ['cols' => [3, 3, 3, 3], 'name' => 'أربعة أعمدة', 'icon' => 'fas fa-th'],
                        ];
                    @endphp
                    
                    @foreach($presets as $preset)
                    <div class="col-md-4 mb-3">
                        <div class="layout-preset js-layout-preset" 
                             data-cols="{{ implode(',', $preset['cols']) }}">
                            <div class="preset-preview">
                                @php
                                    $totalCols = 12;
                                    $currentPos = 0;
                                @endphp
                                @foreach($preset['cols'] as $col)
                                    <span class="fill" style="flex: {{ $col }}"></span>
                                    @php $currentPos += $col; @endphp
                                @endforeach
                                @if($currentPos < 12)
                                    @for($i = 0; $i < (12 - $currentPos); $i++)
                                        <span></span>
                                    @endfor
                                @endif
                            </div>
                            <div class="text-center mt-2">
                                <i class="{{ $preset['icon'] }} mr-2"></i>
                                <strong>{{ $preset['name'] }}</strong>
                                <br>
                                <small class="text-muted">{{ implode('/', $preset['cols']) }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Custom Layout Form -->
                <form id="addLayoutForm" method="POST" 
                      action="{{ route('dashboard.pages.layouts.store', $page) }}">
                    @csrf
                    <div id="layoutColsHolder"></div>
                    
                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i>
                            إلغاء
                        </button>
                        <button type="submit" class="btn btn-primary" id="createLayoutBtn">
                            <i class="fas fa-check-circle mr-2"></i>
                            إنشاء Layout
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- مودال إضافة قسم -->
<div class="modal fade" id="addSectionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-plus-square mr-2"></i>
                    إضافة قسم جديد
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-4">اختر نوع القسم الذي تريد إضافته</p>
                
                <!-- Section Types -->
                <div class="row">
                    @foreach($sectionsRegistry as $type => $info)
                        @if($type !== 'empty')
                        <div class="col-md-4 mb-3">
                            <div class="section-type-card js-add-section" 
                                 data-type="{{ $type }}">
                                <div class="section-type-icon">
                                    {!! $info['icon'] ?? '🧱' !!}
                                </div>
                                <h6 class="font-weight-bold mb-2">{{ $info['label'] ?? $type }}</h6>
                                @if(isset($info['description']))
                                <p class="text-muted small mb-0">{{ $info['description'] }}</p>
                                @endif
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                
                <!-- Hidden Form -->
                <form id="addSectionForm" method="POST" 
                      action="{{ route('dashboard.pages.sections.add', $page) }}"
                      style="display: none;">
                    @csrf
                    <input type="hidden" name="type" id="addSectionType">
                    <input type="hidden" name="layout_id" id="addSectionLayoutId">
                    <input type="hidden" name="column_index" id="addSectionColIndex">
                    <button type="submit" id="addSectionSubmitBtn"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>
                    إلغاء
                </button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('script')
<script>
// ================== GLOBAL VARIABLES ==================
let activeLayoutId = '';
let activeColumnIndex = '';

// ================== AJAX FUNCTIONS ==================
/**
 * دالة AJAX عامة
 */
async function ajaxRequest(url, method = 'GET', data = null) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const options = {
        method: method,
        headers: {
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    };

    if (data) {
        if (data instanceof FormData) {
            options.body = data;
        } else {
            options.headers['Content-Type'] = 'application/json';
            options.body = JSON.stringify(data);
        }
    }

    try {
        const response = await fetch(url, options);
        const result = await response.json();
        
        if (!response.ok) {
            // عرض أخطاء التحقق
            if (response.status === 422 && result.errors) {
                showValidationErrors(result.errors);
                throw new Error('يوجد أخطاء في البيانات المدخلة');
            }
            throw new Error(result.message || 'حدث خطأ في الخادم');
        }
        
        return result;
    } catch (error) {
        console.error('Ajax request failed:', error);
        throw error;
    }
}

/**
 * دالة لعرض أخطاء التحقق
 */
function showValidationErrors(errors) {
    // إزالة الأخطاء السابقة
    clearValidationErrors();
    
    // إنشاء حاوية للأخطاء
    const errorContainer = document.getElementById('ajax-errors-container');
    if (!errorContainer) return;
    
    let errorHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    errorHTML += '<h6 class="alert-heading font-weight-bold mb-2"><i class="fas fa-exclamation-triangle mr-2"></i>يوجد أخطاء في البيانات</h6>';
    errorHTML += '<ul class="mb-0">';
    
    for (const field in errors) {
        if (errors.hasOwnProperty(field)) {
            const fieldErrors = Array.isArray(errors[field]) ? errors[field] : [errors[field]];
            
            fieldErrors.forEach(error => {
                errorHTML += `<li>${error}</li>`;
                
                // إضافة class للعنصر الذي به خطأ
                const input = document.querySelector(`[name="${field}"]`);
                if (input) {
                    input.classList.add('is-invalid');
                    
                    // إضافة رسالة الخطأ
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback';
                    errorDiv.textContent = error;
                    input.parentElement.appendChild(errorDiv);
                }
            });
        }
    }
    
    errorHTML += '</ul>';
    errorHTML += '<button type="button" class="close" onclick="clearValidationErrors()">';
    errorHTML += '<span aria-hidden="true">&times;</span>';
    errorHTML += '</button>';
    errorHTML += '</div>';
    
    errorContainer.innerHTML = errorHTML;
}

/**
 * دالة لإزالة أخطاء التحقق
 */
function clearValidationErrors() {
    const errorContainer = document.getElementById('ajax-errors-container');
    if (errorContainer) {
        errorContainer.innerHTML = '';
    }
    
    // إزالة class is-invalid من جميع الحقول
    document.querySelectorAll('.is-invalid').forEach(el => {
        el.classList.remove('is-invalid');
    });
    
    // إزالة رسائل الخطأ
    document.querySelectorAll('.invalid-feedback').forEach(el => {
        el.remove();
    });
}

/**
 * دالة لعرض رسالة نجاح/خطأ
 */
function showAlert(type, message, duration = 5000) {
    clearValidationErrors();
    
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-fixed alert-dismissible fade show`;
    alertDiv.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} mr-2"></i>
        ${message}
        <button type="button" class="close" onclick="this.parentElement.remove()">
            <span aria-hidden="true">&times;</span>
        </button>
    `;
    
    document.body.appendChild(alertDiv);
    
    // إزالة الرسالة بعد المدة المحددة
    setTimeout(() => {
        if (alertDiv.parentElement) {
            alertDiv.remove();
        }
    }, duration);
}

// ================== PAGE FORM ==================
/**
 * معالجة نموذج الصفحة
 */
document.addEventListener('DOMContentLoaded', function() {
    const pageForm = document.getElementById('pageForm');
    if (pageForm) {
        pageForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('savePageBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>جارٍ الحفظ...';
            submitBtn.disabled = true;
            
            try {
                const formData = new FormData(pageForm);
                const result = await ajaxRequest(pageForm.action, pageForm.method, formData);
                
                showAlert('success', result.message);
                
                if (result.redirect) {
                    setTimeout(() => {
                        window.location.href = result.redirect;
                    }, 1500);
                }
            } catch (error) {
                // الأخطاء معروضة بالفعل
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
    }
});

/**
 * توليد رابط تلقائي
 */
function generateSlug() {
    const titleAr = document.getElementById('title_ar').value;
    const titleEn = document.getElementById('title_en').value;
    const slugField = document.getElementById('slug');
    
    if (!slugField.value) {
        const text = titleEn || titleAr || 'page';
        const slug = text.toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/--+/g, '-')
            .trim();
        
        slugField.value = slug;
    }
}

// ================== SECTIONS FORM ==================
/**
 * معالجة نموذج الأقسام
 */
document.addEventListener('DOMContentLoaded', function() {
    const sectionsForm = document.getElementById('sectionsForm');
    if (sectionsForm) {
        sectionsForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('saveSectionsBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>جارٍ الحفظ...';
            submitBtn.disabled = true;
            
            try {
                const formData = new FormData(sectionsForm);
                const result = await ajaxRequest(sectionsForm.action, sectionsForm.method, formData);
                
                showAlert('success', result.message);
                
                if (result.reload) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                }
            } catch (error) {
                // الأخطاء معروضة بالفعل
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
    }
});

// ================== LAYOUT MANAGEMENT ==================
/**
 * Layout Presets
 */
document.addEventListener('DOMContentLoaded', function() {
    const presets = document.querySelectorAll('.js-layout-preset');
    const holder = document.getElementById('layoutColsHolder');
    
    if (presets.length > 0) {
        // التحديد الأول
        const firstPreset = document.querySelector('.js-layout-preset');
        if (firstPreset) {
            firstPreset.classList.add('active');
            updateLayoutColumns(firstPreset.dataset.cols);
        }
        
        // معالجة النقر
        presets.forEach(preset => {
            preset.addEventListener('click', function() {
                presets.forEach(p => p.classList.remove('active'));
                this.classList.add('active');
                updateLayoutColumns(this.dataset.cols);
            });
        });
    }
    
    function updateLayoutColumns(colsString) {
        if (!holder) return;
        
        holder.innerHTML = '';
        colsString.split(',').forEach((col, i) => {
            holder.innerHTML += `
                <input type="hidden" name="columns[${i}][col]" value="${col.trim()}">
                <input type="hidden" name="columns[${i}][order]" value="${i}">
            `;
        });
    }
});

/**
 * إضافة Layout
 */
document.addEventListener('DOMContentLoaded', function() {
    const addLayoutForm = document.getElementById('addLayoutForm');
    if (addLayoutForm) {
        addLayoutForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('createLayoutBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>جارٍ الإنشاء...';
            submitBtn.disabled = true;
            
            try {
                const formData = new FormData(addLayoutForm);
                const result = await ajaxRequest(addLayoutForm.action, 'POST', formData);
                
                showAlert('success', result.message);
                
                if (result.reload) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                    
                    // إغلاق المودال
                    $('#addLayoutModal').modal('hide');
                }
            } catch (error) {
                // الأخطاء معروضة بالفعل
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
    }
});

/**
 * حذف Layout
 */
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-layout-btn').forEach(btn => {
        btn.addEventListener('click', async function() {
            if (!confirm('هل أنت متأكد من حذف هذا الـ Layout بالكامل؟')) return;
            
            const layoutId = this.dataset.layoutId;
            const pageId = {{ $page->id ?? 0 }};
            
            if (!pageId) return;
            
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>جارٍ الحذف...';
            this.disabled = true;
            
            try {
                const url = `/dashboard/pages/${pageId}/layouts/${layoutId}`;
                const result = await ajaxRequest(url, 'DELETE');
                
                showAlert('success', result.message);
                
                if (result.reload) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                }
            } catch (error) {
                this.innerHTML = originalText;
                this.disabled = false;
            }
        });
    });
});

// ================== SECTION MANAGEMENT ==================
/**
 * فتح مودال إضافة قسم
 */
document.addEventListener('click', function(e) {
    const openAddBtn = e.target.closest('.js-open-add-section');
    if (openAddBtn) {
        activeLayoutId = openAddBtn.dataset.layout;
        activeColumnIndex = openAddBtn.dataset.col;
        
        // تحديث القيم المخفية
        document.getElementById('addSectionLayoutId').value = activeLayoutId;
        document.getElementById('addSectionColIndex').value = activeColumnIndex;
        
        // فتح المودال
        $('#addSectionModal').modal('show');
    }
});

/**
 * إضافة قسم
 */
document.addEventListener('click', function(e) {
    const addSectionBtn = e.target.closest('.js-add-section');
    if (addSectionBtn) {
        const type = addSectionBtn.dataset.type;
        
        // إغلاق المودال
        $('#addSectionModal').modal('hide');
        
        // إضافة القسم عبر Ajax
        addSectionViaAjax(type);
    }
});

/**
 * إضافة قسم عبر Ajax
 */
async function addSectionViaAjax(type) {
    const pageId = {{ $page->id ?? 0 }};
    if (!pageId) return;
    
    const url = `{{ route('dashboard.pages.sections.add', $page) }}`;
    
    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('type', type);
    formData.append('layout_id', activeLayoutId);
    formData.append('column_index', activeColumnIndex);
    
    try {
        const result = await ajaxRequest(url, 'POST', formData);
        showAlert('success', result.message);
        
        if (result.reload) {
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        }
    } catch (error) {
        // الأخطاء معروضة بالفعل
    }
}

/**
 * حذف قسم
 */
document.addEventListener('click', function(e) {
    const deleteBtn = e.target.closest('.js-mark-delete');
    if (deleteBtn) {
        if (!confirm('هل أنت متأكد من حذف هذا القسم؟')) return;
        
        const sectionChip = deleteBtn.closest('.js-section-chip');
        if (sectionChip) {
            const deleteFlag = sectionChip.querySelector('.js-delete-flag');
            if (deleteFlag) {
                deleteFlag.value = '1';
                sectionChip.classList.add('deleted');
                deleteBtn.disabled = true;
                deleteBtn.innerHTML = '<i class="fas fa-check"></i>';
            }
        }
    }
});

/**
 * Repeater Items
 */
document.addEventListener('click', function(e) {
    // إضافة عنصر repeater
    const addRepeaterBtn = e.target.closest('.js-add-repeater-item');
    if (addRepeaterBtn) {
        const sectionId = addRepeaterBtn.dataset.section;
        const container = document.querySelector(`.repeater-items[data-section="${sectionId}"]`);
        
        if (container) {
            const index = container.children.length;
            
            const newItem = document.createElement('div');
            newItem.className = 'repeater-item border rounded p-3 mb-3';
            newItem.innerHTML = `
                <input type="hidden" name="sections[${sectionId}][data][items][${index}][order]" value="${index}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>العنوان (عربي)</label>
                            <input type="text" class="form-control" 
                                   name="sections[${sectionId}][data][items][${index}][title_ar]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title (English)</label>
                            <input type="text" class="form-control" 
                                   name="sections[${sectionId}][data][items][${index}][title_en]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>الوصف (عربي)</label>
                            <textarea class="form-control" rows="3" 
                                      name="sections[${sectionId}][data][items][${index}][desc_ar]"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Description (English)</label>
                            <textarea class="form-control" rows="3" 
                                      name="sections[${sectionId}][data][items][${index}][desc_en]"></textarea>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-danger btn-block js-remove-repeater-item">
                            <i class="fas fa-trash mr-1"></i>حذف العنصر
                        </button>
                    </div>
                </div>
            `;
            
            container.appendChild(newItem);
        }
    }
    
    // حذف عنصر repeater
    const removeRepeaterBtn = e.target.closest('.js-remove-repeater-item');
    if (removeRepeaterBtn) {
        if (confirm('هل تريد حذف هذا العنصر؟')) {
            removeRepeaterBtn.closest('.repeater-item').remove();
        }
    }
});

// ================== SAVE ALL ==================
/**
 * حفظ الكل
 */
document.getElementById('saveAllBtn')?.addEventListener('click', async function() {
    if (confirm('هل تريد حفظ جميع التغييرات؟')) {
        const originalText = this.innerHTML;
        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>جارٍ حفظ الكل...';
        this.disabled = true;
        
        try {
            // حفظ الصفحة أولاً
            const pageForm = document.getElementById('pageForm');
            if (pageForm) {
                const pageFormData = new FormData(pageForm);
                await ajaxRequest(pageForm.action, pageForm.method, pageFormData);
            }
            
            // حفظ الأقسام
            const sectionsForm = document.getElementById('sectionsForm');
            if (sectionsForm) {
                const sectionsFormData = new FormData(sectionsForm);
                const result = await ajaxRequest(sectionsForm.action, sectionsForm.method, sectionsFormData);
                
                showAlert('success', 'تم حفظ جميع التغييرات بنجاح');
                
                if (result.reload) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                }
            }
        } catch (error) {
            // الأخطاء معروضة بالفعل
        } finally {
            this.innerHTML = originalText;
            this.disabled = false;
        }
    }
});

// ================== DRAGGABLE PANEL ==================
/**
 * جعل اللوحة قابلة للسحب
 */
document.addEventListener('DOMContentLoaded', function() {
    const panel = document.querySelector('.page-settings-panel');
    const handle = panel?.querySelector('.drag-handle');
    
    if (!panel || !handle) return;
    
    let isDragging = false;
    let startX, startY, panelX, panelY;
    
    handle.addEventListener('mousedown', function(e) {
        isDragging = true;
        panel.classList.add('dragging');
        
        startX = e.clientX;
        startY = e.clientY;
        
        const rect = panel.getBoundingClientRect();
        panelX = rect.left;
        panelY = rect.top;
        
        document.body.style.userSelect = 'none';
    });
    
    document.addEventListener('mousemove', function(e) {
        if (!isDragging) return;
        
        const dx = e.clientX - startX;
        const dy = e.clientY - startY;
        
        panel.style.left = (panelX + dx) + 'px';
        panel.style.top = (panelY + dy) + 'px';
        panel.style.right = 'auto';
    });
    
    document.addEventListener('mouseup', function() {
        if (!isDragging) return;
        
        isDragging = false;
        panel.classList.remove('dragging');
        document.body.style.userSelect = '';
    });
});

// ================== INITIALIZATION ==================
/**
 * تهيئة المكونات عند تحميل الصفحة
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page Builder initialized with Bootstrap 4');
    
    // إخفاء رسائل التنبيه بعد 5 ثواني
    setTimeout(() => {
        document.querySelectorAll('.alert-fixed').forEach(alert => {
            alert.remove();
        });
    }, 5000);
});
</script>
@endsection