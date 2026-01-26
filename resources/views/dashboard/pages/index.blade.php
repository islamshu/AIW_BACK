@extends('layouts.master')
@section('title', 'إدارة الصفحات')

@section('style')
<style>
/* =======================
   GENERAL
======================= */
body {
    background: #f5f7fb;
}

.page-wrapper {
    padding: 24px;
}

h3 {
    font-weight: 700;
}

/* =======================
   TOP CARDS
======================= */
.page-card {
    background: #fff;
    border-radius: 16px;
    padding: 24px;
    position: relative;
    transition: .3s ease;
    border: 1px solid #eaecef;
    height: 100%;
}
.page-card.info {
    border-color: rgba(99,102,241,.25);
}

.page-card.info .icon {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
}

.page-card.info h5 {
    color: #4f46e5;
}

.page-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(0,0,0,.08);
}

.page-card .icon {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 20px;
    margin-bottom: 16px;
}

.page-card.primary .icon { background: #0d6efd; }
.page-card.success .icon { background: #198754; }
.page-card.danger  .icon { background: #dc3545; }

.page-card h5 {
    font-weight: 700;
    margin-bottom: 4px;
}

.page-card small {
    color: #6c757d;
}

.page-card .action {
    position: absolute;
    top: 16px;
    left: 16px;
}

.page-card .action a {
    color: #6c757d;
}

.page-card .action a:hover {
    color: #000;
}

/* =======================
   TABLE
======================= */
.table-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #eaecef;
}

.table thead {
    background: #f8f9fa;
}

.table td,
.table th {
    padding: 14px;
    vertical-align: middle;
}

code {
    background: #f1f3f5;
    padding: 4px 6px;
    border-radius: 6px;
    font-size: 13px;
}

/* =======================
   SWITCH
======================= */
.js-switch {
    cursor: pointer;
}

/* =======================
   ACTION BUTTONS
======================= */
.btn-group .btn {
    border-radius: 8px !important;
}
/* =======================
   SWITCH
======================= */
.switch {
    position: relative;
    display: inline-block;
    width: 44px;
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
    background-color: #dee2e6;
    border-radius: 34px;
    transition: .3s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    border-radius: 50%;
    transition: .3s;
}

.switch input:checked + .slider {
    background-color: #198754;
}

.switch input:checked + .slider:before {
    transform: translateX(20px);
}
/* =======================
   SECTOR SWITCH STYLE
======================= */

/* حاوية السويتش */
.page-card .page-action {
    position: absolute;
    top: 16px;
    left: 16px;
    z-index: 10;
    background: rgba(255, 255, 255, 0.9);
    padding: 6px 10px;
    border-radius: 999px;
    box-shadow: 0 6px 16px rgba(0,0,0,.12);
    backdrop-filter: blur(6px);
    transition: .3s ease;
}

.page-card:hover .page-action {
    transform: scale(1.05);
}

/* السويتش */
.switch {
    position: relative;
    display: inline-block;
    width: 42px;
    height: 22px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

/* الخلفية */
.slider {
    position: absolute;
    inset: 0;
    cursor: pointer;
    background-color: #dee2e6;
    border-radius: 999px;
    transition: .3s ease;
}

/* الدائرة */
.slider::before {
    content: "";
    position: absolute;
    height: 16px;
    width: 16px;
    left: 3px;
    top: 3px;
    background-color: white;
    border-radius: 50%;
    box-shadow: 0 2px 6px rgba(0,0,0,.25);
    transition: .3s ease;
}

/* الحالة مفعّل */
.switch input:checked + .slider {
    background-color: #198754;
}

.switch input:checked + .slider::before {
    transform: translateX(20px);
}

/* تأثير hover */
.switch:hover .slider {
    filter: brightness(0.95);
}

/* تغيير لون الكارد حسب الحالة */
.page-card.success {
    border-color: rgba(25,135,84,.25);
}
.page-card.warning {
    border-color: rgba(231, 108, 32, 0.25);
}
.page-card.warning .icon {
    background: #FF9149  !important;
}

.page-card.danger {
    border-color: rgba(220,53,69,.25);
    opacity: .9;
}
.page-card.danger .icon {
    background: #dc3545 !important;
}

.page-card.danger h5 {
    color: #dc3545;
}


</style>
@endsection

@section('content')
<div class="page-wrapper">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>إدارة الصفحات</h3>
            <small class="text-muted">جميع الصفحات الثابتة بالموقع</small>
        </div>
        <a href="{{ route('dashboard.pages.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> صفحة جديدة
        </a>
    </div>

    {{-- TOP CARDS --}}
    <div class="row g-4 mb-5">

        <div class="col-md-4">
            <div class="page-card primary">
                <div class="action">
                    <a href="{{ route('dashboard.home-sections.index') }}">
                        <i class="fas fa-cog"></i>
                    </a>
                </div>
                <div class="icon">
                    <i class="fas fa-home"></i>
                </div>
                <h5>الصفحة الرئيسية</h5>
                <small>/</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="page-card success" id="sector-card">
        
                {{-- SWITCH --}}
                <div class="page-action">
                    <label class="switch">
                        <input type="checkbox"
                               id="sectorSwitch"
                               {{ get_general_value('sectors_enabled') ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                </div>
        
                <div class="icon">
                    <i class="fas fa-industry"></i>
                </div>
        
                <h5>القطاعات</h5>
                <small>/sectors</small>
        
                <div id="sector-status-text" class="mt-2 text-muted small">
                    {{  get_general_value('sectors_enabled') ? 'نشط' : 'معطّل' }}
                </div>
        
            </div>
        </div>

        <div class="col-md-4">
            <div class="page-card warning" id="service-card">
        
                {{-- SWITCH --}}
                <div class="page-action">
                    <label class="switch">
                        <input type="checkbox"
                               id="serviceSwitch"
                               {{ get_general_value('services_enabled') ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                </div>
        
                <div class="icon">
                    <i class="fas fa-briefcase"></i>
                </div>
        
                <h5>الخدمات</h5>
                <small>/services</small>
        
                <div id="service-status-text" class="mt-2 text-muted small">
                    {{ get_general_value('services_enabled') ? 'نشط' : 'معطّل' }}
                </div>
        
            </div>
        </div>
        <div class="col-md-4">
            <div class="page-card info" id="news-card">
        
                {{-- SWITCH --}}
                <div class="page-action">
                    <label class="switch">
                        <input type="checkbox"
                               id="newsSwitch"
                               {{ get_general_value('news_enabled') ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                </div>
        
                <div class="icon">
                    <i class="fas fa-newspaper"></i>
                </div>
        
                <h5>الأخبار</h5>
                <small>/news</small>
        
                <div id="news-status-text" class="mt-2 text-muted small">
                    {{ get_general_value('news_enabled') ? 'نشط' : 'معطّل' }}
                </div>
        
            </div>
        </div>
        
        
        
        <div class="col-md-4">
            <div class="page-card danger position-relative">
                <!-- أيقونة مع عداد -->
                @can('ادراة طلبات التواصل')
                    <div class="position-absolute" style="left: 15px; top: 15px;">
                        <a href="{{ route('dashboard.contacts.index') }}" 
                           class="position-relative text-decoration-none"
                           title="طلبات التواصل">
                            <div class="bg-light text-danger rounded-circle d-flex align-items-center justify-content-center"
                                 style="width: 42px; height: 42px;">
                                <i class="fas fa-inbox"></i>
                            </div>
                            
                            <!-- عداد الطلبات الجديدة -->
                            @php
                                $newRequests = App\Models\ContactMessage::where('is_read',0)->count(); // استبدل بقيمة حقيقية
                            @endphp
                            
                            @if($newRequests > 0)
                                <span class="badge bg-danger position-absolute" 
                                      style="top: -5px; right: -5px; min-width: 20px; height: 20px; padding: 3px 5px;">
                                    {{ $newRequests }}
                                </span>
                            @endif
                        </a>
                    </div>
                @endcan
                
                <div class="icon">
                    <i class="fas fa-envelope"></i>
                </div>
                
                <h5>تواصل معنا</h5>
                <small>/contact</small>
            </div>
        </div>

    </div>

    {{-- PAGES TABLE --}}
    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>العنوان</th>
                        <th>الرابط</th>
                        <th width="120">الحالة</th>
                        <th width="140">إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                        <tr>
                            <td>
                                <strong>{{ $page->title['ar'] ?? '-' }}</strong><br>
                                <small class="text-muted">{{ $page->title['en'] ?? '' }}</small>
                            </td>
                            <td>
                                <code>/{{ $page->slug }}</code>
                            </td>
                            <td>
                                <input type="checkbox" class="js-switch"
                                    {{ $page->status === 'published' ? 'checked' : '' }}>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('dashboard.pages.edit', $page) }}"
                                       class="btn btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-outline-danger js-delete"
                                            data-url="{{ route('dashboard.pages.destroy', $page) }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">
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
document.querySelectorAll('.js-delete').forEach(btn => {
    btn.addEventListener('click', function () {
        if (!confirm('هل أنت متأكد من الحذف؟')) return;

        fetch(this.dataset.url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: new URLSearchParams({_method:'DELETE'})
        }).then(() => location.reload());
    });
});
</script>
<script>
    document.getElementById('sectorSwitch').addEventListener('change', function () {
    
        const isActive = this.checked;
        const statusText = document.getElementById('sector-status-text');
        const card = document.getElementById('sector-card');
        if (isActive === false) {
            Swal.fire({
                icon: 'warning',
    title: 'تنبيه مهم',
    html: `
        <p style="font-size:14px; line-height:1.8">
            عند إيقاف قسم <strong>القطاعات</strong>:
            <br><br>
            • سيتم إخفاء صفحة القطاعات من الموقع.<br>
            • سيتم عرض <strong>أول 3 قطاعات فقط</strong>
              في <strong>الصفحة الرئيسية</strong>.
        </p>
    `,
            
            });

        }

    
        fetch("{{ route('dashboard.sectors_page.toggle') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                status: isActive ? 1 : 0
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                statusText.innerText = isActive ? 'نشط' : 'معطّل';
    
                card.classList.toggle('success', isActive);
                card.classList.toggle('danger', !isActive);
            }
        })
        .catch(() => {
            alert('حدث خطأ');
            this.checked = !isActive;
        });
    });
    </script>
    <script>
        document.getElementById('serviceSwitch').addEventListener('change', function () {
        
            const isActive   = this.checked;
            const statusText = document.getElementById('service-status-text');
            const card       = document.getElementById('service-card');
        
            if (isActive === false) {
                Swal.fire({
                    icon: 'warning',
                    title: 'تنبيه مهم',
                    html: `
                        <p style="font-size:14px; line-height:1.8">
                            عند إيقاف قسم <strong>الخدمات</strong>:
                            <br><br>
                            • سيتم إخفاء صفحة الخدمات من الموقع.<br>
                            • سيتم عرض <strong>أول 3 خدمات فقط</strong>
                              في <strong>الصفحة الرئيسية</strong>.
                        </p>
                    `,
                });
            }
        
            fetch("{{ route('dashboard.services_page.toggle') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    status: isActive ? 1 : 0
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    statusText.innerText = isActive ? 'نشط' : 'معطّل';
        
                    card.classList.toggle('success', isActive);
                    card.classList.toggle('danger', !isActive);
                }
            })
            .catch(() => {
                alert('حدث خطأ');
                this.checked = !isActive;
            });
        });
        </script>
    <script>
        document.getElementById('newsSwitch').addEventListener('change', function () {
        
            const isActive   = this.checked;
            const statusText = document.getElementById('news-status-text');
            const card       = document.getElementById('news-card');
        
            if (!isActive) {
                Swal.fire({
                    icon: 'info',
                    title: 'تنبيه',
                    html: `
                        <p style="font-size:14px; line-height:1.8">
                            عند إيقاف قسم <strong>الأخبار</strong>:
                            <br><br>
                            • سيتم إخفاء صفحة الأخبار من الموقع.<br>
                            •سيتم فقط عرض اخر 3 اخبار بالشاشة الرئيسية
                        </p>
                    `,
                });
            }
        
            fetch("{{ route('dashboard.news_page.toggle') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    status: isActive ? 1 : 0
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    statusText.innerText = isActive ? 'نشط' : 'معطّل';
        
                    card.classList.toggle('success', isActive);
                    card.classList.toggle('danger', !isActive);
                }
            })
            .catch(() => {
                alert('حدث خطأ');
                this.checked = !isActive;
            });
        });
        </script>
        
@endsection
