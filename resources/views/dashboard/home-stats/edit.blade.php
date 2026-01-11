@extends('layouts.master')
@section('title','إحصائيات الصفحة الرئيسية')

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
</style>
@endsection

@section('content')
<div class="app-content content">
<div class="content-wrapper">

<div class="d-flex justify-content-between mb-3">
    <div>
        <h3 class="mb-0">إحصائيات الصفحة الرئيسية</h3>
        <small class="text-muted">إضافة – حذف – ترتيب – تفعيل</small>
    </div>
    <button type="button" class="btn btn-primary" onclick="addRow()">
        إضافة عنصر
    </button>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('home-stats.update') }}" id="statsForm">
@csrf

<table class="table table-bordered align-middle">
<thead>
<tr>
    <th width="60">ترتيب</th>
    <th width="140">القيمة</th>
    <th>النص (عربي)</th>
    <th>النص (إنجليزي)</th>
    <th width="70">حذف</th>
</tr>
</thead>

<tbody id="sortable">
@foreach($stats as $index => $stat)
<tr class="stat-row">
    <td style="cursor:move">☰</td>

    <td>
        <input type="text" class="form-control"
               data-field="value"
               value="{{ $stat->value }}">
    </td>

    <td>
        <input type="text" class="form-control"
               data-field="label.ar"
               value="{{ $stat->getTranslation('label','ar') }}">
    </td>

    <td>
        <input type="text" class="form-control"
               data-field="label.en"
               value="{{ $stat->getTranslation('label','en') }}">
    </td>

    

    <td class="text-center">
    <button type="button"
        class="btn btn-sm btn-danger"
        onclick="confirmDelete(this)">
    ×
</button>

    </td>
</tr>
@endforeach
</tbody>
</table>

<button class="btn btn-success mt-2">حفظ التغييرات</button>
</form>

</div>
</div>


@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
/* Toast */
function toast(msg, type='success'){
    Toastify({
        text: msg,
        duration: 2200,
        gravity: "top",
        position: "right",
        backgroundColor: type === 'success' ? '#28a745' : '#dc3545'
    }).showToast();
}

/* إعادة ترقيم الحقول */
function reindexRows(){
    document.querySelectorAll('.stat-row').forEach((row, i) => {
        row.querySelectorAll('[data-field]').forEach(el => {
            const f = el.dataset.field;
            if(f === 'value') el.name = `stats[${i}][value]`;
            if(f === 'label.ar') el.name = `stats[${i}][label][ar]`;
            if(f === 'label.en') el.name = `stats[${i}][label][en]`;
        });
    });
}

/* Drag & Drop */
Sortable.create(document.getElementById('sortable'), {
    animation: 150,
    onEnd(){
        reindexRows();
        toast('تم تغيير الترتيب ولكن لا تنسى الضغط على حفظ التغيرات');
    }
});

/* إضافة صف */
function addRow(){
    const tbody = document.getElementById('sortable');
    const row = document.createElement('tr');
    row.className = 'stat-row';
    row.innerHTML = `
        <td style="cursor:move">☰</td>
        <td><input type="text" class="form-control" data-field="value"></td>
        <td><input type="text" class="form-control" data-field="label.ar"></td>
        <td><input type="text" class="form-control" data-field="label.en"></td>
       
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-danger"
                    onclick="askDelete(this)">×</button>
        </td>
    `;
    tbody.appendChild(row);
    reindexRows();
    toast('تمت إضافة عنصر');
}

/* حذف مع تأكيد */
let rowToDelete = null;



document.getElementById('confirmDeleteBtn').addEventListener('click', function(){
    if(!rowToDelete) return;
    rowToDelete.remove();
    reindexRows();
    toast('تم حذف العنصر');
    bootstrap.Modal.getInstance(
        document.getElementById('deleteConfirmModal')
    ).hide();
});

/* قبل الإرسال */
document.getElementById('statsForm').addEventListener('submit', reindexRows);

/* أول تحميل */
reindexRows();

</script>
<script>
function confirmDelete(btn) {
    if (!confirm('هل أنت متأكد من حذف هذا العنصر؟')) {
        return;
    }

    // حذف الصف
    btn.closest('tr').remove();

    // إعادة ترتيب أسماء الحقول
    reindexRows();

    // إشعار
    toast('تم حذف العنصر بنجاح ولكن لا تنسى الضغط على حفظ التغيرات');
}
</script>

@endsection
