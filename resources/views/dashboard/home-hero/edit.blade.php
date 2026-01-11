@extends('layouts.master')

@section('title', 'قسم الهيرو')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">

        {{-- HEADER --}}
        <div class="content-header row mb-2">
            <div class="col-12">
                <h3 class="content-header-title">تعديل قسم الهيرو</h3>
            </div>
        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM --}}
        <div class="card">
            <div class="card-body">
                <form method="POST"
                      action="{{ route('home-hero.update') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- TITLE --}}
                        <div class="col-md-6 mb-2">
                            <label>العنوان (AR)</label>
                            <input type="text"
                                   name="title[ar]"
                                   class="form-control"
                                   value="{{ old('title.ar', $hero->getTranslation('title','ar')) }}">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Title (EN)</label>
                            <input type="text"
                                   name="title[en]"
                                   class="form-control"
                                   value="{{ old('title.en', $hero->getTranslation('title','en')) }}">
                        </div>

                        {{-- SUBTITLE --}}
                        <div class="col-md-6 mb-2">
                            <label>الوصف (AR)</label>
                            <textarea name="subtitle[ar]"
                                      class="ckeditor"
                                      rows="3">{{ old('subtitle.ar', $hero->getTranslation('subtitle','ar')) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Description (EN)</label>
                            <textarea name="subtitle[en]"
                                      class="ckeditor"
                                      rows="3">{{ old('subtitle.en', $hero->getTranslation('subtitle','en')) }}</textarea>
                        </div>

                        {{-- BUTTON TEXT --}}
                        <div class="col-md-6 mb-2">
                            <label>زر (AR)</label>
                            <input type="text"
                                   name="button_text[ar]"
                                   class="form-control"
                                   value="{{ old('button_text.ar', $hero->getTranslation('button_text','ar')) }}">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Button (EN)</label>
                            <input type="text"
                                   name="button_text[en]"
                                   class="form-control"
                                   value="{{ old('button_text.en', $hero->getTranslation('button_text','en')) }}">
                        </div>

                        {{-- LINK --}}
                        <div class="col-md-12 mb-2">
                            <label>رابط الزر</label>
                            <input type="text"
                                   name="button_link"
                                   class="form-control"
                                   value="{{ old('button_link', $hero->button_link) }}">
                        </div>

                        {{-- IMAGE --}}
                        <div class="col-md-12 mb-3">
                            <label>الصورة</label>
                            <input type="file" name="image" class="form-control">

                            @if($hero->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/'.$hero->image) }}"
                                         style="max-height: 160px"
                                         class="img-thumbnail">
                                </div>
                            @endif
                        </div>

                    </div>

                    <button class="btn btn-primary">
                        حفظ التعديلات
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
