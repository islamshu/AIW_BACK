@extends('layouts.frontend')
@section('title', 'الرئيسية')
@section('content')
@foreach (App\Models\HomeSection::where('is_active', true)->orderBy('order')->get() as $section)
    @includeIf(
        'frontend.sections.' . $section->key,
        [
            'section' => $section,
            'data' => $section->contentable
        ]
    )    @endforeach
@endsection
