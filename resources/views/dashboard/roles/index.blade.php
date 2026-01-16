@extends('layouts.master')

@section('title','إدارة الأدوار')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">إدارة الأدوار</h4>

        <a href="{{ route('dashboard.roles.create') }}" class="btn btn-primary">
            <i class="la la-plus"></i> إضافة دور
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
        @include('dashboard.inc.alerts')

            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>اسم الدور</th>
                        <th>الصلاحيات</th>
                        <th width="120">إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $role->name }}</td>
                            <td>
                                @foreach($role->permissions as $permission)
                                    <span class="badge bg-info mb-1">
                                        {{ $permission->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('dashboard.roles.edit',$role) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="la la-edit"></i>
                                </a>
                                <form action="{{ route('dashboard.roles.destroy', $role) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('هل أنت متأكد من حذف هذا الدور')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm btn-outline-danger"
                                title="حذف">
                                <i class="la la-trash"></i>
                            </button>
                        </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $roles->links() }}
        </div>
    </div>

</div>
@endsection
