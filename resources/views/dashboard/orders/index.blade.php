@extends('layouts.master')

@section('title', __('الطلبات'))
@section('style')
    <style>
        table th,
        table td {
            vertical-align: middle !important;
        }

        select.order-status {
            min-width: 100px;
        }

        .table td,
        .table th {
            font-size: 0.875rem;
        }
    </style>
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{ __('الطلبات') }}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('الرئيسية') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('الطلبات') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <section class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('كل الطلبات') }}</h4>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body">
                            <!-- فلاتر البحث -->
                            <!-- فلاتر البحث -->
                            <div class="filter-box filter-expanded mb-3"
                                style="border: 1px solid #ddd; border-radius: 6px; padding: 15px;">
                                <div class="filter-header d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0"><i class="ft-filter"></i> {{ __('تصفية الطلبات') }}</h5>
                                    <button type="button" class="filter-toggle btn btn-sm btn-outline-secondary">
                                        {{ __('إخفاء') }} <i class="ft-chevron-up"></i>
                                    </button>
                                </div>

                                <div class="filter-body">
                                    <form id="filter-form" class="row">
                                        <div class="col-md-4">
                                            <label>{{ __('البحث بالاسم أو البريد') }}</label>
                                            <input type="text" name="search" class="form-control"
                                                placeholder="{{ __('بحث...') }}">
                                        </div>

                                        <div class="col-md-2">
                                            <label>{{ __('حالة الطلب') }}</label>
                                            <select name="status" class="form-control">
                                                <option value="">{{ __('الكل') }}</option>
                                                <option value="pending">{{ __('طلب جديد') }}</option>
                                                <option value="processing">{{ __('في التوصيل') }}</option>
                                                <option value="completed">{{ __('مكتمل ') }}</option>
                                                <option value="cancelled">{{ __('ملغي') }}</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label>{{ __('طريقة الدفع') }}</label>
                                            <select name="payment_method" class="form-control">
                                                <option value="">{{ __('الكل') }}</option>
                                                <option value="PayPal">{{ __('PayPal') }}</option>
                                                <option value="cod">{{ __('cod') }}</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label>{{ __('التاريخ') }}</label>
                                            <input type="date" name="date" class="form-control">
                                        </div>

                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                <i class="ft-search"></i> {{ __('بحث') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <!-- نتائج الطلبات -->
                            <div id="orders-container"class="table-responsive">
                                @include('dashboard.orders._table', ['orders' => $orders])
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // فلترة الطلبات
            $('#filter-form').on('submit', function(e) {
                e.preventDefault();
                fetchOrders();
            });

            // تغيير الصفحات
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                fetchOrders(page);
            });

            function fetchOrders(page = 1) {
                $.ajax({
                    url: '{{ route('orders.ajax') }}?page=' + page,
                    method: 'GET',
                    data: $('#filter-form').serialize(),
                    success: function(res) {
                        $('#orders-container').html(res.html);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    </script>
    <script>
        $(document).on('change', '.order-status', function() {
            const orderId = $(this).data('id');
            const status = $(this).val();
            const route = "{{ route('orders.change_status', '__id__') }}".replace('__id__', orderId);

            $.ajax({
                url: route,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'تم التحديث',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false,
                    });

                    const icon = $('[data-id="' + orderId + '"]').siblings('i');
                    const statusIcons = {
                        pending: 'la-clock text-warning',
                        processing: 'la-cogs text-primary',
                        completed: 'la-check-circle text-success',
                        cancelled: 'la-times-circle text-danger',
                    };

                    icon.removeClass().addClass('la ' + statusIcons[status]);
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: xhr.responseJSON?.message || 'حدث خطأ أثناء التحديث',
                    });
                }
            });
        });
        // إخفاء / عرض الفلاتر
$('.filter-toggle').on('click', function() {
    const filterBox = $(this).closest('.filter-box');
    const filterBody = filterBox.find('.filter-body');
    const icon = $(this).find('i');

    filterBody.slideToggle(300);

    if ($(this).hasClass('collapsed')) {
        $(this).removeClass('collapsed').contents().first()[0].textContent = '{{ __("إخفاء") }} ';
        icon.removeClass('ft-chevron-down').addClass('ft-chevron-up');
    } else {
        $(this).addClass('collapsed').contents().first()[0].textContent = '{{ __("عرض") }} ';
        icon.removeClass('ft-chevron-up').addClass('ft-chevron-down');
    }
});

    </script>
    


@endsection
