@extends('admin.index')

@section('title-admin', __('_section.trainers'))

@section('content-admin')
    <section id="trainers-show">
        <h4>{{ $trainer->full_name }}</h4>
        <div class="bk-form__field">
            <a href="{{ $trainer->photo ? asset('/storage/' . $trainer->photo) : asset('/assets/icons/anonymous.svg') }}" target="_blank">
                <img class="bk-form__photo"
                     src="{{ $trainer->photo ? asset('/storage/' . $trainer->photo) : asset('/assets/icons/anonymous.svg') }}"
                     alt="{{ $trainer->full_name }}">
            </a>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.age') }}
            </label>
            <div class="bk-form__text">
                {{ $trainer->age }}
            </div>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.birthday') }}
            </label>
            <div class="bk-form__text">
                {{ format_date_for_display($trainer->birthday) }}
            </div>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.phone') }}
            </label>
            <div class="bk-form__text">
                {{ format_phone_number_for_display($trainer->phone) }}
            </div>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.email') }}
            </label>
            <div class="bk-form__text">
                {{ $trainer->email }}
            </div>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.address') }}
            </label>
            <div class="bk-form__text">
                {{ $trainer->address }}
            </div>
        </div>
        <div class="my-2 form-group">
            <a class="btn btn-secondary" href="{{ route('trainers.index') }}">
                {{ __('_action.back') }}
            </a>
        </div>
    </section>
@endsection
