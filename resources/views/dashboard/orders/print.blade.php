 <div class="order-details-box p-5 rounded-4 shadow-lg bg-white border border-gray-200" style="display: none">
        @php
            $statusMap = [
                'pending' => ['text-warning', __('طلب جديد')],
                'processing' => ['text-info', __('في التوصيل')],
                'completed' => ['text-success', __('مكتمل')],
                'cancelled' => ['text-danger', __('ملغى')],
            ];
            [$statusClass, $statusText] = $statusMap[$order->status] ?? [
                'text-secondary',
                $order->status ?? __('غير معروف'),
            ];
        @endphp

        <div class="order-header mb-5">
            <div class="row">
                <div class="col-md-6">
                    <h5>{{ __('معلومات الطلب') }}</h5>
                    <p><strong>{{ __('رقم الطلب') }}:</strong> {{ $order->code }}</p>
                    <p><strong>{{ __('تاريخ الطلب') }}:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
                    <p><strong>{{ __('حالة الطلب') }}:</strong> <span
                            class="{{ $statusClass }}">{{ $statusText }}</span></p>
                </div>
                <div class="col-md-6">
                    <h5>{{ __('معلومات الدفع') }}</h5>
                    <p><strong>{{ __('طريقة الدفع') }}:</strong> {{ __($order->payment_method) }}</p>
                    <p><strong>{{ __('حالة الدفع') }}:</strong> {{get_status_order($order->payment_status) }}</p>

                    <p><strong>{{ __('المجموع') }}:</strong> {{ $order->total }} ₪</p>
                </div>
            </div>
        </div>

        <div class="order-customer mb-5">
            <div class="row">
                <div class="col-md-6">
                    <h5>{{ __('معلومات العميل') }}</h5>
                    <p><strong>{{ __('الاسم') }}:</strong> {{ $order->fname }} {{ $order->lname }}</p>
                    <p><strong>{{ __('البريد الإلكتروني') }}:</strong> {{ $order->email }}</p>
                    <p><strong>{{ __('الهاتف') }}:</strong> {{ $order->phone }}</p>
                </div>
                <div class="col-md-6">
                    <h5>{{ __('عنوان الشحن') }}</h5>
                    <p>
                        {{ $order->address }},
                        {{ $order->city_data[app()->getLocale()] }},
                        {{ $order->postcode }}
                        <br>
                        <strong>{{ __('رسوم التوصيل') }}:</strong> {{number_format($order->delevery_fee, 2)
                         }} ₪
                    </p>
                </div>
            </div>
        </div>

        <div class="order-items mb-5">
            <h5>{{ __('تفاصيل الطلب') }}</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('المنتج') }}</th>
                            <th class="text-center">{{ __('الكمية') }}</th>
                            <th>{{ __('السعر') }}</th>
                            <th>{{ __('المجموع') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->product_name ?? '---' }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td dir="ltr">{{ $item->price }} ₪</td>
                                <td dir="ltr">{{ $item->price * $item->quantity }} ₪</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="3" class="text-end">
                                <strong>{{ __('المجموع الفرعي') }}:</strong>
                            </td>
                            <td dir="ltr">{{ $order->subtotal }} ₪</td>
                        </tr>
                        @if ($order->discount > 0)
                            <tr>
                                <td colspan="3" class="text-end"><strong>{{ __('الخصم') }}
                                        ({{ $order->coupon_code }}):</strong></td>
                                <td dir="ltr">- {{ $order->discount }} ₪</td>
                            </tr>
                        @endif
                        {{-- إزالة الضريبة --}}
                        {{-- <tr>
                                                <td colspan="3" class="text-end"><strong>{{ __('الضريبة') }}:</strong></td>
                                                <td dir="ltr">{{ $order->tax }} ₪</td>
                                            </tr> --}}
                        <tr>
                            <td colspan="3" class="text-end"><strong>{{ __('رسوم التوصيل') }}:</strong></td>
                            <td dir="ltr">{{ number_format($order->delevery_fee, 2) }} ₪</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end">
                                <strong>{{ __('المجموع الكلي') }}:</strong>
                            </td>
                            <td dir="ltr">{{ $order->total }} ₪</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @if ($order->notes)
            <div class="order-notes mt-4">
                <h5 class="fw-bold mb-2">{{ __('ملاحظات الطلب') }}</h5>
                <p>{{ $order->notes }}</p>
            </div>
        @endif
    </div>