@extends('layouts.master')

@section('title','إضافة / تعديل صلاحية')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold mb-4">
        {{ isset($permission) ? 'تعديل صلاحية' : 'إضافة صلاحية' }}
    </h4>
    @include('dashboard.inc.alerts')

    <form method="POST"
          action="{{ isset($permission)
                ? route('dashboard.permissions.update',$permission)
                : route('dashboard.permissions.store') }}">
        @csrf
        @isset($permission)
            @method('PUT')
        @endisset

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="mb-3">
                    <label>اسم الصلاحية</label>
                    <input name="name"
                           value="{{ $permission->name ?? '' }}"
                           class="form-control" required>
                </div>

                <button class="btn btn-success">
                    حفظ
                </button>

            </div>
        </div>
    </form>

</div>
@endsection
