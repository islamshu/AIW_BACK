@extends('layouts.master')
@section('title','طلبات التواصل')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 mb-1">طلبات التواصل</h1>
            <p class="text-muted mb-0">إدارة رسائل التواصل الواردة من الموقع</p>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد</th>
                        <th>نوع الاستفسار</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th class="text-center">الإجراء</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($messages as $msg)
                        <tr class="{{ !$msg->is_read ? 'table-warning' : '' }}">
                            <td class="fw-bold">#{{ $msg->id }}</td>

                            <td>
                                <div class="fw-semibold">{{ $msg->name }}</div>
                                @if(!$msg->is_read)
                                    <span class="badge bg-danger mt-1">جديد</span>
                                @endif
                            </td>

                            <td>{{ $msg->email }}</td>

                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $msg->inquiry_type ?? '—' }}
                                </span>
                            </td>

                            <td>
                                @if($msg->is_read)
                                    <span class="badge bg-success">تمت المشاهدة</span>
                                @else
                                    <span class="badge bg-secondary">غير مقروء</span>
                                @endif
                            </td>

                            <td class="text-muted">
                                {{ $msg->created_at->format('Y-m-d') }}
                            </td>

                            <td class="text-center">
                                <a href="{{ route('dashboard.contacts.show',$msg) }}"
                                   class="btn btn-sm btn-outline-primary me-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                            
                                <form action="{{ route('dashboard.contacts.destroy',$msg) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('هل أنت متأكد من حذف هذه الرسالة؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                لا يوجد رسائل حتى الآن
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="card-footer bg-white">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
