@extends('layouts.master')
@section('title','لوحة التحكم')

@section('content')
<div class="app-content content">
<div class="content-wrapper">

{{-- العنوان --}}
<div class="content-header row mb-3">
    <div class="col-12">
        <h3 class="content-header-title">لوحة التحكم</h3>
        <p class="text-muted">نظرة عامة على النظام</p>
    </div>
</div>

{{-- كروت الإحصائيات --}}
<div class="row">

    <div class="col-md-3 mb-2">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <i class="la la-eye text-primary la-2x mb-1"></i>
                <h5 class="mb-0">{{ $visits ?? 0 }}</h5>
                <small class="text-muted">عدد الزيارات</small>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-2">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <i class="la la-cubes text-success la-2x mb-1"></i>
                <h5 class="mb-0">{{ $servicesCount }}</h5>
                <small class="text-muted">إجمالي الخدمات</small>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-2">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <i class="la la-th-large text-info la-2x mb-1"></i>
                <h5 class="mb-0">{{ $sectorsCount }}</h5>
                <small class="text-muted">إجمالي القطاعات</small>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-2">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <i class="la la-check-circle text-warning la-2x mb-1"></i>
                <h5 class="mb-0">{{ $activeServices + $activeSectors }}</h5>
                <small class="text-muted">العناصر المفعلة</small>
            </div>
        </div>
    </div>

</div>

{{-- معلومات النظام --}}
<div class="row mt-3">

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <strong>معلومات النظام</strong>
            </div>
            <div class="card-body">
                <p>📅 آخر تحديث: <strong>{{ now()->format('Y-m-d H:i') }}</strong></p>
                <p>⚙️ حالة الموقع: <span class="badge badge-success">يعمل</span></p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <strong>اختصارات سريعة</strong>
            </div>
            <div class="card-body">
                <a href="{{ route('home-services.index') }}" class="btn btn-outline-primary btn-sm mb-1">
                    إدارة الخدمات
                </a>
                <a href="{{ route('sectors.index') }}" class="btn btn-outline-info btn-sm mb-1">
                    إدارة القطاعات
                </a>
                <a href="{{ route('home-hero.edit') }}" class="btn btn-outline-secondary btn-sm mb-1">
                    تعديل الهيرو
                </a>
                <a href="{{ route('setting') }}" class="btn btn-outline-dark btn-sm mb-1">
                    الإعدادات
                </a>
            </div>
        </div>
    </div>

</div>

</div>
</div>
@endsection
