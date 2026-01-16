@extends('layouts.master')
@section('title','إدارة الصفحات')
@section('style')
<style>
table td, table th {
    padding: 14px;
    vertical-align: middle;
}

code {
    background: #f1f3f5;
    padding: 4px 6px;
    border-radius: 6px;
    font-size: 13px;
}

.btn-outline-danger:hover {
    background: #dc3545;
    color: #fff;
}
</style>
@endsection

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">إدارة الصفحات</h3>
            <small class="text-muted">جميع الصفحات الثابتة</small>
        </div>
        <a href="{{ route('dashboard.pages.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> صفحة جديدة
        </a>
    </div>

    <!-- Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">
                            <input type="checkbox" id="checkAll">
                        </th>
                        <th>العنوان</th>
                        <th>الرابط</th>
                        <th width="120">الحالة</th>
                        <th width="120">إجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pages as $page)
                    <tr id="row-{{ $page->id }}">
                        <td>
                            <input type="checkbox" class="row-checkbox">
                        </td>

                        <td>
                            <strong>{{ $page->title['ar'] ?? 'بدون عنوان' }}</strong><br>
                            <small class="text-muted">{{ $page->title['en'] ?? '' }}</small>
                        </td>

                        <td>
                            <code>/{{ $page->slug }}</code>
                        </td>

                        <td>
                            @if($page->status === 'published')
                                <span class="badge bg-success">منشور</span>
                            @else
                                <span class="badge bg-secondary">مسودة</span>
                            @endif
                        </td>

                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('dashboard.pages.edit',$page) }}"
                                   class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button type="button"
                                        class="btn btn-outline-danger js-delete"
                                        data-id="{{ $page->id }}"
                                        data-url="{{ route('dashboard.pages.destroy',$page) }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            لا توجد صفحات
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
@section('script')
<script>
(function(){

    // Select All
    const checkAll = document.getElementById('checkAll');
    if(checkAll){
        checkAll.addEventListener('change', function(){
            document.querySelectorAll('.row-checkbox')
                .forEach(cb => cb.checked = this.checked);
        });
    }

    // Delete page (AJAX)
    document.querySelectorAll('.js-delete').forEach(btn => {
        btn.addEventListener('click', function(){

            const id  = this.dataset.id;
            const url = this.dataset.url;

            if(!confirm('هل أنت متأكد من حذف الصفحة؟')) return;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: new URLSearchParams({
                    _method: 'DELETE'
                })
            })
            .then(res => {
                if(!res.ok) throw 'error';
                document.getElementById('row-'+id).remove();
            })
            .catch(() => {
                alert('حدث خطأ أثناء الحذف');
            });

        });
    });

})();
</script>
@endsection
