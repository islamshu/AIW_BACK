@extends('layouts.master')

@section('title', isset($job) ? 'تعديل وظيفة' : 'إضافة وظيفة')

@section('content')
<div class="container-fluid job-form-page">

    {{-- HEADER --}}
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1">
            {{ isset($job) ? 'تعديل وظيفة' : 'إضافة وظيفة جديدة' }}
        </h1>
        <p class="text-muted mb-0">
            {{ isset($job) ? 'تعديل بيانات الوظيفة وربطها بالعنوان الرئيسي' : 'إدخال بيانات الوظيفة وربطها بالعنوان الرئيسي' }}
        </p>
    </div>

    <form method="POST"
          action="{{ isset($job)
                    ? route('dashboard.jobs.update', $job)
                    : route('dashboard.jobs.store') }}">

        @csrf
        @isset($job) @method('PUT') @endisset

        {{-- ================= MAIN CARD ================= --}}
        <div class="card shadow-sm border-0">

            <div class="card-body p-4">

                {{-- ================= GROUP SECTION ================= --}}
                <div class="col-md-12">
                    <label class="form-label fw-semibold mb-2">
                        العنوان الرئيسي (Main Group)
                    </label>
                
                    <div class="custom-select-wrapper">
                        <select name="job_group_id"
                                class="form-select custom-select"
                                required>
                            <option value="" disabled
                                {{ old('job_group_id', $job->job_group_id ?? '') ? '' : 'selected' }}>
                                اختر العنوان الرئيسي...
                            </option>
                
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}"
                                    {{ (string) old('job_group_id', $job->job_group_id ?? '') === (string) $group->id ? 'selected' : '' }}>
                                    {{ $group->getTranslation('title','ar') }}
                                    — {{ $group->getTranslation('title','en') }}
                                </option>
                            @endforeach
                        </select>
                
                        <i class="fas fa-chevron-down select-icon"></i>
                    </div>
                </div>
                

                {{-- ================= TITLE SECTION ================= --}}
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-briefcase text-primary"></i>
                        <span>عنوان الوظيفة</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">عنوان الوظيفة (AR)</label>
                            <input type="text"
                                   name="title[ar]"
                                   class="form-control form-control-lg"
                                   placeholder="مثال: مطور Laravel"
                                   value="{{ old('title.ar', $job?->getTranslation('title','ar')) }}"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Job Title (EN)</label>
                            <input type="text"
                                   name="title[en]"
                                   class="form-control form-control-lg"
                                   placeholder="Laravel Developer"
                                   value="{{ old('title.en', $job?->getTranslation('title','en')) }}"
                                   required>
                        </div>
                    </div>
                </div>

                {{-- ================= DATES SECTION ================= --}}
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-calendar-alt text-primary"></i>
                        <span>فترة النشر</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">تاريخ النشر من</label>
                            <input type="date"
                                   name="publish_from"
                                   class="form-control form-control-lg"
                                   value="{{ old('publish_from', isset($job) && $job->publish_from ? $job->publish_from->format('Y-m-d') : '') }}"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">تاريخ النشر إلى</label>
                            <input type="date"
                                   name="publish_to"
                                   class="form-control form-control-lg"
                                   value="{{ old('publish_to', isset($job) && $job->publish_to ? $job->publish_to->format('Y-m-d') : '') }}">
                        </div>
                    </div>
                </div>

                {{-- ================= REQUIREMENTS SECTION ================= --}}
                <div class="form-section">
                    <div class="section-header">
                        <i class="fas fa-list-check text-primary"></i>
                        <span>المؤهلات والمتطلبات</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">المؤهلات (AR)</label>
                            <textarea name="requirements[ar]"
                                      class="form-control js-editor"
                                      rows="6">{{ old('requirements.ar', $job?->getTranslation('requirements','ar')) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Requirements (EN)</label>
                            <textarea name="requirements[en]"
                                      class="form-control js-editor"
                                      rows="6">{{ old('requirements.en', $job?->getTranslation('requirements','en')) }}</textarea>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ================= FOOTER ================= --}}
            <div class="card-footer bg-white d-flex justify-content-end gap-2 p-3">
                <a href="{{ route('dashboard.jobs.index') }}"
                   class="btn btn-light px-4">
                    رجوع
                </a>

                <button type="submit"
                        class="btn btn-primary px-4">
                    {{ isset($job) ? 'تحديث الوظيفة' : 'حفظ الوظيفة' }}
                </button>
            </div>

        </div>
    </form>

</div>
@endsection
@section('style')
    <style>
        .job-form-page .form-section {
    background: #f8fafc;
    border-radius: 14px;
    padding: 20px;
    margin-bottom: 24px;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 700;
    margin-bottom: 16px;
    color: #0f172a;
}

.section-header i {
    font-size: 16px;
}

.form-hint {
    font-size: 13px;
    color: #64748b;
    margin-top: 6px;
}

.form-hint a {
    color: #2563eb;
    text-decoration: none;
}

.form-hint a:hover {
    text-decoration: underline;
}

.form-control-lg,
.form-select-lg {
    border-radius: 10px;
}
.custom-select-wrapper {
    position: relative;
}

.custom-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background: linear-gradient(180deg, #ffffff, #f8fafc);
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 14px 48px 14px 16px;
    font-size: 15px;
    font-weight: 500;
    transition: all .25s ease;
    height: 50px;
}

.custom-select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,.15);
    background: #fff;
}

.select-icon {
    position: absolute;
    top: 50%;
    right: 18px;
    transform: translateY(-50%);
    pointer-events: none;
    color: #64748b;
    font-size: 14px;
}


    </style>
@endsection
