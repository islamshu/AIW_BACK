@extends('layouts.master')
@section('title', isset($slider) ? __('تعديل سلايدر') : __('إضافة سلايدر'))

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <section>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title mb-0">{{ __('معلومات السلايدر') }}</h4>
                        </div>
                        <div class="card-body">
                            @include('dashboard.inc.alerts')

                            <form
                                action="{{ isset($slider) ? route('sliders.update', $slider->id) : route('sliders.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($slider))
                                    @method('PUT')
                                @endif

                                {{-- قسم الصورة --}}
                                <div class="mb-4 p-3 border rounded">
                                    <h5>{{ __('الصورة') }}</h5>
                                    <div class="row">
                                        <div class="col-md-6 mt-2">
                                            <input type="file" name="image" class="form-control image"
                                                accept="image/*">
                                            <div class="mt-2">
                                                <img src="{{ isset($slider) ? asset('storage/' . $slider->image) : '' }}"
                                                    class="img-thumbnail image-preview" style="width: 120px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- قسم العناوين --}}
                                <div class="mb-4 p-3 border rounded">
                                    <h5>{{ __('العناوين') }}</h5>
                                    <div class="row">
                                        <div class="col-md-6 mt-2">
                                            <label>{{ __('العنوان عربي') }}</label>
                                            <input type="text" name="title_ar" class="form-control"
                                                value="{{ old('title_ar', isset($slider) ? $slider->getTranslation('title', 'ar') : '') }}">
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label>{{ __('العنوان عبرية') }}</label>
                                            <input type="text" name="title_he" class="form-control"
                                                value="{{ old('title_he', isset($slider) ? $slider->getTranslation('title', 'he') : '') }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- قسم النصوص --}}
                                <div class="mb-4 p-3 border rounded">
                                    <h5>{{ __('النصوص') }}</h5>
                                    <div class="row">
                                        <div class="col-md-6 mt-2">
                                            <label>{{ __('النص عربي') }}</label>
                                            <textarea id="text_ar" name="text_ar" class="form-control tiny-editor">{{ old('text_ar', isset($slider) ? $slider->getTranslation('text', 'ar') : '') }}</textarea>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label>{{ __('النص عبرية') }}</label>
                                            <textarea id="text_he" name="text_he" class="form-control tiny-editor">{{ old('text_he', isset($slider) ? $slider->getTranslation('text', 'he') : '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                {{-- قسم الإعدادات --}}
                                <div class="mb-4 p-3 border rounded">
                                    <h5>{{ __('إعدادات العرض') }}</h5>
                                    <div class="row">
                                        <div class="col-md-4 mt-2">
                                            <label>{{ __('لون العنوان') }}</label>
                                            <input type="color" name="text_color" class="form-control"
                                                value="{{ old('text_color', $slider->text_color ?? '#000000') }}">
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <label>{{ __('الرابط') }}</label>
                                            <input type="text" name="link" class="form-control"
                                                value="{{ old('link', $slider->link ?? '') }}">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success mt-2">
                                    <i class="la la-save"></i> {{ __('حفظ') }}
                                </button>

                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.querySelectorAll(".image").forEach(input => {
            input.addEventListener("change", function(e) {
                let file = e.target.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        let preview = e.target.closest('.col-md-6').querySelector('.image-preview');
                        if (preview) {
                            preview.src = event.target.result;
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // تهيئة TinyMCE
    </script>
        <script>
        tinymce.init({
            selector: 'textarea.tiny-editor',
            directionality: 'auto',
            language: 'ar',
            height: 400,
            plugins: [
                'advlist autolink lists link image charmap preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount',
                'textcolor', 'colorpicker', 'emoticons'
            ],
            toolbar: 'undo redo | styleselect | fontselect fontsizeselect | ' +
                     'bold italic underline strikethrough | forecolor backcolor | ' +
                     'alignleft aligncenter alignright alignjustify | ' +
                     'bullist numlist outdent indent | link image media table emoticons | ' +
                     'code fullscreen preview',
            menubar: 'file edit view insert format tools table help',
            content_style: 'body { font-family:Arial,sans-serif; font-size:14px }'
        });
    </script>
@endsection
