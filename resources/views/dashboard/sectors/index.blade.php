@extends('layouts.master')
@section('title','القطاعات')

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

    input:checked + .slider {
        background-color: #28a745;
    }

    input:checked + .slider:before {
        transform: translateX(22px);
    }

    input:disabled + .slider {
        opacity: .6;
        cursor: not-allowed;
    }
</style>
@endsection

@section('content')
<div class="app-content content">
<div class="content-wrapper">

<div class="d-flex justify-content-between mb-2">
    <h3>القطاعات</h3>
    <a href="{{ route('sectors.create') }}" class="btn btn-primary">
        إضافة قطاع
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered align-middle">
<thead>
<tr>
    <th width="60">الترتيب</th>
    <th width="80">العرض</th>
    <th>العنوان</th>
    <th width="120">الحالة</th>
    <th width="160">إجراءات</th>
</tr>
</thead>

<tbody id="sortable">
@foreach($sectors as $sector)
<tr data-id="{{ $sector->id }}">

    {{-- الترتيب --}}
    <td style="cursor: move">☰</td>

    {{-- أيقونة / صورة --}}
    <td class="text-center">
        @if($sector->image)
            <img src="{{ asset('storage/'.$sector->image) }}" width="120">
        @elseif($sector->icon)
            <i class="{{ $sector->icon }} fa-2x"></i>
        @endif
    </td>

    {{-- العنوان --}}
    <td>{{ optional($sector)->getTranslation('title','ar') }}</td>

    {{-- الحالة --}}
    <td class="text-center">
        <label class="switch">
            <input type="checkbox"
                   class="sector-status"
                   data-id="{{ $sector->id }}"
                   {{ $sector->is_active ? 'checked' : '' }}>
            <span class="slider"></span>
        </label>
    </td>

    {{-- الإجراءات --}}
    <td>
        <a href="{{ route('sectors.edit',$sector) }}"
           class="btn btn-sm btn-info">تعديل</a>

        <form method="POST"
              action="{{ route('sectors.destroy',$sector) }}"
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
/* ===== الترتيب ===== */
Sortable.create(document.getElementById('sortable'), {
    animation: 150,
    onEnd() {
        let order = [];
        document.querySelectorAll('#sortable tr').forEach(row => {
            order.push(row.dataset.id);
        });

        fetch('{{ route('sectors.sort') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ order })
        })
        .then(res => res.json())
        .then(data => {
            toast(data.message, 'success');
        })
        .catch(() => {
            toast('حدث خطأ أثناء حفظ الترتيب', 'error');
        });
    }
});

/* ===== التفعيل / التعطيل ===== */
document.querySelectorAll('.sector-status').forEach(input => {
    input.addEventListener('change', function () {

        this.disabled = true;

        fetch(`/dashboard/sectors/${this.dataset.id}/toggle`, {
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
            this.checked = !this.checked;
            this.disabled = false;
        });
    });
});

/* ===== Toast ===== */
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
