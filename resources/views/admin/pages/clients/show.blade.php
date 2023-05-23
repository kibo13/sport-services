@extends('admin.index')

@section('title-admin', __('_section.clients'))

@section('content-admin')
    <section id="clients-show">
        <h4>{{ $client->full_name }}</h4>
        <div class="bk-form__field">
            <a href="{{ $client->photo ? asset('/storage/' . $client->photo) : asset('/assets/icons/anonymous.svg') }}" target="_blank">
                <img class="bk-form__photo"
                     src="{{ $client->photo ? asset('/storage/' . $client->photo) : asset('/assets/icons/anonymous.svg') }}"
                     alt="{{ $client->full_name }}">
            </a>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.age') }}
            </label>
            <div class="bk-form__text">
                {{ $client->age }}
            </div>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.birthday') }}
            </label>
            <div class="bk-form__text">
                {{ format_date_for_display($client->birthday) }}
            </div>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.phone') }}
            </label>
            <div class="bk-form__text">
                {{ format_phone_number_for_display($client->phone) }}
            </div>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.email') }}
            </label>
            <div class="bk-form__text">
                {{ $client->email }}
            </div>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.address') }}
            </label>
            <div class="bk-form__text">
                {{ $client->address }}
            </div>
        </div>
        <div class="my-2 form-group">
            <a class="btn btn-secondary" href="{{ route('clients.index') }}">
                {{ __('_action.back') }}
            </a>
        </div>
    </section>
@endsection
