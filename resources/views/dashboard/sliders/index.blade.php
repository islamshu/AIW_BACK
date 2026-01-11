@extends('layouts.master')
@section('title', __('السلايدرات') )

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('السلايدرات') }}</h3>
                <div class="breadcrumbs-top">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('الرئيسية') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('السلايدرات') }}</li>
                    </ol>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <a href="{{ route('sliders.create') }}" class="btn btn-primary float-md-right">
                    <i class="la la-plus"></i> {{ __('إضافة سلايدر جديد') }}
                </a>
            </div>
        </div>

        <div class="content-body">
            @include('dashboard.inc.alerts')

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title">{{ __('قائمة السلايدرات') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('الصورة') }}</th>
                                    <th>{{ __('العنوان عربي') }}</th>
                                    <th>{{ __('العنوان عبرية') }}</th>
                                    <th>{{ __('الرابط') }}</th>
                                    <th>{{ __('الإجراءات') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sliders as $slider)
                                <tr>
                                    <td>
                                        @if($slider->image)
                                            <img src="{{ asset('storage/'.$slider->image) }}" style="width: 100px;" class="img-thumbnail">
                                        @endif
                                    </td>
                                    <td>{{ $slider->getTranslation('title','ar') }}</td>
                                    <td>{{ $slider->getTranslation('title','he') }}</td>
                                    <td>{{ $slider->link ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-sm btn-info">
                                            <i class="la la-edit"></i> {{ __('تعديل') }}
                                        </a>
                                        <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف هذا السلايدر؟') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="la la-trash"></i> {{ __('حذف') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">{{ __('لا يوجد سلايدرات حالياً') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
