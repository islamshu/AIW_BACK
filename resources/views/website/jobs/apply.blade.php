@extends('layouts.frontend')

@section('title', app()->getLocale() === 'ar' ? 'التقديم على وظيفة' : 'Apply for a Job')

@section('content')
<section
    class="pt-32 pb-24 relative overflow-hidden"
    style="background: var(--bg-color);"
>

    {{-- Background soft glow --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full blur-3xl"
             style="background: var(--primary-color); opacity:.06"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full blur-3xl"
             style="background: var(--secondary-color); opacity:.06"></div>
    </div>

    <div class="container mx-auto px-4 max-w-5xl relative z-10">

        {{-- ================= HERO ================= --}}
        <div class="mb-20 text-center fade-in">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-4"
                style="color: var(--text-color)">
                {{ app()->getLocale() === 'ar'
                    ? 'التقديم على الوظائف المتاحة'
                    : 'Apply for Available Jobs' }}
            </h1>

            <p class="max-w-2xl mx-auto leading-relaxed"
               style="color: color-mix(in srgb, var(--text-color) 70%, transparent)">
                {{ app()->getLocale() === 'ar'
                    ? 'اختر الوظيفة المناسبة لك، اطّلع على المؤهلات المطلوبة ثم قدّم طلبك بكل سهولة.'
                    : 'Choose the position that suits you, review the requirements and submit your application easily.' }}
            </p>
        </div>

        {{-- ================= JOB SELECT ================= --}}
        <div class="mb-14 fade-in">
            <label class="block mb-3 font-semibold"
                   style="color: var(--text-color)">
                {{ app()->getLocale() === 'ar' ? 'الوظائف المتاحة' : 'Available Jobs' }}
            </label>

            <select id="jobSelect"
                class="w-full rounded-xl px-4 py-3 focus:outline-none transition"
                style="
                    background: #fff;
                    border: 1px solid color-mix(in srgb, var(--primary-color) 30%, transparent);
                    color: var(--text-color);
                ">

                @foreach($jobs as $job)
                    <option value="{{ $job->id }}"
                        {{ ($selectedJob?->id ?? null) == $job->id ? 'selected' : '' }}>
                        {{ $job->getTranslation('title', app()->getLocale()) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- ================= REQUIREMENTS ================= --}}
        <div class="mb-20 fade-in">
            <div class="rounded-2xl p-8"
                 style="
                    background: #ffffff;
                    border: 1px solid color-mix(in srgb, var(--primary-color) 18%, transparent);
                 ">

                <h2 class="text-lg font-bold mb-4"
                    style="color: var(--primary-color)">
                    {{ app()->getLocale() === 'ar'
                        ? 'المتطلبات الوظيفية'
                        : 'Job Requirements' }}
                </h2>

                <div id="requirementsBox"
                     class="leading-relaxed"
                     style="color: color-mix(in srgb, var(--text-color) 80%, transparent)">

                    @if($selectedJob)
                        {!! $selectedJob->getTranslation('requirements', app()->getLocale()) !!}
                    @else
                        <span style="color: color-mix(in srgb, var(--text-color) 60%, transparent)">
                            {{ app()->getLocale() === 'ar'
                                ? 'اختر وظيفة لعرض المتطلبات'
                                : 'Select a job to view requirements' }}
                        </span>
                    @endif

                </div>
            </div>
        </div>

        {{-- ================= APPLY FORM ================= --}}
        <div class="fade-in">
            <div class="rounded-2xl p-8"
                 style="
                    background: #ffffff;
                    border: 1px solid color-mix(in srgb, var(--primary-color) 18%, transparent);
                 ">

                <h2 class="text-xl font-bold mb-8"
                    style="color: var(--text-color)">
                    {{ app()->getLocale() === 'ar'
                        ? 'نموذج التقديم'
                        : 'Application Form' }}
                </h2>

                <form id="applyForm"
                      enctype="multipart/form-data"
                      class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf

                    <input type="hidden" name="job_id" id="jobId"
                           value="{{ $selectedJob?->id }}">

                    {{-- Name --}}
                    <div>
                        <label class="block mb-2 text-sm font-semibold"
                               style="color: var(--text-color)">
                            {{ app()->getLocale() === 'ar' ? 'الاسم الكامل' : 'Full Name' }}
                        </label>
                        <input type="text" name="name" required
                               class="w-full px-4 py-3 rounded-xl focus:outline-none"
                               style="border:1px solid #e5e7eb">
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block mb-2 text-sm font-semibold"
                               style="color: var(--text-color)">
                            {{ app()->getLocale() === 'ar' ? 'رقم الهاتف' : 'Phone Number' }}
                        </label>
                        <input type="text" name="phone" required
                               class="w-full px-4 py-3 rounded-xl focus:outline-none"
                               style="border:1px solid #e5e7eb">
                    </div>

                    {{-- CV --}}
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold"
                               style="color: var(--text-color)">
                            CV
                        </label>
                        <input type="file" name="cv" required
                               accept=".pdf,.doc,.docx"
                               class="w-full px-4 py-3 rounded-xl"
                               style="border:1px solid #e5e7eb">
                    </div>

                    {{-- Submit --}}
                    <div class="md:col-span-2 flex justify-end mt-6">
                        <button type="submit"
                            class="px-10 py-3 rounded-full font-bold text-white transition hover:scale-105"
                            style="
                                background: linear-gradient(
                                    135deg,
                                    var(--primary-color),
                                    var(--secondary-color)
                                );
                            ">
                            {{ app()->getLocale() === 'ar' ? 'إرسال الطلب' : 'Submit Application' }}
                        </button>
                    </div>
                </form>

                <div id="formMessage" class="mt-4 hidden"></div>
            </div>
        </div>

    </div>
</section>
@endsection
