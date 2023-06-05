@extends('admin.index')

@section('title-admin', __('_section.payments'))

@section('content-admin')
    <section id="payment-form">
        <h3>{{ __('_record.new') }}</h3>

        @if ($errors->any())
        <div class="alert alert-danger">
            Необходимо выбрать услугу
        </div>
        @endif

        <form class="bk-form" action="{{ route('payments.store') }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                <div class="bk-form__field">
                    <label class="bk-form__label">{{ __('_field.service') }}</label>
                    <table class="dataTables table table-bordered table-responsive">
                        <thead class="thead-light">
                            <tr>
                                <th class="w-00 bk-min-w-250">{{ __('_field.name') }}</th>
                                <th class="w-25 bk-min-w-150 text-center">{{ __('_field.attendance') }}</th>
                                <th class="w-25 bk-min-w-150 text-center">{{ __('_field.service_kid') }}</th>
                                <th class="w-25 bk-min-w-150 text-center">{{ __('_field.service_student') }}</th>
                                <th class="w-25 bk-min-w-150 text-center">{{ __('_field.service_adult') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($activities as $activity)
                            @foreach($types as $type_id => $type)
                                <tr>
                                    <td>
                                        <ul>
                                            <li class="text-primary">{{ $activity->name }}</li>
                                            <li class="font-weight-bold">{{ $type }}</li>
                                        </ul>
                                    </td>
                                    <td class="payment-cell">
                                        <div class="payment-unit">
                                            {{ $type_id == 1 ? 1 : 12 }}
                                            {{ $type_id == 1 ? ' посещение' : ' посещений' }}
                                        </div>
                                    </td>
                                    @foreach($services as $service)
                                        @if($service->type_id == $type_id && $service->activity_id == $activity->id)
                                            @foreach($categories as $category)
                                                @if($service->category_id == $category->id)
                                                    <td class="payment-cell">
                                                        <input type="radio"
                                                               class="payment-input"
                                                               id="service-{{ $service->id }}"
                                                               name="service"
                                                               data-service="{{ $service->id }}"
                                                               data-activity="{{ $service->activity_id }}"
                                                               data-type="{{ $service->type_id }}"
                                                               data-price="{{ $service->price }}">
                                                        <label class="payment-label" for="service-{{ $service->id }}">
                                                            {{ format_money_for_display($service->price, 0) . ' ₽' }}
                                                        </label>
                                                    </td>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bk-form__field d-none" id="js-client-block">
                    <label class="bk-form__label" for="client_id">
                        {{ __('_field.client') }}
                        <a class="text-primary" href="{{ route('payments.clients.create') }}">
                            (Новый клиент)
                        </a>
                    </label>
                    <select id="client_id" name="client_id">
                        <option value="" disabled hidden selected>Выбрать</option>
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}" data-discount="{{ $client->benefit ? $client->benefit->discount : 0 }}">
                            {{ $client->full_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="bk-form__field d-none" id="js-discount-block">
                    <label class="bk-form__label">
                        {{ __('_field.discount') }}
                        <span class="bk-field bk-field--tip" id="js-discount-tip"></span>
                    </label>
                    <div class="bk-form__text" id="js-discount-text"></div>
                    <input type="hidden" id="discount">
                    <input type="hidden" id="activity_id" name="activity_id">
                    <input type="hidden" id="service_id" name="service_id">
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.amount') }}
                    </label>
                    <div class="bk-form__text" id="js-amount-text">{{ __('_select.service') }}</div>
                    <input type="hidden" id="amount" name="amount"/>
                </div>
                <div class="mt-1 mb-0 form-group">
                    <button class="btn btn-outline-success">
                        {{ __('_action.save') }}
                    </button>
                    <a class="btn btn-outline-secondary" href="{{ route('payments.index') }}">
                        {{ __('_action.back') }}
                    </a>
                </div>
            </div>
        </form>
    </section>
@endsection
