@extends('layouts.master')

@section('title', 'طلبات التقديم')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 fw-bold mb-1">
                طلبات التقديم – {{ $job->getTranslation('title','ar') }}
            </h1>
            <p class="text-muted mb-0">
                عدد الطلبات: {{ $applications->total() }}
            </p>
        </div>

        <a href="{{ route('dashboard.jobs.index') }}"
           class="btn btn-light">
            <i class="fas fa-arrow-right me-1"></i>
            رجوع للوظائف
        </a>
    </div>

    {{-- Table --}}
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>رقم الهاتف</th>
                        <th>السيرة الذاتية</th>
                        <th>تاريخ التقديم</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($applications as $key => $app)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="fw-semibold">{{ $app->name }}</td>
                            <td>{{ $app->phone }}</td>
                            <td>
                                <a href="{{ asset('storage/'.$app->cv_path) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-file-pdf"></i>
                                    عرض CV
                                </a>
                            </td>
                            <td class="text-muted">
                                {{ $app->created_at->format('Y-m-d H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="text-center text-muted py-4">
                                لا يوجد طلبات تقديم لهذه الوظيفة
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($applications->hasPages())
            <div class="card-footer">
                {{ $applications->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
