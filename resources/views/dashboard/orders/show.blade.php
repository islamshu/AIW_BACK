@extends('layouts.master')

@section('title', __('تفاصيل الطلب'))

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{ __('تفاصيل الطلب') }} #{{ $order->code }}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('الرئيسية') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">{{ __('الطلبات') }}</a>
                                </li>
                                <li class="breadcrumb-item active">#{{ $order->code }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12 text-md-right">
                    <button onclick="printInvoice()" class="btn btn-dark btn-lg">
                        <i class="la la-print"></i> {{ __('طباعة الفاتورة') }}
                    </button>
                </div>
            </div>
            
            <div class="content-body">
                <section class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('معلومات الطلب الأساسية') }}</h4>
                    </div>
                    <div class="card-body">

                        {{-- بيانات العميل والفاتورة --}}
                        <div class="row">
                            <!-- بيانات العميل -->
                            <div class="col-md-6 mb-3">
                                <div class="border p-3 rounded bg-light">
                                    <h5 class="mb-3 border-bottom pb-2">
                                        <i class="la la-user"></i> {{ __('بيانات العميل') }}
                                    </h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><strong>{{ __('رقم الطلب:') }}</strong> <span class="badge badge-primary">#{{ $order->code }}</span></li>
                                        <li class="mb-2"><strong>{{ __('الاسم:') }}</strong> {{ $order->fname }} {{ $order->lname }}</li>
                                        <li class="mb-2"><strong>{{ __('البريد الإلكتروني:') }}</strong> <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></li>
                                        <li class="mb-2"><strong>{{ __('الهاتف:') }}</strong> <a href="tel:{{ $order->phone }}">{{ $order->phone }}</a></li>
                                        <li class="mb-2"><strong>{{ __('العنوان:') }}</strong> {{ $order->address }},         {{ $order->city_data[app()->getLocale()] ?? '' }}</li>
                                        <li><strong>{{ __('ملاحظات:') }}</strong> {{ $order->notes ?? __('لا يوجد') }}</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- تفاصيل الفاتورة -->
                            <div class="col-md-6 mb-3">
                                <div class="border p-3 rounded bg-light">
                                    <h5 class="mb-3 border-bottom pb-2">
                                        <i class="la la-file-invoice"></i> {{ __('تفاصيل الفاتورة') }}
                                    </h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><strong>{{ __('الإجمالي قبل الخصم:') }}</strong> {{ number_format($order->subtotal, 2) }} ₪</li>
                                            <li class="mb-2"><strong>{{ __('سعر التوصيل:') }}</strong> {{ number_format($order->delevery_fee,2) }} ₪</li>
                                        <li class="mb-2"><strong>{{ __('الخصم:') }}</strong> {{ number_format($order->discount, 2) }} ₪</li>
                                        <li class="mb-2"><strong>{{ __('كود الكوبون:') }}</strong> {{ $order->coupon_code ?? __('لا يوجد') }}</li>
                                        <li class="mb-2"><strong>{{ __('الإجمالي النهائي:') }}</strong> <span class="text-success font-weight-bold">{{ number_format($order->total, 2) }} ₪</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- حالة الطلب والدفع --}}
                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <div class="border p-3 rounded bg-light">
                                    <h5 class="mb-3 border-bottom pb-2">
                                        <i class="la la-truck"></i> {{ __('حالة الطلب') }}
                                    </h5>
                                    <div class="form-group">
                                        <label><strong>{{ __('حالة الطلب:') }}</strong></label>
                                        <div class="d-flex align-items-center gap-2">
                                            <i id="order-status-icon" class="la la-2x {{ match($order->status) {
                                                'pending' => 'la-clock text-warning',
                                                'processing' => 'la-cogs text-primary',
                                                'completed' => 'la-check-circle text-success',
                                                'cancelled' => 'la-times-circle text-danger',
                                                default => 'la-question-circle text-muted',
                                            }
                                            }}"></i>
                                            
                                            <select id="order-status-select" class="form-control" data-id="{{ $order->id }}">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>{{ __('طلب جديد ') }}</option>
                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>{{ __('في التوصيل') }}</option>
                                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>{{ __('مكتمل') }}</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>{{ __('ملغي') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="border p-3 rounded bg-light">
                                    <h5 class="mb-3 border-bottom pb-2">
                                        <i class="la la-credit-card"></i> {{ __('معلومات الدفع') }}
                                    </h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2">
                                            <strong>{{ __('طريقة الدفع:') }}</strong> 
                                            <span class="badge badge-info">{{ __($order->payment_method) ?? __('غير محدد') }}</span>
                                        </li>
                                        <li>
                                            <strong>{{ __('حالة الدفع:') }}</strong> 
                                            <span class="badge {{ $order->payment_status == 'paid' ? 'badge-success' : 'badge-danger' }}">
                                                {{ get_status_order($order->payment_status) }}
                                            </span>
                                        </li>
                                        @if($order->transaction_id)
                                        <li class="mt-2">
                                            <strong>{{ __('رقم المعاملة:') }}</strong> 
                                            <span>{{ $order->transaction_id }}</span>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <hr>

                        {{-- جدول عناصر الطلب --}}
                        <h5 class="mb-3">
                            <i class="la la-shopping-cart"></i> {{ __('عناصر الطلب') }}
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="80">{{ __('الصورة') }}</th>
                                        <th>{{ __('اسم المنتج') }}</th>
                                        <th width="100">{{ __('اللون') }}</th>
                                        <th width="100">{{ __('المقاس') }}</th>
                                        <th width="100">{{ __('الكمية') }}</th>
                                        <th width="120">{{ __('السعر') }}</th>
                                        <th width="120">{{ __('الإجمالي') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td>
                                                @if ($item->image)
                                                    <img src="{{ asset('storage/' . $item->image) }}" width="60" height="60" class="rounded border" alt="product">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                                                        <i class="la la-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('products.show', $item->product_id) }}" class="font-weight-bold">
                                                    {{ $item->product_name }}
                                                </a>
                                                @if($item->product_options)
                                                    <div class="text-muted small mt-1">
                                                        {{ $item->product_options }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->colorAttr && $item->colorAttr->code)
                                                    <span class="d-inline-block rounded" style="width:20px; height:20px; background-color:{{ $item->colorAttr->code }}; border:1px solid #ddd;"></span>
                                                    <span class="small">{{ $item->colorAttr->name[app()->getLocale()] ?? '' }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->sizeAttr->value ?? '-' }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->price, 2) }} ₪</td>
                                            <td class="font-weight-bold">{{ number_format($item->total, 2) }} ₪</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-light">
                                    <tr>
                                        <th colspan="5" class="text-right">{{ __('الإجمالي') }}</th>
                                        <th colspan="2">{{ number_format($order->subtotal, 2) }} ₪</th>
                                    </tr>
                                    @if($order->discount > 0)
                                    <tr>
                                        <th colspan="5" class="text-right">{{ __('الخصم') }}</th>
                                        <th colspan="2">- {{ number_format($order->discount, 2) }} ₪</th>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th colspan="5" class="text-right">{{ __('سعر التوصيل') }}</th>
                                        <th colspan="2">{{ number_format($order->delevery_fee, 2) }} ₪</th>
                                    </tr>
                                    <tr class="table-active">
                                        <th colspan="5" class="text-right">{{ __('الإجمالي النهائي') }}</th>
                                        <th colspan="2" class="text-success">{{ number_format($order->total, 2) }} ₪</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                                <i class="la la-arrow-right"></i> {{ __('رجوع إلى قائمة الطلبات') }}
                            </a>
                            
                            <button onclick="printInvoice()" class="btn btn-dark">
                                <i class="la la-print"></i> {{ __('طباعة الفاتورة') }}
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    
    {{-- نافذة الطباعة --}}
    <div id="print-area" style="display:none;">
        @include('dashboard.orders.print', ['order' => $order])
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#order-status-select').on('change', function() {
                const orderId = $(this).data('id');
                const status = $(this).val();
                const route = "{{ route('orders.change_status', '__id__') }}".replace('__id__', orderId);

                Swal.fire({
                    title: 'تغيير حالة الطلب',
                    text: 'هل أنت متأكد من تغيير حالة هذا الطلب؟',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'نعم، تغيير',
                    cancelButtonText: 'إلغاء',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: route,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                order_id: orderId,
                                status: status,
                            },
                            success: function(res) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'تم التحديث',
                                    text: res.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });

                                // تحديث الأيقونة
                                const iconMap = {
                                    pending: 'la-clock text-warning',
                                    processing: 'la-cogs text-primary',
                                    completed: 'la-check-circle text-success',
                                    cancelled: 'la-times-circle text-danger'
                                };
                                $('#order-status-icon').attr('class', 'la la-2x ' + iconMap[status]);
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'خطأ',
                                    text: xhr.responseJSON?.message || 'حدث خطأ أثناء التحديث'
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        });
                    } else {
                        // إعادة تعيين القيمة في حالة الإلغاء
                        $(this).val('{{ $order->status }}');
                    }
                });
            });
        });

         function printInvoice() {
            // استهداف صندوق تفاصيل الطلب فقط
            const printContents = document.querySelector('.order-details-box').innerHTML;
            const originalContents = document.body.innerHTML;

            document.body.innerHTML = `
            <html>
            <head>
                <title>{{ __('فاتورة الطلب') }}</title>
                <style>
                    body { direction: rtl; font-family: Arial, sans-serif; color: #000; padding: 20px; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { border: 1px solid #ddd; padding: 8px; }
                    th { background-color: #f2f2f2; }
                    h5 { margin-top: 20px; }
                </style>
            </head>
            <body>
                ${printContents}
            </body>
            </html>
        `;

            window.print();
            document.body.innerHTML = originalContents;
            window.location.reload(); // لإعادة الصفحة كما كانت
        }
    </script>
@endsection