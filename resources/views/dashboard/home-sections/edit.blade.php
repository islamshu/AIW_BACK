@extends('layouts.master')

@section('title','تعديل السكشن')

@section('style')
<style>
    .lang-tabs .nav-link {
        font-weight: 600;
    }

    .lang-tabs .nav-link.active {
        background: #0d6efd;
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="mb-1">
            {{ $meta['icon'] ?? '' }} {{ $meta['label'] }}
        </h3>
        <small class="text-muted">
            تعديل محتوى السكشن
        </small>
    </div>

    {{-- LANGUAGE TABS --}}
    <ul class="nav nav-tabs lang-tabs mb-3">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-ar">
                🇵🇸 عربي
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-en">
                🇬🇧 English
            </button>
        </li>
    </ul>

    {{-- FORM --}}
    <form method="POST" action="{{ route('dashboard.home-sections.update', $section) }}">
        @csrf
        @method('PUT')

        <div class="tab-content">

            {{-- AR --}}
            <div class="tab-pane fade show active" id="tab-ar">
                @includeIf('dashboard.home-sections.forms.' . $section->key . '-ar')
            </div>

            {{-- EN --}}
            <div class="tab-pane fade" id="tab-en">
                @includeIf('dashboard.home-sections.forms.' . $section->key . '-en')
            </div>

        </div>

        {{-- SAVE --}}
        <div class="mt-4">
            <button class="btn btn-primary px-4">
                <i class="fas fa-save"></i> حفظ التغييرات
            </button>

            <a href="{{ route('dashboard.home-sections.index') }}" class="btn btn-light">
                رجوع
            </a>
        </div>

    </form>

</div>
@endsection
