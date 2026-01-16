@extends('layouts.master')

@section('title','الصلاحيات')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between mb-4">
        <h4 class="fw-bold">إدارة الصلاحيات</h4>

        <a href="{{ route('dashboard.permissions.create') }}"
            class="btn btn-primary">
            <i class="la la-plus"></i> إضافة صلاحية
        </a>
    </div>

    <div class="card shadow-sm border-0">
    @include('dashboard.inc.alerts')

        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>اسم الصلاحية</th>
                    <th width="120">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>
                    <td class="text-center" width="120">
                        {{-- تعديل --}}
                        <a href="{{ route('dashboard.permissions.edit', $permission) }}"
                            class="btn btn-sm btn-outline-primary"
                            title="تعديل">
                            <i class="la la-edit"></i>
                        </a>

                        {{-- حذف --}}
                        <form action="{{ route('dashboard.permissions.destroy', $permission) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('هل أنت متأكد من حذف هذه الصلاحية؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm btn-outline-danger"
                                title="حذف">
                                <i class="la la-trash"></i>
                            </button>
                        </form>
                    </td>


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="card-footer">
            {{ $permissions->links() }}
        </div>
    </div>

</div>
@endsection