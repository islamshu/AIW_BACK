<table class="table table-bordered">
    <thead>
        <tr>
            <th>{{ __('الاسم') }}</th>
            <th>{{ __('البريد الإلكتروني') }}</th>
            <th>{{ __('رقم الهاتف') }}</th>
            <th>{{ __('الموضوع') }}</th>
            <th>{{ __('الحالة') }}</th>
            <th>{{ __('التحكم') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($messages as $msg)
            <tr>
                <td>{{ $msg->name }}</td>
                <td>{{ $msg->email }}</td>
                <td>{{ $msg->phone }}</td>
                <td>{{ $msg->subject }}</td>
                <td>
                    @if ($msg->is_read)
                        <span class="badge badge-success">{{ __('مقروء') }}</span>
                    @else
                        <span class="badge badge-warning">{{ __('غير مقروء') }}</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('contact-messages.show', $msg->id) }}" class="btn btn-sm btn-primary">
                        <i class="ft-eye"></i> {{ __('عرض') }}
                    </a>
                    <form action="{{ route('contact-messages.destroy', $msg->id) }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('{{ __('هل أنت متأكد من حذف هذه الرسالة؟') }}')">
                            <i class="ft-trash"></i> {{ __('حذف') }}
                        </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">{{ __('لا توجد بيانات') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
