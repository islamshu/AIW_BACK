@extends('layouts.master')
@section('style')
    <style>
        /* Switch styling */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .discount {
            display: none
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .hidden-options {
            display: none;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        .switch input:checked+.slider {
            background-color: #28a745;
        }

        .non_discount {
            display: block;
        }

        .switch input:checked+.slider:before {
            transform: translateX(24px);
        }

        .image-preview-container {
            margin-top: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .image-preview {
            max-width: 100px;
            max-height: 100px;
            border-radius: 4px;
            border: 1px solid #ddd;
            padding: 4px;
        }

        /* Form styling */
        .card {
            box-shadow: 0 4px 24px 0 rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 10px;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
            padding: 1.5rem;
            border-radius: 10px 10px 0 0 !important;
        }

        .card-header h4 {
            color: #333;
            font-weight: 600;
        }

        .card-body {
            padding: 2rem;
        }

        .form-section {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .section-title {
            color: #3d4852;
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .form-group label {
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 6px;
            padding: 10px 15px;
            border: 1px solid #d2d6dc;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea.form-control {
            min-height: 100px;
        }

        .btn-success {
            background-color: #38a169;
            border-color: #38a169;
            padding: 12px 30px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-success:hover {
            background-color: #2f855a;
            border-color: #2f855a;
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: #4299e1;
            border-color: #4299e1;
        }

        .btn-danger {
            background-color: #e53e3e;
            border-color: #e53e3e;
        }

        .variation-row {
            background-color: white;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .switch-container {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .switch-container label {
            margin-right: 10px;
            margin-bottom: 0;
        }

        .image-preview-container {
            margin-top: 10px;
        }

        .image-preview {
            max-width: 150px;
            max-height: 150px;
            border-radius: 4px;
            border: 1px solid #ddd;
            padding: 5px;
            margin-top: 10px;
        }
    </style>
@endsection
@section('title', __('إضافة منتج جديد'))
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">{{ __('إضافة منتج جديد') }}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('الرئيسية') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">{{ __('المنتجات') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('إضافة منتج') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <section id="product-create">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"><i class="ft-plus-circle"></i> {{ __('بيانات المنتج الأساسية') }}
                                    </h4>
                                </div>
                                <div class="card-content collapse show">
                                    @include('dashboard.inc.alerts')

                                    <div class="card-body">
                                        <form action="{{ route('products.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <!-- الاسم -->
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="name_ar">{{ __('اسم المنتج (عربي)') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" value="{{ old('name.ar') }}" id="name_ar"
                                                            name="name[ar]" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="name_he">{{ __('اسم المنتج (عبري)') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="name_he" value="{{ old('name.he') }}"
                                                            name="name[he]" class="form-control text-right" dir="rtl"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- الفئة والصورة -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="category_id">{{ __('التصنيف') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select id="category_id" name="category_id" class="form-control"
                                                            required>
                                                            <option value="" disabled selected>--
                                                                {{ __('اختر التصنيف') }} --</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- صور المنتج -->
                                            <!-- صور المنتج -->


                                            <!-- صور الثامب -->
                                            <div class="form-group mb-3">
                                                <label for="thumbnails">{{ __('صور الثامب (متعددة)') }}</label>
                                                <input type="file" id="thumbnails" name="thumbnails[]"
                                                    class="form-control" multiple accept="image/*">
                                                <div id="thumbnails-preview-container"
                                                    class="image-preview-container d-flex flex-wrap"></div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="images">{{ __('صور المنتج (متعددة)') }}</label>
                                                <input type="file" id="images" name="images[]" class="form-control"
                                                    multiple accept="image/*">
                                                <div id="images-preview-container"
                                                    class="image-preview-container d-flex flex-wrap"></div>
                                            </div>



                                            <!-- السعر و SKU -->

                                            <div class="form-section mb-4 ">
                                                <h5 class="section-title"><i class="ft-layers"></i>
                                                    {{ __('السعر والخصم') }}</h5>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label for="price">{{ __('السعر') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" value="{{ old('price') }}"
                                                                step="0.01" id="price" name="price"
                                                                class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="has_discount">{{ __('هل يوجد خصم') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select name="has_discount" required class="form-control"
                                                            id="has_discount">
                                                            <option value="" selected disabled>{{ __('اختر') }}
                                                            </option>
                                                            <option value="1">
                                                                {{ __('نعم') }}</option>
                                                            <option value="0">
                                                                {{ __('لا') }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 discount discountclass">
                                                        <label for="discount_type">{{ __('نوع الخصم') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select name="discount_type" class="form-control"
                                                            id="discount_type">
                                                            <option value="" selected disabled>{{ __('اختر') }}
                                                            </option>
                                                            <option value="fixed">
                                                                {{ __('ثابت') }}</option>
                                                            <option value="percentage">
                                                                {{ __('نسبة') }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 discount discountclass">
                                                        <div class="form-group mb-3">
                                                            <label for="discount_value">{{ __('قيمة الخصم') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" value="{{ old('discount_value') }}"
                                                                step="0.01" id="discount_value" name="discount_value"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                            <!-- الوصف القصير -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label
                                                            for="short_description_ar">{{ __('الوصف القصير (عربي)') }}</label>
                                                        <textarea id="short_description_ar" name="short_description[ar]" class="form-control" rows="3"
                                                            placeholder="{{ __('وصف مختصر للمنتج') }}"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label
                                                            for="short_description_he">{{ __('الوصف القصير (عبري)') }}</label>
                                                        <textarea id="short_description_he" name="short_description[he]" class="form-control text-right" dir="rtl"
                                                            rows="3" placeholder="{{ __('وصف مختصر للمنتج') }}"></textarea>
                                                    </div>
                                                </div>
                                            </div>



                                            <!-- الخيارات -->
                                            <div class="form-section mb-4">
                                                <h5 class="section-title"><i class="ft-settings"></i>
                                                    {{ __('خيارات المنتج') }}</h5>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="switch-container">
                                                            <label for="status_switch">{{ __('حالة المنتج') }}</label>
                                                            <label class="switch mb-0">
                                                                <input type="checkbox" id="status_switch" name="status"
                                                                    value="1" checked>
                                                                <span class="slider"></span>
                                                            </label>
                                                            <span class="text-success mr-2">{{ __('نشط') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="switch-container">
                                                            <label for="is_featured_switch">{{ __('منتج مميز') }}</label>
                                                            <label class="switch mb-0">
                                                                <input type="checkbox" id="is_featured_switch"
                                                                    name="is_featured" value="1">
                                                                <span class="slider"></span>
                                                            </label>
                                                            <span class="text-primary mr-2">{{ __('مميز') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- المتغيرات -->
                                            <div class="form-section mb-4">
                                                <h5 class="section-title"><i class="ft-layers"></i>
                                                    {{ __('إدارة المتغيرات') }}</h5>
                                                <p class="text-muted mb-3">
                                                    {{ __('حدد نوع المتغيرات التي يمتلكها هذا المنتج') }}
                                                </p>

                                                <!-- خيارات نوع المتغيرات -->
                                                <div class="variation-type-section">
                                                    <div class="variation-type-option">
                                                        <input type="radio" id="no_variations" name="variation_type"
                                                            value="none" checked>
                                                        <label
                                                            for="no_variations">{{ 'لا يحتوي على متغيرات (كمية واحدة فقط)' }}</label>
                                                    </div>

                                                    <div class="variation-type-option">
                                                        <input type="radio" id="color_variations" name="variation_type"
                                                            value="color">
                                                        <label for="color_variations">{{ 'يحتوي على ألوان فقط' }}</label>
                                                    </div>

                                                    <div class="variation-type-option">
                                                        <input type="radio" id="size_variations" name="variation_type"
                                                            value="size">
                                                        <label for="size_variations">{{ 'يحتوي على مقاسات فقط' }}</label>
                                                    </div>

                                                    <div class="variation-type-option">
                                                        <input type="radio" id="color_size_variations"
                                                            name="variation_type" value="color_size">
                                                        <label
                                                            for="color_size_variations">{{ 'يحتوي على ألوان ومقاسات' }}</label>
                                                    </div>
                                                </div>

                                                <!-- قسم الكمية الأساسية (يظهر عندما لا يكون هناك متغيرات) -->
                                                <div id="simple_quantity_section" class="form-group">
                                                    <label for="simple_quantity">{{ __('الكمية المتاحة') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" id="simple_quantity" name="simple_quantity"
                                                        class="form-control" value="0" min="0">
                                                </div>

                                                <!-- قسم المتغيرات (يظهر عند اختيار أي نوع متغيرات) -->
                                                <div id="variations_options_container"
                                                    class="variation-options-container hidden-options">
                                                    <div id="variations-container">
                                                        <div class="variation-row row align-items-center">
                                                            <!-- سيتم ملء هذا القسم ديناميكيًا حسب نوع المتغيرات المختارة -->
                                                        </div>
                                                    </div>

                                                    <button type="button" class="btn btn-primary mt-2"
                                                        id="add-variation">
                                                        <i class="ft-plus"></i> {{ __('إضافة متغير جديد') }}
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label
                                                            for="fake_rating_status">{{ __('حالة التقييم الوهمي') }}</label>
                                                        <select name="fake_rating_enabled" id="fake_rating_status"
                                                            class="form-control">
                                                            <option value="0"
                                                                {{ old('fake_rating_enabled', isset($product) ? ($product->fake_rating_enabled ? '1' : '0') : '0') == '0' ? 'selected' : '' }}>
                                                                {{ __('إيقاف') }}
                                                            </option>
                                                            <option value="1"
                                                                {{ old('fake_rating_enabled', isset($product) ? ($product->fake_rating_enabled ? '1' : '0') : '0') == '1' ? 'selected' : '' }}>
                                                                {{ __('تفعيل') }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3" id="fake_rating_value_container"
                                                        style="display: none;">
                                                        <label
                                                            for="fake_rating_value">{{ __('قيمة التقييم الوهمي (من 1 إلى 5)') }}</label>
                                                        <input type="number" step="0.1" min="1"
                                                            max="5" id="fake_rating_value"
                                                            name="fake_rating_value"
                                                            value="{{ old('fake_rating_value', isset($product) ? $product->fake_rating_value : '') }}"
                                                            class="form-control" placeholder="مثلاً 4.5">
                                                    </div>
                                                </div>
                                            </div>





                                            <!-- زر الحفظ -->
                                            <div class="form-actions text-center mt-4">
                                                <button type="submit" class="btn btn-success btn-lg px-5">
                                                    <i class="la la-check-square-o"></i> {{ __('حفظ المنتج') }}
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
    <script>
        $(document).ready(function() {
            function previewMultipleImages(input, containerId) {
                const container = document.getElementById(containerId);
                container.innerHTML = ''; // حذف الصور السابقة

                if (input.files) {
                    Array.from(input.files).forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'image-preview'; // تنسيق
                            container.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    });
                }
            }

            document.getElementById('images').addEventListener('change', function() {
                previewMultipleImages(this, 'images-preview-container');
            });

            document.getElementById('thumbnails').addEventListener('change', function() {
                previewMultipleImages(this, 'thumbnails-preview-container');
            });

            let variationIndex = 1;

            const variationTypeRadios = $('input[name="variation_type"]');
            const simpleQuantitySection = $('#simple_quantity_section');
            const variationsContainer = $('#variations_options_container');
            const variationsInnerContainer = $('#variations-container');

            // تغيير نوع المتغيرات
            variationTypeRadios.change(function() {
                const selectedType = $(this).val();

                if (selectedType === 'none') {
                    simpleQuantitySection.show();
                    variationsContainer.addClass('hidden-options');
                    variationsContainer.removeClass('visible-options');
                    variationsInnerContainer.empty();

                } else {
                    simpleQuantitySection.hide();
                    variationsContainer.removeClass('hidden-options');
                    variationsContainer.addClass('visible-options');

                    // مسح المتغيرات الحالية
                    variationsInnerContainer.empty();

                    // إضافة متغير أولي حسب النوع المختار
                    addInitialVariation(selectedType);
                }
            });

            // إضافة متغير أولي حسب النوع
            function addInitialVariation(type) {
                let html = '';

                switch (type) {
                    case 'color':
                        html = `
                            <div class="variation-row row align-items-center">
                                <div class="col-md-6">
                                    <label class="d-block text-sm">{{ __('اللون') }}</label>
                                    <select name="variations[0][color_id]" class="form-control" required>
                                        <option value="">-- {{ __('اختر اللون') }} --</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->getTranslation('value', app()->getLocale()) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label class="d-block text-sm">{{ __('الكمية') }}</label>
                                    <input type="number" name="variations[0][stock]" class="form-control" value="0" min="0" required>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-variation" title="{{ __('حذف المتغير') }}" disabled>
                                        <i class="ft-trash"></i>
                                    </button>
                                </div>
                            </div>`;
                        break;

                    case 'size':
                        html = `
                            <div class="variation-row row align-items-center">
                                <div class="col-md-6">
                                    <label class="d-block text-sm">{{ __('المقاس') }}</label>
                                    <select name="variations[0][size_id]" class="form-control" required>
                                        <option value="">-- {{ __('اختر المقاس') }} --</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->getTranslation('value', app()->getLocale()) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label class="d-block text-sm">{{ __('الكمية') }}</label>
                                    <input type="number" name="variations[0][stock]" class="form-control" value="0" min="0" required>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-variation" title="{{ __('حذف المتغير') }}" disabled>
                                        <i class="ft-trash"></i>
                                    </button>
                                </div>
                            </div>`;
                        break;

                    case 'color_size':
                        html = `
                            <div class="variation-row row align-items-center">
                                <div class="col-md-4">
                                    <label class="d-block text-sm">{{ __('اللون') }}</label>
                                    <select name="variations[0][color_id]" class="form-control" required>
                                        <option value="">-- {{ __('اختر اللون') }} --</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->getTranslation('value', app()->getLocale()) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="d-block text-sm">{{ __('المقاس') }}</label>
                                    <select name="variations[0][size_id]" class="form-control" required>
                                        <option value="">-- {{ __('اختر المقاس') }} --</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->getTranslation('value', app()->getLocale()) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="d-block text-sm">{{ __('الكمية') }}</label>
                                    <input type="number" name="variations[0][stock]" class="form-control" value="0" min="0" required>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-variation" title="{{ __('حذف المتغير') }}" disabled>
                                        <i class="ft-trash"></i>
                                    </button>
                                </div>
                            </div>`;
                        break;
                }

                variationsInnerContainer.html(html);
            }

            // إضافة متغير جديد حسب النوع المختار
            $(document).on('click', '#add-variation', function() {
                const selectedType = $('input[name="variation_type"]:checked').val();
                const variationIndex = $('.variation-row').length;

                let html = '';

                switch (selectedType) {
                    case 'color':
                        html = `
                            <div class="variation-row row align-items-center mt-2">
                                <div class="col-md-6">
                                    <select name="variations[${variationIndex}][color_id]" class="form-control" required>
                                        <option value="">-- {{ __('اختر اللون') }} --</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->getTranslation('value', app()->getLocale()) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input type="number" name="variations[${variationIndex}][stock]" class="form-control" value="0" min="0" required>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-variation" title="{{ __('حذف المتغير') }}">
                                        <i class="ft-trash"></i>
                                    </button>
                                </div>
                            </div>`;
                        break;

                    case 'size':
                        html = `
                            <div class="variation-row row align-items-center mt-2">
                                <div class="col-md-6">
                                    <select name="variations[${variationIndex}][size_id]" class="form-control" required>
                                        <option value="">-- {{ __('اختر المقاس') }} --</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->getTranslation('value', app()->getLocale()) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input type="number" name="variations[${variationIndex}][stock]" class="form-control" value="0" min="0" required>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-variation" title="{{ __('حذف المتغير') }}">
                                        <i class="ft-trash"></i>
                                    </button>
                                </div>
                            </div>`;
                        break;

                    case 'color_size':
                        html = `
                            <div class="variation-row row align-items-center mt-2">
                                <div class="col-md-4">
                                    <select name="variations[${variationIndex}][color_id]" class="form-control" required>
                                        <option value="">-- {{ __('اختر اللون') }} --</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->getTranslation('value', app()->getLocale()) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="variations[${variationIndex}][size_id]" class="form-control" required>
                                        <option value="">-- {{ __('اختر المقاس') }} --</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->getTranslation('value', app()->getLocale()) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="variations[${variationIndex}][stock]" class="form-control" value="0" min="0" required>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-variation" title="{{ __('حذف المتغير') }}">
                                        <i class="ft-trash"></i>
                                    </button>
                                </div>
                            </div>`;
                        break;
                }

                variationsInnerContainer.append(html);

                // تمكين زر الحذف للمتغير الأول إذا كان هناك أكثر من متغير
                if ($('.variation-row').length > 1) {
                    $('.variation-row').first().find('.remove-variation').prop('disabled', false);
                }
            });

            // حذف متغير
            $(document).on('click', '.remove-variation', function() {
                if ($('.variation-row').length > 1) {
                    $(this).closest('.variation-row').remove();

                    // إذا بقي متغير واحد فقط، قم بتعطيل زر الحذف
                    if ($('.variation-row').length === 1) {
                        $('.variation-row').first().find('.remove-variation').prop('disabled', true);
                    }

                    // إعادة ترقيم المتغيرات
                    $('.variation-row').each(function(index) {
                        $(this).find('select, input').each(function() {
                            const name = $(this).attr('name').replace(/\[\d+\]/,
                                `[${index}]`);
                            $(this).attr('name', name);
                        });
                    });
                } else {
                    toastr.error('{{ __('يجب أن يحتوي المنتج على متغير واحد على الأقل') }}');
                }
            });



            $('#image').change(function(e) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
        // معاينة صور متعددة
    </script>
    <script>
        $('#has_discount').change(function(e) {
            const val = this.value;
            const discountClass = $('.discountclass');
            if (val == 1) {
                discountClass.removeClass('discount');
                discountClass.addClass('non_discount');
                $('#discount_type').attr('required', true);
                $('#discount_value').attr('required', true);


            } else {
                discountClass.removeClass('non_discount');
                discountClass.addClass('discount');
                $('#discount_type').attr('required', false);
                $('#discount_value').attr('required', false);
            }

        })
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectStatus = document.getElementById('fake_rating_status');
            const valueContainer = document.getElementById('fake_rating_value_container');

            function toggleFakeRatingInput() {
                if (selectStatus.value === '1') {
                    valueContainer.style.display = 'block';
                } else {
                    valueContainer.style.display = 'none';
                    // يمكنك مسح القيمة عند الإخفاء إذا تريد
                    // document.getElementById('fake_rating_value').value = '';
                }
            }

            // استدعاء الوظيفة عند تحميل الصفحة للتأكد من الحالة الصحيحة
            toggleFakeRatingInput();

            // استمع لتغيير select
            selectStatus.addEventListener('change', toggleFakeRatingInput);
        });
    </script>

@endsection
