@extends('layouts.master')

@section('title','إضافة دور')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold mb-4">إضافة دور جديد</h4>
    @include('dashboard.inc.alerts')

    <form method="POST" action="{{ route('dashboard.roles.store') }}">
        @csrf

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">اسم الدور</label>
                    <input type="text" name="name"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="fw-bold mb-2">الصلاحيات</label>
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-3">
                                <label class="form-check">
                                    <input type="checkbox"
                                           name="permissions[]"
                                           value="{{ $permission->name }}"
                                           class="form-check-input">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button class="btn btn-success">
                    حفظ الدور
                </button>

            </div>
        </div>
    </form>

</div>
@endsection
