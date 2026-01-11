@extends('layouts.master')

@section('title', __('عرض الرسالة'))

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('عرض الرسالة') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('الرئيسية') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('contact-messages.index') }}">{{ __('طلبات من نحن') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('عرض') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <section class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('تفاصيل الرسالة') }}</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>{{ __('الاسم') }}:</strong> {{ $message->name }}</li>
                        <li class="list-group-item"><strong>{{ __('البريد الإلكتروني') }}:</strong> {{ $message->email }}</li>
                        <li class="list-group-item"><strong>{{ __('رقم الهاتف') }}:</strong> {{ $message->phone }}</li>
                        <li class="list-group-item"><strong>{{ __('الموضوع') }}:</strong> {{ $message->subject }}</li>
                        <li class="list-group-item"><strong>{{ __('الرسالة') }}:</strong><br>{{ $message->message }}</li>
                        <li class="list-group-item"><strong>{{ __('الحالة') }}:</strong>
                            @if($message->is_read)
                                <span class="badge badge-success">{{ __('مقروء') }}</span>
                            @else
                                <span class="badge badge-warning">{{ __('غير مقروء') }}</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
