@extends('admin.index')

@section('title-admin', __('_section.payments'))

@section('content-admin')
    <section id="payment-index">
        <h3>{{ __('_section.payments') }}</h3>

        @if(is_access('pay_full'))
        <div class="my-2 btn-group">
            <a class="btn btn-primary" href="{{ route('payments.create') }}">
                {{ __('_record.new') }}
            </a>
        </div>
        @endif

        <div class="my-2 bk-callout">
            <ul>
                <li>
                    <span class="font-weight-bold">Сумма за предыдущий месяц:</span>
                    <span class="text-primary">
                        {{ format_money_for_display($previousMonthAmount, 0) . ' ₽'  }}
                    </span>
                </li>
                <li>
                    <span class="font-weight-bold">Сумма за текущий месяц:</span>
                    <span class="text-primary">
                        {{ format_money_for_display($currentMonthAmount, 0) . ' ₽'  }}
                    </span>
                </li>
                <li>
                    <span class="font-weight-bold">Сумма за весь период: </span>
                    <span class="text-primary">
                        {{ format_money_for_display($totalAmount, 0) . ' ₽'  }}
                    </span>
                </li>
            </ul>
        </div>

        @if(session()->has('success'))
        <div class="my-2 alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif

        <table id="is-datatable" class="dataTables table table-bordered table-hover table-responsive">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th class="w-00 bk-min-w-100">{{ __('_field.num') }}</th>
                    <th class="w-25 bk-min-w-200">{{ __('_field.activity') }}</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.service') }}</th>
                    <th class="w-25 bk-min-w-150">{{ __('_field.amount') }}</th>
                    <th class="w-25 bk-min-w-150">{{ __('_field.date') }}</th>
                    <th class="no-sort">{{ __('_action.this') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->activity->name }}</td>
                    <td>
                        <ul>
                            <li>{{ $payment->service->name }}</li>
                            <li class="text-muted">{{ $payment->service->category->name }}</li>
                        </ul>
                    </td>
                    <td>{{ format_money_for_display($payment->amount, 0) . ' ₽' }}</td>
                    <td>{{ format_date_for_display($payment->paid_at) }}</td>
                    <td>
                        <div class="bk-btn-actions">
                            <a class="bk-btn-action bk-btn-action--bill btn btn-primary"
                               href="{{ route('payments.receipt', $payment) }}"
                               target="_blank"
                               title="{{ __('_field.check') }}"></a>
                            @if(is_access('card_read') && $payment->card)
                            <a class="bk-btn-action bk-btn-action--card btn btn-primary"
                               href="{{ route('cards.generate', $payment->card) }}"
                               target="_blank"
                               title="{{ __('_field.card') }}"></a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
