@extends('layouts.master')

@section('title', isset($job) ? 'تعديل وظيفة' : 'إضافة وظيفة')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h1 class="h3 mb-1">
            {{ isset($job) ? 'تعديل وظيفة' : 'إضافة وظيفة جديدة' }}
        </h1>
        <p class="text-muted mb-0">
            {{ isset($job) ? 'تعديل بيانات الوظيفة' : 'إدخال بيانات الوظيفة' }}
        </p>
    </div>

    <form method="POST"
          action="{{ isset($job)
                    ? route('dashboard.jobs.update', $job)
                    : route('dashboard.jobs.store') }}">

        @csrf
        @isset($job)
            @method('PUT')
        @endisset

        <div class="card shadow-sm">

            <div class="card-body">
                <div class="row g-4">

                    {{-- TITLE --}}
                    <div class="col-md-6">
                        <label class="fw-bold">عنوان الوظيفة (AR)</label>
                        <input type="text"
                               name="title[ar]"
                               class="form-control"
                               value="{{ old('title.ar', $job?->getTranslation('title','ar')) }}"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">Job Title (EN)</label>
                        <input type="text"
                               name="title[en]"
                               class="form-control"
                               value="{{ old('title.en', $job?->getTranslation('title','en')) }}"
                               required>
                    </div>

                    {{-- DATES --}}
                    <div class="col-md-6">
                        <label class="fw-bold">تاريخ النشر من</label>
                        <input type="date"
                        name="publish_from"
                        class="form-control"
                        value="{{ old('publish_from', isset($job) && $job->publish_from ? $job->publish_from->format('Y-m-d') : '') }}"
                        required>

                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">تاريخ النشر إلى</label>
                        <input type="date"
                               name="publish_to"
                               class="form-control"
                               value="{{ old('publish_to', isset($job) && $job->publish_to ? $job->publish_to->format('Y-m-d') : '') }}"
                               required>
                    </div>

                    {{-- REQUIREMENTS --}}
                    <div class="col-md-6">
                        <label class="fw-bold">المؤهلات (AR)</label>
                        <textarea name="requirements[ar]"
                                  class="form-control js-editor"
                                  rows="6">{{ old('requirements.ar', $job?->getTranslation('requirements','ar')) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">Requirements (EN)</label>
                        <textarea name="requirements[en]"
                                  class="form-control js-editor"
                                  rows="6">{{ old('requirements.en', $job?->getTranslation('requirements','en')) }}</textarea>
                    </div>

                  

                </div>
            </div>

            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('dashboard.jobs.index') }}" class="btn btn-light">
                    رجوع
                </a>
                <button type="submit" class="btn btn-primary">
                    {{ isset($job) ? 'تحديث' : 'حفظ' }}
                </button>
            </div>

        </div>
    </form>

</div>
@endsection
@section('script')

@endsection
