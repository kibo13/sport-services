@extends('layouts.master')

@section('content-head')
    <title>{{ __('_field.pay_file') }}</title>
    <style>
        .receipt-list {
            padding: 0;
            list-style-type: none;
        }
        .receipt-list__item {
            padding: 0.75rem 1.25rem;
            margin-bottom: -1px;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, .125);
        }
        .receipt-list__title {
            font-weight: bold;
        }
        .receipt-list__text {
            color: #4285F4;
            font-size: 14px;
        }
    </style>
@endsection

@section('content-body')
    <h1>Квитанция</h1>
    <ul class="receipt-list">
        <li class="receipt-list__item">
            <span class="receipt-list__title">
                Номер счёта:
            </span>
            <span class="receipt-list__text">
                {{ 'INV' . $payment->id }}
            </span>
        </li>
        <li class="receipt-list__item">
            <span class="receipt-list__title">
                Дата платежа:
            </span>
            <span class="receipt-list__text">
                {{ format_date_for_display($payment->paid_at) }}
            </span>
        </li>
        <li class="receipt-list__item">
            <span class="receipt-list__title">
                Активность:
            </span>
            <span class="receipt-list__text">
                {{ $payment->activity->name }}
            </span>
        </li>
        <li class="receipt-list__item">
            <span class="receipt-list__title">
                Услуга:
            </span>
            <span class="receipt-list__text">
                {{ $payment->service->name }}
            </span>
        </li>
        @if($payment->client)
        <li class="receipt-list__item">
            <span class="receipt-list__title">
                Клиент:
            </span>
            <span class="receipt-list__text">
                {{ $payment->client->full_name }}
            </span>
        </li>
        @endif
        <li class="receipt-list__item">
            <span class="receipt-list__title">
                Сумма:
            </span>
            <span class="receipt-list__text">
                {{ $payment->amount . ' ₽' }}
            </span>
        </li>
    </ul>
@endsection
