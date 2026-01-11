@extends('layouts.master')
@section('title','اختيار أيقونة')

@section('style')
<style>
.icon-box {
    cursor: pointer;
    border: 1px solid #eee;
    padding: 12px 6px;
    border-radius: 6px;
    text-align: center;
    transition: .2s;
    height: 90px;
}
.icon-box:hover {
    background: #f8f9fa;
    border-color: #0d6efd;
}
.icon-box i {
    font-size: 22px;
}
.icon-name {
    font-size: 11px;
    margin-top: 6px;
    color: #555;
    word-break: break-all;
}
</style>
@endsection

@section('content')
<div class="app-content content">
<div class="content-wrapper">

<h3 class="mb-3">اختيار أيقونة</h3>

<input type="text"
       id="searchIcon"
       class="form-control mb-3"
       placeholder="ابحث عن أيقونة...">

<div class="row" id="iconsContainer"></div>

</div>
</div>
@endsection

@section('script')
<script>
// تحميل جميع الأيقونات من Font Awesome metadata
fetch('/fontawesome/icons.json')
    .then(res => res.json())
    .then(icons => {
        const container = document.getElementById('iconsContainer');

        Object.keys(icons).forEach(name => {
            if (!icons[name].styles.includes('solid')) return;

            const iconClass = `fa-solid fa-${name}`;

            const col = document.createElement('div');
            col.className = 'col-6 col-md-2 mb-3 icon-item';
            col.dataset.name = name;

            col.innerHTML = `
                <div class="icon-box" onclick="selectIcon('${iconClass}')">
                    <i class="${iconClass}"></i>
                    <div class="icon-name">${iconClass}</div>
                </div>
            `;

            container.appendChild(col);
        });
    });


// اختيار أيقونة
function selectIcon(icon) {
    window.opener?.postMessage({
        type: 'icon-selected',
        icon: icon
    }, '*');

    window.close();
}

// البحث
document.getElementById('searchIcon').addEventListener('input', function () {
    const value = this.value.toLowerCase();
    document.querySelectorAll('.icon-item').forEach(item => {
        item.style.display = item.dataset.name.includes(value)
            ? 'block'
            : 'none';
    });
});
</script>
@endsection
