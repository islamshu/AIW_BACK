@extends('layouts.master')

@section('title', __('طلبات تواصل معنا'))

@section('style')
{{-- يمكن إعادة استخدام نفس الـ style المرسل سابقاً --}}
@endsection

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('طلبات من نحن') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('الرئيسية') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('طلبات من نحن') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <section class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('كل الطلبات') }}</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        @include('dashboard.inc.alerts')

                        <div id="messages-container">
                            @include('dashboard.contact_messages._table', ['messages' => $messages])
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
