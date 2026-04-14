@extends('layouts.master')
@section('title', __('اعدادات الموقع'))

@section('content')
<div class="app-content content">
    <div class="content-wrapper">

        {{-- HEADER --}}
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('إعدادات الموقع') }}</h3>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">{{ __('الرئيسية') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('إعدادات الموقع') }}</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="content-body">
            <section id="settings">

                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('إعدادات الموقع') }}</h4>
                            </div>

                            <div class="card-content collapse show">
                                <div class="card-body">

                                    <form action="{{ route('add_general') }}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @csrf

                                        {{-- ================================================= --}}
                                        {{-- الإعدادات العامة --}}
                                        {{-- ================================================= --}}
                                        <div class="form-section mb-5">
                                            <h5 class="section-title mb-3">
                                                <i class="ft-settings"></i>
                                                {{ __('الإعدادات العامة') }}
                                            </h5>

                                            <div class="row">

                                                {{-- LOGO --}}
                                                <div class="col-md-6">
                                                    <label>{{ __('شعار الموقع') }}</label>

                                                    <input type="hidden"
                                                           name="general[website_logo]"
                                                           id="imageInput"
                                                           value="{{ get_general_value('website_logo') }}">

                                                    <button type="button"
                                                            class="btn btn-outline-primary w-100"
                                                            onclick="openMediaLibrary()">
                                                        📁 {{ __('اختيار صورة من المكتبة') }}
                                                    </button>

                                                    <div class="mt-2">
                                                        <img id="imagePreview"
                                                             src="{{ asset(get_general_value('website_logo')) }}"
                                                             class="img-thumbnail"
                                                             style="max-height:120px">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <label>{{ __('البريد الإلكتروني') }}</label>
                                                    <input type="email"
                                                           class="form-control"
                                                           name="general[website_email]"
                                                           value="{{ get_general_value('website_email') }}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label>{{ __('هاتف الموقع') }}</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="general[phone]"
                                                           value="{{ get_general_value('phone') }}">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ================================================= --}}
                                        {{-- نظام الألوان (في وسط الصفحة) --}}
                                        {{-- ================================================= --}}
                                        <div class="form-section mb-5">
                                            <h5 class="section-title text-center mb-4">
                                                <i class="ft-droplet"></i>
                                                {{ __('نظام ألوان الموقع') }}
                                            </h5>

                                            <div class="row justify-content-center">
                                                <div class="col-md-10">

                                                    <div class="card border shadow-sm">
                                                        <div class="card-body">

                                                            <div class="row text-center">

                                                                <div class="col-md-3">
                                                                    <label class="font-weight-bold mb-2 d-block">
                                                                        {{ __('اللون الرئيسي') }}
                                                                    </label>
                                                                    <input type="color"
                                                                           class="form-control"
                                                                           name="general[prime_color]"
                                                                           value="{{ get_general_value('prime_color') ?? '#00b4d8' }}">
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label class="font-weight-bold mb-2 d-block">
                                                                        {{ __('اللون الثانوي') }}
                                                                    </label>
                                                                    <input type="color"
                                                                           class="form-control"
                                                                           name="general[second_color]"
                                                                           value="{{ get_general_value('second_color') ?? '#ff5d8f' }}">
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label class="font-weight-bold mb-2 d-block">
                                                                        {{ __('لون الخلفية') }}
                                                                    </label>
                                                                    <input type="color"
                                                                           class="form-control"
                                                                           name="general[bg_color]"
                                                                           value="{{ get_general_value('bg_color') ?? '#0a192f' }}">
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label class="font-weight-bold mb-2 d-block">
                                                                        {{ __('لون النص') }}
                                                                    </label>
                                                                    <input type="color"
                                                                           class="form-control"
                                                                           name="general[text_color]"
                                                                           value="{{ get_general_value('text_color') ?? '#ffffff' }}">
                                                                </div>

                                                            </div>

                                                            {{-- PREVIEW --}}
                                                            <div class="mt-4 p-4 rounded text-center"
                                                                 style="
                                                                    background: {{ get_general_value('bg_color') ?? '#0a192f' }};
                                                                    color: {{ get_general_value('text_color') ?? '#ffffff' }};
                                                                    border: 1px solid {{ get_general_value('prime_color') ?? '#00b4d8' }};
                                                                 ">
                                                                <h4 style="
                                                                    background: linear-gradient(
                                                                        135deg,
                                                                        {{ get_general_value('prime_color') ?? '#00b4d8' }},
                                                                        {{ get_general_value('second_color') ?? '#ff5d8f' }}
                                                                    );
                                                                    -webkit-background-clip: text;
                                                                    color: transparent;
                                                                ">
                                                                    {{ __('معاينة الألوان') }}
                                                                </h4>

                                                                <p class="mb-0">
                                                                    {{ __('هذا مثال مباشر على ألوان الموقع') }}
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        {{-- ================================================= --}}
                                        {{-- CSS مخصص --}}
                                        {{-- ================================================= --}}
                                        <div class="form-section mb-5">
                                            <h5 class="section-title mb-3">
                                                <i class="ft-layout"></i>
                                                {{ __('CSS مخصص') }}
                                            </h5>
                                            <div class="alert alert-info">
                                                <i class="ft-info"></i>
                                                {{ __('يتم تطبيق هذا الكود في جميع صفحات الموقع داخل وسم <style>') }}
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{ __('أضف أكواد CSS مخصصة') }}</label>
                                                    <textarea class="form-control"
                                                              rows="8"
                                                              name="general[custom_css]"
                                                              placeholder="/* أكواد CSS مخصصة */
.custom-button {
    background: linear-gradient(135deg, #00b4d8, #ff5d8f);
    border-radius: 25px;
    padding: 10px 30px;
}

.header-transparent {
    background: transparent !important;
    backdrop-filter: blur(10px);
}"
                                                            >{{ get_general_value('custom_css') }}</textarea>
                                                    <small class="text-muted">
                                                        {{ __('استخدم Selectors محددة لتجنب التعارض مع الأنماط الافتراضية') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ================================================= --}}
                                        {{-- HTML مخصص --}}
                                        {{-- ================================================= --}}
                                        <div class="form-section mb-5">
                                            <h5 class="section-title mb-3">
                                                <i class="ft-code"></i>
                                                {{ __('HTML مخصص') }}
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>{{ __('HTML في Header') }}</label>
                                                    <div class="alert alert-warning">
                                                        <i class="ft-alert-triangle"></i>
                                                        {{ __('يتم إضافة هذا الكود قبل إغلاق وسم </head>') }}
                                                    </div>
                                                    <textarea class="form-control"
                                                              rows="6"
                                                              name="general[custom_html_head]"
                                                              placeholder="<!-- أكواد مخصصة في ال head -->
<meta property='og:image' content='{{ asset(get_general_value('website_logo')) }}'>
<link rel='preconnect' href='https://fonts.googleapis.com'>"
                                                            >{{ get_general_value('custom_html_head') }}</textarea>
                                                    <small class="text-muted">
                                                        {{ __('مثال: روابط خطوط، meta tags، إلخ') }}
                                                    </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label>{{ __('HTML في Body') }}</label>
                                                    <div class="alert alert-warning">
                                                        <i class="ft-alert-triangle"></i>
                                                        {{ __('يتم إضافة هذا الكود قبل إغلاق وسم </body>') }}
                                                    </div>
                                                    <textarea class="form-control"
                                                              rows="6"
                                                              name="general[custom_html_body]"
                                                              placeholder="<!-- أكواد مخصصة في نهاية ال body -->
<div class='floating-whatsapp'>
    <a href='https://wa.me/{{ get_general_value('phone') }}'>
        <i class='ft-phone-call'></i>
    </a>
</div>"
                                                            >{{ get_general_value('custom_html_body') }}</textarea>
                                                    <small class="text-muted">
                                                        {{ __('مثال: ويدجت، شات، أزرار عائمة، إلخ') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ================================================= --}}
                                        {{-- JavaScript مخصص --}}
                                        {{-- ================================================= --}}
                                        <div class="form-section mb-5">
                                            <h5 class="section-title mb-3">
                                                <i class="ft-terminal"></i>
                                                {{ __('JavaScript مخصص') }}
                                            </h5>
                                            <div class="alert alert-danger">
                                                <i class="ft-alert-octagon"></i>
                                                {{ __('تنبيه: تأكد من صحة كود JavaScript قبل الحفظ لتجنب أخطاء الموقع') }}
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>{{ __('أضف أكواد JavaScript') }}</label>
                                                    <textarea class="form-control"
                                                              rows="8"
                                                              name="general[custom_js]"
                                                              placeholder="// أكواد JavaScript مخصصة
document.addEventListener('DOMContentLoaded', function() {
    // كود لتحريك العناصر
    const buttons = document.querySelectorAll('.btn-primary');
    buttons.forEach(btn => {
        btn.addEventListener('mouseenter', () => {
            btn.style.transform = 'scale(1.05)';
        });
        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'scale(1)';
        });
    });

    // تتبع الأحداث
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function(e) {
            console.log('تم النقر على رابط:', this.href);
        });
    });
});"
                                                            >{{ get_general_value('custom_js') }}</textarea>
                                                    <small class="text-muted">
                                                        {{ __('استخدم console.log() للتصحيح. تجنب استخدام document.write()') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ================================================= --}}
                                        {{-- اللغة العربية --}}
                                        {{-- ================================================= --}}
                                        <div class="form-section mb-5">
                                            <h5 class="section-title">
                                                <i class="ft-flag"></i>
                                                {{ __('إعدادات اللغة العربية') }}
                                            </h5>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>{{ __('اسم الموقع') }}</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="general[website_name_ar]"
                                                           value="{{ get_general_value('website_name_ar') }}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label>{{ __('العنوان') }}</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="general[address_ar]"
                                                           value="{{ get_general_value('address_ar') }}">
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label>{{ __('وصف الموقع') }}</label>
                                                    <textarea class="form-control js-editor"
                                                              rows="3"
                                                              name="general[description_ar]">
                                                        {{ get_general_value('description_ar') }}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ================================================= --}}
                                        {{-- اللغة الإنجليزية --}}
                                        {{-- ================================================= --}}
                                        <div class="form-section mb-4">
                                            <h5 class="section-title">
                                                <i class="ft-flag"></i>
                                                {{ __('إعدادات اللغة الإنجليزية') }}
                                            </h5>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>{{ __('اسم الموقع') }}</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="general[website_name_en]"
                                                           value="{{ get_general_value('website_name_en') }}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label>{{ __('العنوان') }}</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="general[address_en]"
                                                           value="{{ get_general_value('address_en') }}">
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label>{{ __('وصف الموقع') }}</label>
                                                    <textarea class="form-control js-editor"
                                                              rows="3"
                                                              name="general[description_en]">
                                                        {{ get_general_value('description_en') }}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- SAVE --}}
                                        <div class="text-center">
                                            <button type="submit"
                                                    class="btn btn-primary btn-lg">
                                                <i class="la la-check"></i>
                                                {{ __('حفظ التغييرات') }}
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