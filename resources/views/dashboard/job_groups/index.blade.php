@extends('layouts.master')

@section('title', 'العناوين الرئيسية للوظائف')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1 fw-bold">العناوين الرئيسية للوظائف</h1>
                <p class="text-muted mb-0">إدارة المجموعات الرئيسية التي تتفرع منها الوظائف</p>
            </div>

            <a href="{{ route('dashboard.job-groups.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-plus"></i>
                إضافة عنوان رئيسي
            </a>
        </div>

        {{-- CARD --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    @include('dashboard.inc.alerts')

                    <table class="table table-borderless align-middle job-groups-table mb-0">
                        <thead>
                            <tr>
                                <th width="60"></th>
                                <th>العنوان الرئيسي</th>
                                <th width="140" class="text-center">الوظائف</th>
                                <th width="120" class="text-center">الحالة</th>
                                <th width="120" class="text-center">إجراءات</th>
                            </tr>
                        </thead>
                    
                        <tbody id="sortable-groups">
                            @forelse($groups as $group)
                            <tr data-id="{{ $group->id }}" class="group-row">
                    
                                {{-- Drag --}}
                                <td class="text-center">
                                    <span class="drag-handle">
                                        <i class="fas fa-grip-lines"></i>
                                    </span>
                                </td>
                    
                                {{-- Title --}}
                                <td>
                                    <div class="group-title">
                                        <div class="title-ar">
                                            {{ $group->getTranslation('title','ar') }}
                                        </div>
                                        <div class="title-en">
                                            {{ $group->getTranslation('title','en') }}
                                        </div>
                                    </div>
                                </td>
                    
                                {{-- Jobs Count --}}
                                <td class="text-center">
                                    <span class="badge badge-soft-info">
                                        {{ $group->jobs_count }} وظيفة
                                    </span>
                                </td>
                    
                              
                                {{-- Status Switch --}}
                                <td class="text-center">
                                    <label class="switch">
                                        <input type="checkbox"
                                               class="js-group-switch"
                                               data-id="{{ $group->id }}"
                                               {{ $group->is_active ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                    
                                {{-- Actions --}}
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('dashboard.job-groups.edit', $group) }}"
                                           class="btn btn-sm btn-light btn-icon"
                                           title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                    
                                        <form method="POST"
                                              action="{{ route('dashboard.job-groups.destroy', $group) }}"
                                              class="d-inline js-delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    class="btn btn-sm btn-light btn-icon text-danger js-delete-btn"
                                                    data-title="{{ $group->getTranslation('title','ar') }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                    
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    لا يوجد عناوين رئيسية
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>

                @if ($groups->hasPages())
                    <div class="card-footer border-top-0">
                        <div class="d-flex justify-content-center">
                            {{ $groups->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection

@section('style')
    <style>
        .btn-icon {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all .2s ease;
        }

        .btn-icon:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, .1)
        }

        .table-hover tbody tr {
            transition: all .2s ease
        }

        .table-hover tbody tr:hover {
            background: #f8f9fa;
            transform: translateX(2px)
        }

        .table td,
        .table th {
            padding: 1rem;
            vertical-align: middle
        }
        .drag-handle {
            cursor: grab;
        }

        .sortable-ghost {
            opacity: 0.4;
        }
        /* ===== Table ===== */
.job-groups-table {
    border-collapse: separate;
    border-spacing: 0 10px;
}

.job-groups-table tbody tr {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,.05);
    transition: all .25s ease;
}

.job-groups-table tbody tr:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(0,0,0,.08);
}

/* ===== Drag Handle ===== */
.drag-handle {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f9;
    border-radius: 10px;
    cursor: grab;
    color: #64748b;
}

.group-row:hover .drag-handle {
    background: #e2e8f0;
}

/* ===== Title ===== */
.group-title .title-ar {
    font-weight: 700;
    color: #0f172a;
}

.group-title .title-en {
    font-size: 12px;
    color: #64748b;
    margin-top: 2px;
}

/* ===== Badges ===== */
.badge-soft-info {
    background: rgba(59,130,246,.1);
    color: #2563eb;
    padding: 6px 12px;
    border-radius: 999px;
}

.badge-soft-secondary {
    background: #f1f5f9;
    color: #334155;
    padding: 6px 12px;
    border-radius: 999px;
}

/* ===== Buttons ===== */
.btn-icon {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* ===== Switch ===== */
.switch {
    position: relative;
    display: inline-block;
    width: 46px;
    height: 26px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    inset: 0;
    background-color: #e5e7eb;
    border-radius: 999px;
    transition: .3s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    border-radius: 50%;
    transition: .3s;
    box-shadow: 0 2px 6px rgba(0,0,0,.2);
}

.switch input:checked + .slider {
    background-color: #22c55e;
}

.switch input:checked + .slider:before {
    transform: translateX(20px);
}

    </style>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Toggle Group Status (AJAX) - GET مثل أسلوبك
            $(document).ready(function() {
                $('.js-group-switch').change(function() {
                    const el = $(this);
                    const groupId = el.data('id');
                    const status = el.prop('checked') ? 1 : 0;
                    const oldState = !el.prop('checked');

                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: `/dashboard/job-groups/${groupId}/toggle`,
                        data: {
                            status: status,
                            id: groupId
                        },
                        success: function(data) {
                            if (data.success) {
                                if (typeof showToast === 'function') showToast(data
                                    .message, 'success');
                            } else {
                                el.prop('checked', oldState);
                                if (typeof showToast === 'function') showToast(
                                    'تعذر تغيير الحالة', 'error');
                            }
                        },
                        error: function() {
                            el.prop('checked', oldState);
                            if (typeof showToast === 'function') showToast(
                                'حدث خطأ في الاتصال بالخادم', 'error');
                        }
                    });
                });
            });

            // Delete confirm
            document.querySelectorAll('.js-delete-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const title = this.dataset.title;
                    const form = this.closest('.js-delete-form');

                    Swal.fire({
                        title: 'هل أنت متأكد؟',
                        html: `سيتم حذف العنوان:<br><strong>${title}</strong><br><small class="text-danger">لا يمكن التراجع عن هذا الإجراء</small>`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'نعم، احذف',
                        cancelButtonText: 'إلغاء',
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6c757d',
                        reverseButtons: true,
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        
            const tableBody = document.getElementById('sortable-groups');
        
            if (tableBody) {
                new Sortable(tableBody, {
                    animation: 150,
                    handle: '.drag-handle',
                    ghostClass: 'sortable-ghost',
                    onEnd: function () {
        
                        let orders = [];
                        tableBody.querySelectorAll('tr').forEach((row, index) => {
                            orders.push({
                                id: row.dataset.id,
                                order: index + 1
                            });
                        });
        
                        fetch('{{ route('dashboard.job-groups.reorder') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ orders })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                if (typeof showToast === 'function') {
                                    showToast(data.message, 'success');
                                }
                            } else {
                                showToast('فشل تحديث الترتيب', 'error');
                            }
                        })
                        .catch(() => {
                            showToast('حدث خطأ أثناء حفظ الترتيب', 'error');
                        });
                    }
                });
            }
        
        });
        </script>
        
@endsection
