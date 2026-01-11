@extends('layouts.master')
@section('title','الخدمات')
@section('style')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 46px;
        height: 24px;
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
        background-color: #dc3545;
        /* OFF */
        transition: .3s;
        border-radius: 30px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .3s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: #28a745;
        /* ON */
    }

    input:checked+.slider:before {
        transform: translateX(22px);
    }

    input:disabled+.slider {
        opacity: .6;
        cursor: not-allowed;
    }
</style>
@endsection

@section('content')
<div class="app-content content">
    <div class="content-wrapper">

        <div class="d-flex justify-content-between mb-2">
            <h3>الخدمات</h3>
            <a href="{{ route('home-services.create') }}" class="btn btn-primary">
                إضافة خدمة
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th width="60">الترتيب</th>
                    <th width="60">العرض</th>
                    <th>العنوان</th>
                    <th width="120">الحالة</th>
                    <th width="160">إجراءات</th>
                </tr>
            </thead>

            <tbody id="sortable">
                @foreach($services as $service)
                <tr data-id="{{ $service->id }}">

                    {{-- SORT --}}
                    <td style="cursor: move">☰</td>

                    {{-- ICON / IMAGE --}}
                    <td class="text-center">
                        @if($service->image)
                        <img src="{{ asset('storage/'.$service->image) }}"
                            width="120">
                        @elseif($service->icon)
                        <i class="{{ $service->icon }} fa-2x"></i>
                        @endif
                    </td>

                    {{-- TITLE --}}
                    <td>{{ $service->getTranslation('title','ar') }}</td>

                    {{-- ACTIVE SWITCH --}}
                    <td class="text-center">
                        <label class="switch">
                            <input type="checkbox"
                                class="service-status"
                                data-id="{{ $service->id }}"
                                {{ $service->is_active ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </td>


                    {{-- ACTIONS --}}
                    <td>
                        <a href="{{ route('home-services.edit',$service) }}"
                            class="btn btn-sm btn-info">تعديل</a>

                        <form method="POST"
                            action="{{ route('home-services.destroy',$service) }}"
                            class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('حذف؟')">
                                حذف
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
@section('script')

<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
Sortable.create(document.getElementById('sortable'), {
    animation: 150,
    onEnd() {
        let order = [];

        document.querySelectorAll('#sortable tr').forEach(row => {
            order.push(row.dataset.id);
        });

        fetch('{{ route('home-services.sort') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ order })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status) {
                toast(data.message, 'success');
            } else {
                toast('فشل تحديث الترتيب', 'error');
            }
        })
        .catch(() => {
            toast('حدث خطأ أثناء حفظ الترتيب', 'error');
        });
    }
});

document.querySelectorAll('.service-status').forEach(input => {
    input.addEventListener('change', function () {

        this.disabled = true; // منع التكرار

        fetch(`/dashboard/home-services/${this.dataset.id}/toggle`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            toast(data.message, 'success');
            this.disabled = false;
        })
        .catch(() => {
            toast('فشل تحديث الحالة', 'error');
            this.checked = !this.checked; // rollback
            this.disabled = false;
        });
    });
});

function toast(message, type = 'success') {
    Toastify({
        text: message,
        duration: 2500,
        gravity: "top",
        position: "right",
        backgroundColor: type === 'success'
            ? "#28a745"
            : "#dc3545"
    }).showToast();
}
</script>
@endsection
