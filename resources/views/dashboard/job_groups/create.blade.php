@extends('layouts.master')

@section('title', isset($group) ? 'تعديل عنوان رئيسي' : 'إضافة عنوان رئيسي')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h1 class="h3 mb-1">
            {{ isset($group) ? 'تعديل عنوان رئيسي' : 'إضافة عنوان رئيسي جديد' }}
        </h1>
        <p class="text-muted mb-0">
            {{ isset($group) ? 'تعديل بيانات العنوان الرئيسي' : 'إدخال بيانات العنوان الرئيسي' }}
        </p>
    </div>
    @include('dashboard.inc.alerts')

    <form method="POST"
          action="{{ isset($group)
                    ? route('dashboard.job-groups.update', $group)
                    : route('dashboard.job-groups.store') }}">

        @csrf
        @isset($group) @method('PUT') @endisset

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="row g-4">

                    <div class="col-md-6">
                        <label class="fw-bold">العنوان الرئيسي (AR)</label>
                        <input type="text"
                               name="title[ar]"
                               class="form-control"
                               value="{{ old('title.ar', $group?->getTranslation('title','ar')) }}"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">Main Group Title (EN)</label>
                        <input type="text"
                               name="title[en]"
                               class="form-control"
                               value="{{ old('title.en', $group?->getTranslation('title','en')) }}"
                               required>
                    </div>


                </div>
            </div>

            <div class="card-footer d-flex justify-content-end gap-2 bg-white">
                <a href="{{ route('dashboard.job-groups.index') }}" class="btn btn-light">رجوع</a>
                <button type="submit" class="btn btn-primary">
                    {{ isset($group) ? 'تحديث' : 'حفظ' }}
                </button>
            </div>
        </div>

    </form>

</div>
@endsection

@section('script')
@endsection
