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

     

        {{-- FORM --}}
        <div class="card">
            <div class="card-body">
                @include('dashboard.inc.alerts')
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
                                      class="form-control js-editor"
                                      rows="3">{{ old('subtitle.ar', $hero->getTranslation('subtitle','ar')) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Description (EN)</label>
                            <textarea name="subtitle[en]"
                                      class="form-control js-editor"
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
                         
                            <div class="form-group">
                                <label>الصورة</label>
                                <div class="col-md-6 mb-3 type-field" id="imageField"></div>


                                {{-- hidden input --}}
                                <input type="hidden" name="image"
                                    id="imageInput"
                                    value="{{ $hero->image }}">

                                <button type="button" class="btn btn-outline-primary w-100"
                                    onclick="openMediaLibrary()">
                                    📁 اختيار صورة من المكتبة
                                </button>

                                {{-- IMAGE PREVIEW --}}
                                <div class="mt-2">
                                    <img id="imagePreview"
                                        src="{{ asset('storage/' . $hero->image)}}"
                                        class="img-thumbnail"
                                        style="max-height:120px">
                                </div>


                            </div>
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
