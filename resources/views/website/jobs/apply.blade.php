@extends('layouts.frontend')

@section('title','التقديم على وظيفة')

@section('content')
<div class="container mx-auto px-4 max-w-5xl">

    {{-- ================= HERO ================= --}}
    <section class="mb-20 fade-in">
        <h1 class="text-3xl md:text-4xl font-extrabold mb-4">
            التقديم على <span class="gradient-text">الوظائف المتاحة</span>
        </h1>

        <p class="text-[#a8b2d1] max-w-2xl leading-relaxed">
            اختر الوظيفة المناسبة لك، اطّلع على المؤهلات المطلوبة،
            ثم قدّم طلبك بكل سهولة. سيتم التواصل معك في حال تم اختيارك.
        </p>
    </section>

    {{-- ================= JOB SELECT ================= --}}
    <section class="mb-12 slide-in-left">
        <div class="bg-[#112240] border border-[#00b4d8]/10 rounded-2xl p-6 md:p-8">
            <label class="block mb-3 font-semibold text-lg">
                الوظائف المتاحة
            </label>

            <select id="jobSelect"
                class="w-full bg-[#0a192f] border border-[#00b4d8]/20
                       rounded-xl px-4 py-3 text-white focus:outline-none
                       focus:ring-2 focus:ring-[#00b4d8]">

                @foreach($jobs as $job)
                    <option value="{{ $job->id }}"
                        {{ ($selectedJob?->id ?? null) == $job->id ? 'selected' : '' }}>
                        {{ $job->getTranslation('title', app()->getLocale()) }}
                    </option>
                @endforeach
            </select>
        </div>
    </section>

    {{-- ================= REQUIREMENTS ================= --}}
    <section class="mb-16 slide-in-right">
        <div class="bg-[#112240] border border-[#00b4d8]/10 rounded-2xl p-6 md:p-8">

            <h2 class="text-xl font-bold mb-4 text-[#00b4d8]">
                المؤهلات المطلوبة
            </h2>

            <div id="requirementsBox"
                 class="text-[#ccd6f6] leading-loose text-sm md:text-base">

                @if($selectedJob)
                {!! $selectedJob->getTranslation('requirements', app()->getLocale()) !!}
                @else
                    <span class="text-[#8892b0]">
                        اختر وظيفة لعرض المؤهلات المطلوبة
                    </span>
                @endif

            </div>
        </div>
    </section>

    {{-- ================= APPLY FORM ================= --}}
    <section class="mb-24 fade-in">
        <div class="bg-[#112240] border border-[#00b4d8]/10 rounded-2xl p-6 md:p-8">

            <h2 class="text-xl font-bold mb-8">
                نموذج <span class="gradient-text">التقديم</span>
            </h2>

            @if(session('success'))
                <div class="mb-6 bg-[#00b4d8]/10 border border-[#00b4d8]/30
                            text-[#00b4d8] px-5 py-4 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <form id="applyForm"

                  enctype="multipart/form-data"
                  class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf

                <input type="hidden"
                       name="job_id"
                       id="jobId"
                       value="{{ $selectedJob?->id }}">

                {{-- Name --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold">
                        الاسم الكامل
                    </label>
                    <input type="text" name="name" required
                           class="w-full bg-[#0a192f] border border-[#00b4d8]/20
                                  rounded-xl px-4 py-3 text-white focus:outline-none
                                  focus:ring-2 focus:ring-[#00b4d8]">
                </div>

                {{-- Phone --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold">
                        رقم الهاتف
                    </label>
                    <input type="text" name="phone" required
                           class="w-full bg-[#0a192f] border border-[#00b4d8]/20
                                  rounded-xl px-4 py-3 text-white focus:outline-none
                                  focus:ring-2 focus:ring-[#00b4d8]">
                </div>

                {{-- CV --}}
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-semibold">
                        السيرة الذاتية (CV)
                    </label>
                    <input type="file" name="cv" required
                           accept=".pdf,.doc,.docx"
                           class="w-full bg-[#0a192f] border border-[#00b4d8]/20
                                  rounded-xl px-4 py-3 text-[#a8b2d1]">
                    <p class="text-xs text-[#8892b0] mt-2">
                        الصيغ المسموحة: PDF / DOC / DOCX
                    </p>
                </div>

                {{-- Submit --}}
                <div class="md:col-span-2 flex justify-end mt-6">
                    <button type="submit"
                        class="bg-gradient-to-r from-[#00b4d8] to-[#ff5d8f]
                               px-10 py-3 rounded-full font-bold
                               hover:opacity-90 transition">
                        إرسال الطلب
                    </button>
                </div>

            </form>
            <div id="formMessage" class="mt-4 hidden"></div>

        </div>
    </section>

</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const select = document.getElementById('jobSelect');
    const box    = document.getElementById('requirementsBox');
    const jobId  = document.getElementById('jobId');

    select?.addEventListener('change', async () => {

        const id = select.value;
        jobId.value = id;

        box.innerHTML = '<span class="text-[#8892b0]">جاري تحميل المؤهلات...</span>';

        try {
            const res = await fetch(`/jobs/${id}/json`);
            const data = await res.json();

            box.innerHTML = data.requirements
                ? data.requirements.replace(/\n/g,'<br>')
                : '<span class="text-[#8892b0]">لا توجد مؤهلات محددة</span>';

        } catch {
            box.innerHTML =
                '<span class="text-red-400">حدث خطأ أثناء تحميل البيانات</span>';
        }
    });

});
</script>
<script>
document.getElementById('applyForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form   = this;
    const msgBox = document.getElementById('formMessage');
    const btn    = form.querySelector('button');

    msgBox.classList.add('hidden');
    btn.disabled = true;
    btn.textContent = 'جاري الإرسال...';

    const formData = new FormData(form);

    try {
        const res = await fetch('{{ route('jobs.apply') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        });

        const data = await res.json();

        if (!res.ok) {
            throw data;
        }

        // نجاح
        msgBox.className = 'mt-4 p-4 rounded-xl bg-green-500/10 text-green-400';
        msgBox.textContent = data.message;
        msgBox.classList.remove('hidden');

        form.reset();

    } catch (err) {
        let message = 'حدث خطأ أثناء الإرسال';

        if (err?.errors) {
            message = Object.values(err.errors).flat().join(' - ');
        } else if (err?.message) {
            message = err.message;
        }

        msgBox.className = 'mt-4 p-4 rounded-xl bg-red-500/10 text-red-400';
        msgBox.textContent = message;
        msgBox.classList.remove('hidden');

    } finally {
        btn.disabled = false;
        btn.textContent = 'إرسال الطلب';
    }
});
</script>

@endsection
