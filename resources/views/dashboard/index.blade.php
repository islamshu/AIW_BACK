@extends('layouts.master')
@section('title','لوحة التحكم')

@section('content')
<div class="app-content content">
<div class="content-wrapper">

    {{-- ================= HEADER ================= --}}
    <div class="content-header mb-4">
    <h3 class="fw-bold mb-1">لوحة التحكم</h3>
    <p class="text-muted mb-0">نظرة عامة على النظام</p>
</div>

{{-- ================= STATS CARDS (PERMISSIONS) ================= --}}
<div class="row g-3 mb-4">

    {{-- عدد الزيارات (إدارة النظام فقط) --}}
    @can('التحكم بالاعدادات الاساسية للنظام')
    <div class="col-md-3">
        <div class="card shadow-sm text-center h-100">
            <div class="card-body">
                <i class="la la-eye text-primary la-2x mb-2"></i>
                <h4 class="fw-bold mb-0">{{ $visits ?? 0 }}</h4>
                <small class="text-muted">عدد الزيارات</small>
            </div>
        </div>
    </div>
    @endcan

    {{-- إجمالي الخدمات --}}
    @can('التحكم باعدادات الصفحة الرئيسية')
    <div class="col-md-3">
        <div class="card shadow-sm text-center h-100">
            <div class="card-body">
                <i class="la la-cubes text-success la-2x mb-2"></i>
                <h4 class="fw-bold mb-0">{{ $servicesCount }}</h4>
                <small class="text-muted">إجمالي الخدمات</small>
            </div>
        </div>
    </div>
    @endcan

    {{-- إجمالي القطاعات --}}
    @can('التحكم باعدادات الصفحة الرئيسية')
    <div class="col-md-3">
        <div class="card shadow-sm text-center h-100">
            <div class="card-body">
                <i class="la la-th-large text-info la-2x mb-2"></i>
                <h4 class="fw-bold mb-0">{{ $sectorsCount }}</h4>
                <small class="text-muted">إجمالي القطاعات</small>
            </div>
        </div>
    </div>
    @endcan

    {{-- العناصر المفعلة --}}
    @canany(['التحكم باعدادات الصفحة الرئيسية','التحكم بالاعدادات الاساسية للنظام'])
    <div class="col-md-3">
        <div class="card shadow-sm text-center h-100">
            <div class="card-body">
                <i class="la la-check-circle text-warning la-2x mb-2"></i>
                <h4 class="fw-bold mb-0">{{ $activeServices + $activeSectors }}</h4>
                <small class="text-muted">العناصر المفعلة</small>
            </div>
        </div>
    </div>
    @endcanany

</div>


    {{-- ================= SYSTEM INFO + QUICK LINKS ================= --}}
    <div class="row g-3">

        {{-- SYSTEM INFO --}}
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header fw-bold">
                    <i class="la la-info-circle me-1"></i>
                    معلومات النظام
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        📅 آخر تحديث:
                        <strong>{{ now()->format('Y-m-d H:i') }}</strong>
                    </p>

                    <p class="mb-0">
                        ⚙️ حالة الموقع:
                        <span class="badge bg-success">يعمل</span>
                    </p>
                </div>
            </div>
        </div>

        {{-- QUICK ACTIONS --}}
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header fw-bold">
                    <i class="la la-bolt me-1"></i>
                    اختصارات سريعة
                </div>

                <div class="card-body d-flex flex-wrap gap-2">

                    @can('التحكم باعدادات الصفحة الرئيسية')
                    <a href="{{ route('home-services.index') }}" class="btn btn-outline-primary btn-sm"  style="height: 30px;">
                        الخدمات
                    </a>

                    <a href="{{ route('sectors.index') }}" class="btn btn-outline-info btn-sm"  style="height: 30px;">
                        القطاعات
                    </a>

                    <a href="{{ route('home-hero.edit') }}" class="btn btn-outline-secondary btn-sm"  style="height: 30px;">
                        الهيرو
                    </a>
                    @endcan

                    @can('التحكم بالاعدادات الاساسية للنظام')
                    <a href="{{ route('setting') }}" class="btn btn-outline-dark btn-sm"  style="height: 30px;">
                        الإعدادات
                    </a>
                    @endcan

                    @can('ادارة الصفحات')
                    <a href="{{ route('dashboard.pages.index') }}" class="btn btn-outline-success btn-sm"  style="height: 30px;">
                        الصفحات
                    </a>
                    @endcan

                    @can('ادارة الوظائف')
                    <a href="{{ route('dashboard.jobs.index') }}" class="btn btn-outline-warning btn-sm" style="height: 30px;">
                        الوظائف
                    </a>
                    @endcan

                </div>
            </div>
        </div>

    </div>

</div>
</div>
@endsection
