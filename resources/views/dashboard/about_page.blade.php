@extends('layouts.master')
@section('title', __('صفحة من نحن'))

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{ __('صفحة من نحن') }}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('الرئيسية') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('صفحة من نحن') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <section id="about-page">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('إدارة محتوى صفحة من نحن') }}</h4>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form action="{{ route('add_general') }}" method="post">
                                            @csrf

                                            <!-- العربية -->
                                            <div class="form-group">
                                                <label for="about_ar">{{ __('الوصف بالعربية') }}</label>
                                                <textarea name="general[about_ar]" class="form-control tiny-editor" rows="6">{{ get_general_value('about_ar') }}</textarea>

                                            </div>

                                            <!-- العبرية -->
                                            <div class="form-group">
                                                <label for="about_he">{{ __('الوصف بالعبرية') }}</label>
                                                <textarea name="general[about_he]" class="form-control tiny-editor" rows="6" dir="rtl" style="text-align:right">{{ get_general_value('about_he') }}</textarea>

                                            </div>

                                            <!-- زر الحفظ -->
                                            <div class="form-actions text-center mt-3">
                                                <button type="submit" class="btn btn-primary btn-lg">
                                                    <i class="la la-check-square-o"></i> {{ __('حفظ التغييرات') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
            font_family_formats:
                'Axiforma=Axiforma,sans-serif;' +
                'Atyp Display TRIAL=AtypDisplayTRIAL,sans-serif;' +
                'Al Jazeera Arabic=Al Jazeera Arabic,sans-serif;' +
                'Cairo=Cairo,sans-serif;' +
                'Tajawal=Tajawal,sans-serif;' +
                'Amiri=Amiri,serif;' +
                'El Messiri=El Messiri,sans-serif;' +
                'Almarai=Almarai,sans-serif;' +
                'Reem Kufi=Reem Kufi,sans-serif;' +
                'Mada=Mada,sans-serif;' +
                'Changa=Changa,sans-serif;' +
                'Arial=arial,helvetica,sans-serif;',
            content_style: `
                @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Tajawal:wght@400;700&family=Amiri:ital,wght@0,400;0,700;1,400&family=El+Messiri:wght@400;700&family=Almarai:wght@400;700&family=Reem+Kufi:wght@400;700&family=Mada:wght@400;700&family=Changa:wght@400;700&display=swap');

                @font-face {
                    font-family: 'AtypDisplayTRIAL';
                    src: url('{{ asset('backend/fonts/custom/AtypDisplayTRIAL/AtypDisplayTRIAL-Light-BF65727125c722b.otf') }}') format('opentype');
                    font-weight: 300;
                    font-style: normal;
                }
                @font-face {
                    font-family: 'AtypDisplayTRIAL';
                    src: url('{{ asset('backend/fonts/custom/AtypDisplayTRIAL/AtypDisplayTRIAL-Regular-BF65727125d566e.otf') }}') format('opentype');
                    font-weight: 400;
                    font-style: normal;
                }
                @font-face {
                    font-family: 'AtypDisplayTRIAL';
                    src: url('{{ asset('backend/fonts/custom/AtypDisplayTRIAL/AtypDisplayTRIAL-Medium-BF65727125b8683.otf') }}') format('opentype');
                    font-weight: 500;
                    font-style: normal;
                }
                @font-face {
                    font-family: 'AtypDisplayTRIAL';
                    src: url('{{ asset('backend/fonts/custom/AtypDisplayTRIAL/AtypDisplayTRIAL-Semibold-BF65727125c6fc9.otf') }}') format('opentype');
                    font-weight: 600;
                    font-style: normal;
                }

                @font-face {
                    font-family: 'Al Jazeera Arabic';
                    src: url('{{ asset('backend/fonts/custom/aljazera/Al-Jazeera-Arabic-Regular.ttf') }}') format('truetype');
                    font-weight: 400;
                    font-style: normal;
                }

                @font-face {
                    font-family: 'Axiforma';
                    src: url('{{ asset('backend/fonts/custom/axiforma/AXIFORMA-THIN.TTF') }}') format('truetype');
                    font-weight: 100;
                    font-style: normal;
                }
                @font-face {
                    font-family: 'Axiforma';
                    src: url('{{ asset('backend/fonts/custom/axiforma/AXIFORMA-THINITALIC.TTF') }}') format('truetype');
                    font-weight: 100;
                    font-style: italic;
                }
                @font-face {
                    font-family: 'Axiforma';
                    src: url('{{ asset('backend/fonts/custom/axiforma/AXIFORMA-REGULAR.TTF') }}') format('truetype');
                    font-weight: 400;
                    font-style: normal;
                }
                @font-face {
                    font-family: 'Axiforma';
                    src: url('{{ asset('backend/fonts/custom/axiforma/AXIFORMA-ITALIC.TTF') }}') format('truetype');
                    font-weight: 400;
                    font-style: italic;
                }

                body {
                    font-family: Cairo, sans-serif;
                    font-size: 14px;
                }
            `
        });
    </script>
@endsection



