@extends('layouts.master')
@section('title','من نحن')

@section('content')
<div class="content-wrapper">

    <form method="POST" action="{{ route('about.save') }}">
        @csrf

        {{-- ================== القسم الأول ================== --}}
        <div class="card mb-4 p-3">
            <h4>من نحن</h4>

            <div class="row">
                <div class="col-md-6">
                    <label>العنوان (AR)</label>
                    <input class="form-control" name="about_title[ar]">
                </div>
                <div class="col-md-6">
                    <label>Title (EN)</label>
                    <input class="form-control" name="about_title[en]">
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6">
                    <label>النص (AR)</label>
                    <textarea class="form-control" name="about_text[ar]" rows="4"></textarea>
                </div>
                <div class="col-md-6">
                    <label>Text (EN)</label>
                    <textarea class="form-control" name="about_text[en]" rows="4"></textarea>
                </div>
            </div>
        </div>

        {{-- ================== القسم الثاني ================== --}}
        <div class="card mb-4 p-3">
            <h4>نموذج Invest & Operate</h4>

            <div id="steps-repeater">

                <div class="step-item border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <input class="form-control" name="steps[0][title][ar]" placeholder="عنوان AR">
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" name="steps[0][title][en]" placeholder="Title EN">
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" name="steps[0][desc][ar]" placeholder="وصف AR">
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" name="steps[0][desc][en]" placeholder="Desc EN">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="steps[0][order]" placeholder="ترتيب">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-step">حذف</button>
                        </div>
                    </div>
                </div>

            </div>

            <button type="button" class="btn btn-outline-primary" onclick="addStep()">+ إضافة خطوة</button>
        </div>

        {{-- ================== القسم الثالث ================== --}}
        <div class="card mb-4 p-3">
            <h4>قيمنا الأساسية</h4>

            <div id="values-repeater">

                <div class="value-item border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <input class="form-control" name="values[0][icon]" placeholder="fa-users">
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" name="values[0][title][ar]" placeholder="عنوان AR">
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" name="values[0][title][en]" placeholder="Title EN">
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="values[0][order]" placeholder="ترتيب">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger remove-value">✕</button>
                        </div>
                    </div>
                </div>

            </div>

            <button type="button" class="btn btn-outline-primary" onclick="addValue()">+ إضافة قيمة</button>
        </div>

        <button class="btn btn-success btn-lg">حفظ كل الصفحة</button>

    </form>
</div>
@endsection
@section('script')
<script>
    let stepIndex = 1
    let valueIndex = 1

    function addStep() {
        let html = document.querySelector('.step-item').outerHTML
        html = html.replaceAll('[0]', '[' + stepIndex + ']')
        document.getElementById('steps-repeater').insertAdjacentHTML('beforeend', html)
        stepIndex++
    }

    function addValue() {
        let html = document.querySelector('.value-item').outerHTML
        html = html.replaceAll('[0]', '[' + valueIndex + ']')
        document.getElementById('values-repeater').insertAdjacentHTML('beforeend', html)
        valueIndex++
    }

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-step')) {
            e.target.closest('.step-item').remove()
        }
        if (e.target.classList.contains('remove-value')) {
            e.target.closest('.value-item').remove()
        }
    })
</script>

@endsection