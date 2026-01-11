@extends('layouts.master')
@section('style')
    <style>
        .non_discount {
            display: block;
        }

        .discount {
            display: none
        }

        /* Switch styling */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
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

        .hidden-options {
            display: none;
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

        .existing-image {
            position: relative;
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .delete-image-btn {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #e53e3e;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            cursor: pointer;
            border: none;
        }
    </style>
@endsection
@section('title', __('تعديل المنتج'))
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">{{ __('تعديل المنتج') }}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('الرئيسية') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">{{ __('المنتجات') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('تعديل المنتج') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <section id="product-edit">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"><i class="ft-edit"></i> {{ __('بيانات المنتج الأساسية') }}
                                    </h4>
                                </div>
                                <div class="card-content collapse show">
                                    @include('dashboard.inc.alerts')

                                    <div class="card-body">
                                        <form action="{{ route('products.update', $product->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="row">
                                                <!-- الاسم -->
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="name_ar">{{ __('اسم المنتج (عربي)') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="name_ar" name="name[ar]"
                                                            class="form-control"
                                                            value="{{ $product->getTranslation('name', 'ar') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="name_he">{{ __('اسم المنتج (عبري)') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="name_he" name="name[he]"
                                                            class="form-control text-right" dir="rtl"
                                                            value="{{ $product->getTranslation('name', 'he') }}" required>
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
                                                            <option value="" disabled>-- {{ __('اختر التصنيف') }} --
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- صور الثامب الحالية -->
                                            <div class="form-group mb-3">
                                                <label>{{ __('صور الثامب الحالية') }}</label>
                                                <div class="image-preview-container d-flex flex-wrap">
                                                    @foreach ($product->thumbnails as $thumbnail)
                                                        <div class="existing-image">
                                                            <img src="{{ asset('storage/' . $thumbnail->image) }}"
                                                                class="image-preview">
                                                            <button type="button" class="delete-image-btn"
                                                                data-type="thumbnail"
                                                                data-id="{{ $thumbnail->id }}">×</button>
                                                            <input type="hidden" name="thumbnails_ids[]"
                                                                value="{{ $thumbnail->id }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <input type="hidden" name="deleted_thumbnails[]" id="deleted_thumbnails"
                                                    value="">
                                            </div>

                                            <!-- صور الثامب الجديدة -->
                                            <div class="form-group mb-3">
                                                <label for="thumbnails">{{ __('إضافة صور ثامب جديدة') }}</label>
                                                <input type="file" id="thumbnails" name="thumbnails[]"
                                                    class="form-control" multiple accept="image/*">
                                                <div id="thumbnails-preview-container"
                                                    class="image-preview-container d-flex flex-wrap"></div>
                                            </div>

                                            <!-- صور المنتج الحالية -->
                                            <div class="form-group mb-3">
                                                <label>{{ __('صور المنتج الحالية') }}</label>
                                                <div class="image-preview-container d-flex flex-wrap">
                                                    @foreach ($product->images as $image)
                                                        <div class="existing-image">
                                                            <img src="{{ asset('storage/' . $image->image) }}"
                                                                class="image-preview">
                                                            <button type="button" class="delete-image-btn"
                                                                data-type="image" data-id="{{ $image->id }}">×</button>
                                                            <input type="hidden" name="images_ids[]"
                                                                value="{{ $image->id }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <input type="hidden" name="deleted_images[]" id="deleted_images"
                                                    value="">
                                            </div>

                                            <!-- صور المنتج الجديدة -->
                                            <div class="form-group mb-3">
                                                <label for="images">{{ __('إضافة صور منتج جديدة') }}</label>
                                                <input type="file" id="images" name="images[]" class="form-control"
                                                    multiple accept="image/*">
                                                <div id="images-preview-container"
                                                    class="image-preview-container d-flex flex-wrap"></div>
                                            </div>


                                            <div class="form-section mb-4 ">
                                                <h5 class="section-title"><i class="ft-layers"></i>
                                                    {{ __('السعر والخصم') }}</h5>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label for="price">{{ __('السعر') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number"
                                                                value="{{ old('price', $product->price) }}"
                                                                step="0.01" id="price" name="price"
                                                                class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label for="has_discount">{{ __('هل يوجد خصم') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select name="has_discount" required class="form-control"
                                                            id="has_discount">
                                                            <option value="" disabled>{{ __('اختر') }}</option>
                                                            <option value="1"
                                                                {{ old('has_discount', $product->has_discount) == 1 ? 'selected' : '' }}>
                                                                {{ __('نعم') }}
                                                            </option>
                                                            <option value="0"
                                                                {{ old('has_discount', $product->has_discount) == 0 ? 'selected' : '' }}>
                                                                {{ __('لا') }}
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3 discountclass">
                                                        <label for="discount_type">{{ __('نوع الخصم') }} <span
                                                                class="text-danger">*</span></label>
                                                        <select name="discount_type" class="form-control"
                                                            id="discount_type">
                                                            <option value="" disabled>{{ __('اختر') }}</option>
                                                            <option value="fixed"
                                                                {{ old('discount_type', $product->discount_type) == 'fixed' ? 'selected' : '' }}>
                                                                {{ __('ثابت') }}
                                                            </option>
                                                            <option value="percentage"
                                                                {{ old('discount_type', $product->discount_type) == 'percentage' ? 'selected' : '' }}>
                                                                {{ __('نسبة') }}
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3 discountclass">
                                                        <div class="form-group mb-3">
                                                            <label for="discount_value">{{ __('قيمة الخصم') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number"
                                                                value="{{ old('discount_value', $product->discount_value) }}"
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
                                                            placeholder="{{ __('وصف مختصر للمنتج') }}">{{ $product->getTranslation('short_description', 'ar') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label
                                                            for="short_description_he">{{ __('الوصف القصير (عبري)') }}</label>
                                                        <textarea id="short_description_he" name="short_description[he]" class="form-control text-right" dir="rtl"
                                                            rows="3" placeholder="{{ __('وصف مختصر للمنتج') }}">{{ $product->getTranslation('short_description', 'he') }}</textarea>
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
                                                                    value="1"
                                                                    {{ $product->status ? 'checked' : '' }}>
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
                                                                    name="is_featured" value="1"
                                                                    {{ $product->is_featured ? 'checked' : '' }}>
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
                                                            value="none"
                                                            {{ $variationType == 'none' ? 'checked' : '' }}>
                                                        <label
                                                            for="no_variations">{{ 'لا يحتوي على متغيرات (كمية واحدة فقط)' }}</label>
                                                    </div>

                                                    <div class="variation-type-option">
                                                        <input type="radio" id="color_variations" name="variation_type"
                                                            value="color"
                                                            {{ $variationType == 'color' ? 'checked' : '' }}>
                                                        <label for="color_variations">{{ 'يحتوي على ألوان فقط' }}</label>
                                                    </div>

                                                    <div class="variation-type-option">
                                                        <input type="radio" id="size_variations" name="variation_type"
                                                            value="size"
                                                            {{ $variationType == 'size' ? 'checked' : '' }}>
                                                        <label for="size_variations">{{ 'يحتوي على مقاسات فقط' }}</label>
                                                    </div>

                                                    <div class="variation-type-option">
                                                        <input type="radio" id="color_size_variations"
                                                            name="variation_type" value="color_size"
                                                            {{ $variationType == 'color_size' ? 'checked' : '' }}>
                                                        <label
                                                            for="color_size_variations">{{ 'يحتوي على ألوان ومقاسات' }}</label>
                                                    </div>
                                                </div>

                                                <!-- قسم الكمية الأساسية (يظهر عندما لا يكون هناك متغيرات) -->
                                                <div id="simple_quantity_section" class="form-group"
                                                    style="{{ $variationType != 'none' ? 'display: none;' : '' }}">
                                                    <label for="simple_quantity">{{ __('الكمية المتاحة') }} <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" id="simple_quantity" name="simple_quantity"
                                                        class="form-control"
                                                        value="{{ $product->variations->sum('stock') }}" min="0">
                                                </div>

                                                <!-- قسم المتغيرات (يظهر عند اختيار أي نوع متغيرات) -->
                                                <div id="variations_options_container"
                                                    class="variation-options-container {{ $variationType == 'none' ? 'hidden-options' : 'visible-options' }}">
                                                    <div id="variations-container">
                                                        @if ($variationType != 'none')
                                                            @foreach ($product->variations as $index => $variation)
                                                                <div
                                                                    class="variation-row row align-items-center {{ $index > 0 ? 'mt-2' : '' }}">
                                                                    @if ($variationType == 'color' || $variationType == 'color_size')
                                                                        <div
                                                                            class="{{ $variationType == 'color' ? 'col-md-6' : 'col-md-4' }}">
                                                                            <label
                                                                                class="d-block text-sm">{{ __('اللون') }}</label>
                                                                            <select
                                                                                name="variations[{{ $index }}][color_id]"
                                                                                class="form-control" required>
                                                                                <option value="">--
                                                                                    {{ __('اختر اللون') }} --</option>
                                                                                @foreach ($colors as $color)
                                                                                    <option value="{{ $color->id }}"
                                                                                        {{ $variation->color_id == $color->id ? 'selected' : '' }}>
                                                                                        {{ $color->getTranslation('value', app()->getLocale()) }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endif

                                                                    @if ($variationType == 'size' || $variationType == 'color_size')
                                                                        <div
                                                                            class="{{ $variationType == 'size' ? 'col-md-6' : 'col-md-4' }}">
                                                                            <label
                                                                                class="d-block text-sm">{{ __('المقاس') }}</label>
                                                                            <select
                                                                                name="variations[{{ $index }}][size_id]"
                                                                                class="form-control" required>
                                                                                <option value="">--
                                                                                    {{ __('اختر المقاس') }} --</option>
                                                                                @foreach ($sizes as $size)
                                                                                    <option value="{{ $size->id }}"
                                                                                        {{ $variation->size_id == $size->id ? 'selected' : '' }}>
                                                                                        {{ $size->getTranslation('value', app()->getLocale()) }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endif

                                                                    <div
                                                                        class="{{ $variationType == 'color_size' ? 'col-md-3' : 'col-md-5' }}">
                                                                        <label
                                                                            class="d-block text-sm">{{ __('الكمية') }}</label>
                                                                        <input type="number"
                                                                            name="variations[{{ $index }}][stock]"
                                                                            class="form-control"
                                                                            value="{{ $variation->stock }}"
                                                                            min="0" required>
                                                                    </div>

                                                                    <div class="col-md-1 d-flex align-items-end">
                                                                        <button type="button"
                                                                            class="btn btn-danger remove-variation"
                                                                            title="{{ __('حذف المتغير') }}"
                                                                            {{ $loop->first && $loop->count == 1 ? 'disabled' : '' }}>
                                                                            <i class="ft-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>

                                                    <button type="button" class="btn btn-primary mt-2"
                                                        id="add-variation">
                                                        <i class="ft-plus"></i> {{ __('إضافة متغير جديد') }}
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- التقييم الوهمي -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label
                                                            for="fake_rating_status">{{ __('حالة التقييم الوهمي') }}</label>
                                                        <select name="fake_rating_enabled" id="fake_rating_status"
                                                            class="form-control">
                                                            <option value="0"
                                                                {{ !$product->fake_rating_enabled ? 'selected' : '' }}>
                                                                {{ __('إيقاف') }}
                                                            </option>
                                                            <option value="1"
                                                                {{ $product->fake_rating_enabled ? 'selected' : '' }}>
                                                                {{ __('تفعيل') }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3" id="fake_rating_value_container"
                                                        style="{{ !$product->fake_rating_enabled ? 'display: none;' : '' }}">
                                                        <label
                                                            for="fake_rating_value">{{ __('قيمة التقييم الوهمي (من 1 إلى 5)') }}</label>
                                                        <input type="number" step="0.1" min="1"
                                                            max="5" id="fake_rating_value"
                                                            name="fake_rating_value"
                                                            value="{{ $product->fake_rating_value }}"
                                                            class="form-control" placeholder="مثلاً 4.5"
                                                            {{ $product->fake_rating_enabled ? '' : 'disabled' }}>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- زر الحفظ -->
                                            <div class="form-actions text-center mt-4">
                                                <button type="submit" class="btn btn-success btn-lg px-5">
                                                    <i class="la la-check-square-o"></i> {{ __('تحديث المنتج') }}
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
                            img.className = 'image-preview';
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

            let variationIndex = {{ $product->variations->count() }};

            const variationTypeRadios = $('input[name="variation_type"]');
            const simpleQuantitySection = $('#simple_quantity_section');
            const variationsContainer = $('#variations_options_container');
            const variationsInnerContainer = $('#variations-container');

            // تعيين النوع السابق عند التحميل
            $('input[name="variation_type"]:checked').data('previous', $('input[name="variation_type"]:checked')
                .val());

            // تغيير نوع المتغيرات
            variationTypeRadios.change(function() {
                const selectedType = $(this).val();
                const previousType = $(this).data('previous') || 'none';

                if (selectedType === 'none') {
                    simpleQuantitySection.show();
                    variationsContainer.addClass('hidden-options');
                    variationsContainer.removeClass('visible-options');
                    variationsInnerContainer.empty();

                } else {
                    simpleQuantitySection.hide();
                    variationsContainer.removeClass('hidden-options');
                    variationsContainer.addClass('visible-options');

                    // حفظ القيم الحالية قبل التغيير
                    const currentVariations = [];
                    $('.variation-row').each(function() {
                        const variation = {
                            color_id: $(this).find('[name*="[color_id]"]').val(),
                            size_id: $(this).find('[name*="[size_id]"]').val(),
                            stock: $(this).find('[name*="[stock]"]').val()
                        };
                        currentVariations.push(variation);
                    });

                    // مسح المتغيرات الحالية
                    variationsInnerContainer.empty();

                    // إضافة متغيرات جديدة مع الحفاظ على القيم عند الإمكان
                    if (currentVariations.length > 0) {
                        currentVariations.forEach((variation, index) => {
                            let html = '';

                            switch (selectedType) {
                                case 'color':
                                    html = `
                                        <div class="variation-row row align-items-center ${index > 0 ? 'mt-2' : ''}">
                                            <div class="col-md-6">
                                                <label class="d-block text-sm">{{ __('اللون') }}</label>
                                                <select name="variations[${index}][color_id]" class="form-control" required>
                                                    <option value="">-- {{ __('اختر اللون') }} --</option>
                                                    @foreach ($colors as $color)
                                                        <option value="@json($color->id)" ${variation.color_id == @json($color->id) ? 'selected' : ''}>
                                                            {{ $color->getTranslation('value', app()->getLocale()) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="d-block text-sm">{{ __('الكمية') }}</label>
                                                <input type="number" name="variations[${index}][stock]" class="form-control" value="${variation.stock}" min="0" required>
                                            </div>
                                            <div class="col-md-1 d-flex align-items-end">
                                                <button type="button" class="btn btn-danger remove-variation" title="{{ __('حذف المتغير') }}" ${index === 0 && currentVariations.length === 1 ? 'disabled' : ''}>
                                                    <i class="ft-trash"></i>
                                                </button>
                                            </div>
                                        </div>`;
                                    break;

                                case 'size':
                                    html = `
                                        <div class="variation-row row align-items-center ${index > 0 ? 'mt-2' : ''}">
                                            <div class="col-md-6">
                                                <label class="d-block text-sm">{{ __('المقاس') }}</label>
                                                <select name="variations[${index}][size_id]" class="form-control" required>
                                                    <option value="">-- {{ __('اختر المقاس') }} --</option>
                                                    @foreach ($sizes as $size)
                                                        <option value="@json($size->id)" ${variation.size_id == @json($size->id) ? 'selected' : ''}>
                                                            {{ $size->getTranslation('value', app()->getLocale()) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="d-block text-sm">{{ __('الكمية') }}</label>
                                                <input type="number" name="variations[${index}][stock]" class="form-control" value="${variation.stock}" min="0" required>
                                            </div>
                                            <div class="col-md-1 d-flex align-items-end">
                                                <button type="button" class="btn btn-danger remove-variation" title="{{ __('حذف المتغير') }}" ${index === 0 && currentVariations.length === 1 ? 'disabled' : ''}>
                                                    <i class="ft-trash"></i>
                                                </button>
                                            </div>
                                        </div>`;
                                    break;

                                case 'color_size':
                                    html = `
                                        <div class="variation-row row align-items-center ${index > 0 ? 'mt-2' : ''}">
                                            <div class="col-md-4">
                                                <label class="d-block text-sm">{{ __('اللون') }}</label>
                                                <select name="variations[${index}][color_id]" class="form-control" required>
                                                    <option value="">-- {{ __('اختر اللون') }} --</option>
                                                    @foreach ($colors as $color)
                                                        <option value="@json($color->id)" ${variation.color_id == @json($color->id) ? 'selected' : ''}>
                                                            {{ $color->getTranslation('value', app()->getLocale()) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="d-block text-sm">{{ __('المقاس') }}</label>
                                                <select name="variations[${index}][size_id]" class="form-control" required>
                                                    <option value="">-- {{ __('اختر المقاس') }} --</option>
                                                    @foreach ($sizes as $size)
                                                        <option value="@json($size->id)" ${variation.size_id == @json($size->id) ? 'selected' : ''}>
                                                            {{ $size->getTranslation('value', app()->getLocale()) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="d-block text-sm">{{ __('الكمية') }}</label>
                                                <input type="number" name="variations[${index}][stock]" class="form-control" value="${variation.stock}" min="0" required>
                                            </div>
                                            <div class="col-md-1 d-flex align-items-end">
                                                <button type="button" class="btn btn-danger remove-variation" title="{{ __('حذف المتغير') }}" ${index === 0 && currentVariations.length === 1 ? 'disabled' : ''}>
                                                    <i class="ft-trash"></i>
                                                </button>
                                            </div>
                                        </div>`;
                                    break;
                            }
                            variationsInnerContainer.append(html);
                        });
                    } else {
                        addInitialVariation(selectedType);
                    }
                }

                // حفظ النوع الحالي كسابق
                $(this).data('previous', selectedType);
            });

            // إضافة متغير أولي
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
                                            <option value="@json($color->id)">{{ $color->getTranslation('value', app()->getLocale()) }}</option>
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
                                            <option value="@json($size->id)">{{ $size->getTranslation('value', app()->getLocale()) }}</option>
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
                                            <option value="@json($color->id)">{{ $color->getTranslation('value', app()->getLocale()) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="d-block text-sm">{{ __('المقاس') }}</label>
                                    <select name="variations[0][size_id]" class="form-control" required>
                                        <option value="">-- {{ __('اختر المقاس') }} --</option>
                                        @foreach ($sizes as $size)
                                            <option value="@json($size->id)">{{ $size->getTranslation('value', app()->getLocale()) }}</option>
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

            // إضافة متغير جديد
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
                                            <option value="@json($color->id)">{{ $color->getTranslation('value', app()->getLocale()) }}</option>
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
                                            <option value="@json($size->id)">{{ $size->getTranslation('value', app()->getLocale()) }}</option>
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
                                            <option value="@json($color->id)">{{ $color->getTranslation('value', app()->getLocale()) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="variations[${variationIndex}][size_id]" class="form-control" required>
                                        <option value="">-- {{ __('اختر المقاس') }} --</option>
                                        @foreach ($sizes as $size)
                                            <option value="@json($size->id)">{{ $size->getTranslation('value', app()->getLocale()) }}</option>
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

                if ($('.variation-row').length > 1) {
                    $('.variation-row').first().find('.remove-variation').prop('disabled', false);
                }
            });

            // حذف متغير
            $(document).on('click', '.remove-variation', function() {
                if ($('.variation-row').length > 1) {
                    $(this).closest('.variation-row').remove();

                    if ($('.variation-row').length === 1) {
                        $('.variation-row').first().find('.remove-variation').prop('disabled', true);
                    }

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

            // حذف الصور الحالية
            $(document).on('click', '.delete-image-btn', function() {
                const type = $(this).data('type');
                const id = $(this).data('id');
                const deletedField = type === 'image' ? '#deleted_images' : '#deleted_thumbnails';

                let currentValue = $(deletedField).val();
                if (currentValue) {
                    currentValue += ',' + id;
                } else {
                    currentValue = id;
                }
                $(deletedField).val(currentValue);

                $(this).closest('.existing-image').hide();
            });

            // التحكم في عرض حقل التقييم الوهمي
            // التحكم في عرض وتعطيل حقل التقييم الوهمي
            const selectStatus = document.getElementById('fake_rating_status');
            const valueContainer = document.getElementById('fake_rating_value_container');
            const fakeRatingValue = document.getElementById('fake_rating_value');

            function toggleFakeRatingInput() {
                if (selectStatus.value === '1') {
                    valueContainer.style.display = 'block';
                    fakeRatingValue.disabled = false;
                    fakeRatingValue.setAttribute('required', 'required');
                } else {
                    valueContainer.style.display = 'none';
                    fakeRatingValue.disabled = true;
                    fakeRatingValue.removeAttribute('required');
                    fakeRatingValue.setCustomValidity('');
                }
            }

            // التهيئة الأولية
            toggleFakeRatingInput();

            // إضافة مستمع الحدث
            selectStatus.addEventListener('change', toggleFakeRatingInput);
        });
    </script>
    <script>
        function toggleDiscountFields(val) {
            const discountClass = $('.discountclass');
            if (val == 1) {
                discountClass.show();
                $('#discount_type').attr('required', true);
                $('#discount_value').attr('required', true);
            } else {
                discountClass.hide();
                $('#discount_type').attr('required', false);
                $('#discount_value').attr('required', false);
            }
        }

        $(document).ready(function() {
            // عند تحميل الصفحة
            toggleDiscountFields($('#has_discount').val());

            // عند تغيير الاختيار
            $('#has_discount').change(function() {
                toggleDiscountFields(this.value);
            });
        });
    </script>
@endsection
