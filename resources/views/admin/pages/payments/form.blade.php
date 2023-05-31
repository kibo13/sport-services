@extends('admin.index')

@section('title-admin', __('_section.payments'))

@section('content-admin')
    <section id="payments-form">
        <h3>{{ isset($payment) ? __('_record.edit') : __('_record.new')  }}</h3>
        <form class="bk-form" action="{{ isset($payment) ? route('payments.update', $payment) : route('payments.store') }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                @isset($payment)
                @method('PUT')
                @endisset
                <div class="bk-form__field">
                    <label class="bk-form__label" for="visit_id">
                        {{ __('_field.discount') }}
                    </label>
                    <select class="bk-form__select bk-max-w-300" id="visit_id" name="visit_id" required>
                        <option value="" disabled hidden selected>Выбрать</option>
{{--                        @foreach($visits as $visit)--}}
{{--                        <option value="{{ $visit }}" @isset($payment) @if($payment->visit_id == $visit->id) selected @endif @endisset>--}}
{{--                            {{  }}--}}
{{--                        </option>--}}
{{--                        @endforeach--}}
                    </select>
                </div>
{{--                <div class="bk-form__field">--}}
{{--                    <label class="bk-form__label" for="name">--}}
{{--                        {{ __('_field.name') }}--}}
{{--                    </label>--}}
{{--                    <input class="bk-form__input"--}}
{{--                           id="name"--}}
{{--                           type="text"--}}
{{--                           name="name"--}}
{{--                           value="{{ isset($payment) ? $payment->name : null }}"--}}
{{--                           required/>--}}
{{--                </div>--}}
{{--                <div class="bk-form__field">--}}
{{--                    <label class="bk-form__label" for="discount">--}}
{{--                        {{ __('_field.discount') }}--}}
{{--                        <span class="bk-field bk-field--tip">--}}
{{--                            %--}}
{{--                        </span>--}}
{{--                    </label>--}}
{{--                    <input class="bk-form__input bk-max-w-100"--}}
{{--                           id="discount"--}}
{{--                           type="number"--}}
{{--                           name="discount"--}}
{{--                           value="{{ isset($payment) ? $payment->discount * 100 : null }}"--}}
{{--                           min="10"--}}
{{--                           max="100"--}}
{{--                           required/>--}}
{{--                </div>--}}
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
