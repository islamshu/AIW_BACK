@extends('layouts.master')

@section('title', 'تعديل وظيفة')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h1 class="h3 mb-1">تعديل وظيفة</h1>
        <p class="text-muted mb-0">تحديث بيانات الوظيفة</p>
    </div>

    <form method="POST"
          action="{{ route('dashboard.jobs.update',$job) }}">
        @csrf
        @method('PUT')

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-4">

                    {{-- Title --}}
                    <div class="col-md-6">
                        <label class="fw-bold">عنوان الوظيفة (AR)</label>
                        <input type="text"
                               name="title[ar]"
                               value="{{ $job->getTranslation('title','ar') }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">Job Title (EN)</label>
                        <input type="text"
                               name="title[en]"
                               value="{{ $job->getTranslation('title','en') }}"
                               class="form-control"
                               required>
                    </div>

                    {{-- Dates --}}
                    <div class="col-md-6">
                        <label class="fw-bold">تاريخ النشر من</label>
                        <input type="date"
                               name="publish_from"
                               value="{{ $job->publish_from->format('Y-m-d') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">تاريخ النشر إلى</label>
                        <input type="date"
                               name="publish_to"
                               value="{{ optional($job->publish_to)->format('Y-m-d') }}"
                               class="form-control">
                    </div>

                    {{-- Requirements --}}
                    <div class="col-md-6">
                        <label class="fw-bold">المؤهلات (AR)</label>
                        <textarea name="requirements[ar]"
                                  class="form-control js-editor">
{{ $job->getTranslation('requirements','ar') }}
</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">Requirements (EN)</label>
                        <textarea name="requirements[en]"
                                  class="form-control js-editor">
{{ $job->getTranslation('requirements','en') }}
</textarea>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-12">
                        <label class="fw-bold">الحالة</label>
                        <select name="is_active" class="form-select">
                            <option value="1" @selected($job->is_active)>مفعّلة</option>
                            <option value="0" @selected(!$job->is_active)>موقوفة</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('dashboard.jobs.index') }}"
                   class="btn btn-light">رجوع</a>
                <button class="btn btn-primary">تحديث</button>
            </div>
        </div>
    </form>

</div>
@endsection
