@extends('layouts.master')
@section('title','تفاصيل رسالة التواصل')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 mb-1">تفاصيل الرسالة</h1>
            <p class="text-muted mb-0">معلومات الرسالة المرسلة من العميل</p>
        </div>

        <a href="{{ route('dashboard.contacts.index') }}"
           class="btn btn-outline-secondary">
            <i class="fas fa-arrow-right me-1"></i> رجوع
        </a>
    </div>

    <div class="row">
        {{-- Info --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h6 class="mb-3 fw-bold">معلومات المرسل</h6>

                    <div class="mb-2">
                        <small class="text-muted">الاسم</small>
                        <div class="fw-semibold">{{ $contactMessage->name }}</div>
                    </div>

                    <div class="mb-2">
                        <small class="text-muted">البريد الإلكتروني</small>
                        <div>{{ $contactMessage->email }}</div>
                    </div>

                    <div class="mb-2">
                        <small class="text-muted">الشركة</small>
                        <div>{{ $contactMessage->company ?? '—' }}</div>
                    </div>

                    <div class="mb-2">
                        <small class="text-muted">نوع الاستفسار</small>
                        <div>
                            <span class="badge bg-info text-dark">
                                {{ $contactMessage->inquiry_type ?? '—' }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <small class="text-muted">تاريخ الإرسال</small>
                        <div>{{ $contactMessage->created_at->format('Y-m-d H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Message --}}
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">نص الرسالة</h6>

                    <div class="p-3 rounded bg-light text-dark" style="white-space: pre-line;">
                        {{ $contactMessage->message }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
