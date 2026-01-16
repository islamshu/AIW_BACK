@extends('layouts.master')

@section('title','تعديل دور')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold mb-4">تعديل الدور</h4>
    @include('dashboard.inc.alerts')

    <form method="POST"
        action="{{ route('dashboard.roles.update',$role) }}">
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="mb-3">

                    <label>اسم الدور</label>
                    <input name="name"
                        value="{{ $role->name }}"
                        class="form-control" @if($role->name == 'الادارة') disabled title="لا يمكن تعديل هذه الصلاحية"  @endif required>
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
                                    class="form-check-input"
                                    {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                {{ $permission->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <button class="btn btn-success">
                    تحديث الدور
                </button>

            </div>
        </div>
    </form>

</div>
@endsection