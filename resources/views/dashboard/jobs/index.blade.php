@extends('layouts.master')

@section('title', 'الوظائف')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 fw-bold">الوظائف</h1>
            <p class="text-muted mb-0">إدارة الوظائف المنشورة في الموقع</p>
        </div>

        <a href="{{ route('dashboard.jobs.create') }}"
            class="btn btn-primary d-flex align-items-center gap-2">
            <i class="fas fa-plus"></i>
            إضافة وظيفة
        </a>
    </div>

    {{-- CARD --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="60" class="ps-4">#</th>
                            <th>عنوان الوظيفة</th>
                            <th width="220">فترة النشر</th>
                            <th width="140" class="text-center">طلبات التقديم</th>
                            <th width="120" class="text-center">الحالة</th>
                            <th width="120" class="text-center pe-4">إجراءات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($jobs as $key => $job)
                        <tr>

                            {{-- ID --}}
                            <td class="fw-semibold text-muted ps-4">
                                #{{ $key + 1 }}
                            </td>

                            {{-- TITLE --}}
                            <td>
                                <div class="fw-bold text-dark">
                                    {{ $job->getTranslation('title','ar') }}
                                </div>
                                <div class="text-muted small mt-1">
                                    {{ $job->getTranslation('title','en') }}
                                </div>
                            </td>

                            {{-- DATES --}}
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="d-flex align-items-center gap-1">
                                        <i class="fas fa-play text-muted" style="font-size: 0.7rem"></i>
                                        <span class="small">{{ $job->publish_from->format('Y-m-d') }}</span>
                                    </span>
                                    <span class="d-flex align-items-center gap-1 mt-1">
                                        <i class="fas fa-stop text-muted" style="font-size: 0.7rem"></i>
                                        <span class="small text-muted">
                                            {{ $job->publish_to?->format('Y-m-d') ?? 'لا نهائي' }}
                                        </span>
                                    </span>
                                </div>
                            </td>
                            
                            {{-- APPLICATIONS COUNT --}}
                            <td class="text-center">
                                <a href="{{ route('dashboard.jobs.applications.index', $job) }}"
                                   class="badge bg-info text-decoration-none">
                                    {{ $job->applications_count }} طلب
                                </a>
                            </td>

                            {{-- STATUS TOGGLE --}}
                            <td>
                            <input type="checkbox" data-id="{{ $job->id }}" name="status" class="js-switch" {{ $job->is_active == 1 ? 'checked' : '' }}>
                            </td>

                            {{-- ACTIONS --}}
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Edit --}}
                                    <a href="{{ route('dashboard.jobs.edit', $job) }}"
                                        class="btn btn-sm btn-outline-primary btn-icon"
                                        title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Delete Form --}}
                                    <form method="POST" 
                                          action="{{ route('dashboard.jobs.destroy', $job) }}"
                                          class="d-inline js-delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="btn btn-sm btn-outline-danger btn-icon js-delete-btn"
                                            title="حذف"
                                            data-title="{{ $job->getTranslation('title','ar') }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6"
                                class="text-center py-5 text-muted">
                                <div class="py-4">
                                    <i class="fas fa-briefcase fa-2x mb-3 text-light"></i>
                                    <p class="mb-0">لا يوجد وظائف حالياً</p>
                                    <a href="{{ route('dashboard.jobs.create') }}" class="btn btn-sm btn-primary mt-3">
                                        إضافة وظيفة جديدة
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- PAGINATION --}}
            @if($jobs->hasPages())
            <div class="card-footer border-top-0">
                <div class="d-flex justify-content-center">
                    {{ $jobs->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection

@section('style')
<style>
    /* ===== تحسين التبديل Toggle Switch ===== */
    .switch {
        position: relative;
        display: inline-block;
        width: 52px;
        height: 28px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        inset: 0;
        background-color: #e9ecef;
        border: 2px solid #dee2e6;
        transition: .4s;
        border-radius: 34px;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 3px;
        bottom: 2px;
        background-color: #fff;
        transition: .4s;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    input:checked + .slider {
        background-color: #198754;
        border-color: #198754;
    }

    input:checked + .slider:before {
        transform: translateX(22px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* ===== تحسين الأزرار ===== */
    .btn-icon {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .btn-icon:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-outline-primary {
        border-color: #4361ee;
        color: #4361ee;
    }

    .btn-outline-primary:hover {
        background-color: #4361ee;
        border-color: #4361ee;
        color: white;
    }

    .btn-outline-danger {
        border-color: #ef4444;
        color: #ef4444;
    }

    .btn-outline-danger:hover {
        background-color: #ef4444;
        border-color: #ef4444;
        color: white;
    }

    /* ===== تحسين الجدول ===== */
    .table-hover tbody tr {
        transition: all 0.2s ease;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transform: translateX(2px);
    }

    .table td,
    .table th {
        padding: 1rem;
        vertical-align: middle;
    }

    /* ===== تحسين البادجات ===== */
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }

    /* ===== رسالة عدم وجود بيانات ===== */
    .text-center .fa-briefcase {
        color: #e9ecef !important;
    }
    
    /* ===== تحسين التفعيل/الإلغاء ===== */
    .status-badge {
        min-width: 70px;
        font-size: 0.75rem;
    }
</style>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // ===== دالة عرض الرسائل =====
        function showToast(message, type = 'info') {
            if (typeof Swal !== 'undefined') {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-start',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });

                Toast.fire({
                    icon: type,
                    title: message
                });
            } else {
                alert(message);
            }
        }

        $(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        const jobId = $(this).data('id');
        
        $.ajax({
            type: "GET",
            dataType: "json",
            url: `/dashboard/jobs/${jobId}/toggle`,  // لاحظ backticks بدلاً من quotes
            data: {
                'status': status, 
                'id': jobId
            },
            success: function (data) {
                console.log(data.message);
                if(data.success) {
                    // يمكنك إضافة رسالة نجاح
                    showToast(data.message, 'success');
                }
            },
            error: function (xhr) {
                console.error('Error:', xhr.responseText);
                showToast('حدث خطأ في تغيير الحالة', 'error');
                // إعادة الحالة السابقة
                $(this).prop('checked', !$(this).prop('checked'));
            }
        });
    });
});    // ===== تبديل حالة الوظيفة =====
        document.querySelectorAll('.js-job-toggle').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const jobId = this.dataset.id;
                const isActive = this.checked ? 1 : 0;
                const statusBadge = document.getElementById(`job-status-${jobId}`);
                const originalState = this.checked;
                
                console.log('Toggling job:', jobId, 'to:', isActive);

                // إرسال الطلب للخادم باستخدام مسار مطلق
                fetch(`/dashboard/jobs/${jobId}/toggle`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        is_active: isActive,
                        _method: 'PATCH'
                    })
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    
                    if (data.success) {
                        // تحديث البادج
                        if (statusBadge) {
                            if (data.is_active) {
                                statusBadge.textContent = 'نشط';
                                statusBadge.className = 'badge bg-success mt-1';
                                statusBadge.style.fontSize = '0.7rem';
                            } else {
                                statusBadge.textContent = 'غير نشط';
                                statusBadge.className = 'badge bg-danger mt-1';
                                statusBadge.style.fontSize = '0.7rem';
                            }
                        }
                        
                        // إظهار رسالة نجاح
                        showToast(data.message || 'تم تغيير الحالة بنجاح', 'success');
                    } else {
                        // إعادة الحالة السابقة إذا فشل الخادم
                        this.checked = !originalState;
                        showToast(data.message || 'حدث خطأ', 'error');
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    // إعادة الحالة السابقة عند الخطأ
                    this.checked = !originalState;
                    
                    if (statusBadge) {
                        statusBadge.textContent = originalState ? 'نشط' : 'غير نشط';
                        statusBadge.className = originalState ? 'badge bg-success mt-1' : 'badge bg-danger mt-1';
                        statusBadge.style.fontSize = '0.7rem';
                    }
                    
                    showToast('حدث خطأ في الاتصال بالخادم', 'error');
                });
            });
        });

        // ===== حذف الوظيفة =====
        document.querySelectorAll('.js-delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                const title = this.dataset.title;
                const form = this.closest('.js-delete-form');

                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    html: `سيتم حذف الوظيفة:<br><strong>${title}</strong><br><small class="text-danger">لا يمكن التراجع عن هذا الإجراء</small>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم، احذف',
                    cancelButtonText: 'إلغاء',
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6c757d',
                    reverseButtons: true,
                    backdrop: true,
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // عرض مؤشر التحميل
                        Swal.fire({
                            title: 'جاري الحذف...',
                            text: 'يرجى الانتظار',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        // إرسال النموذج
                        form.submit();
                    }
                });
            });
        });

        // ===== إضافة تأثيرات تفاعلية للجدول =====
        const tableRows = document.querySelectorAll('.table-hover tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.08)';
                this.style.backgroundColor = '#f8f9fa';
            });

            row.addEventListener('mouseleave', function() {
                this.style.boxShadow = 'none';
                this.style.backgroundColor = '';
            });
        });

        // ===== عرض رسائل من الجلسة إذا وجدت =====
        @if(session('success'))
            showToast('{{ session('success') }}', 'success');
        @endif
        
        @if(session('error'))
            showToast('{{ session('error') }}', 'error');
        @endif
        
        @if(session('info'))
            showToast('{{ session('info') }}', 'info');
        @endif

    });
</script>
@endsection