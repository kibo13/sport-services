@extends('admin.index')

@section('title-admin', __('_section.clients'))

@section('content-admin')
    <section id="client-form">
        <h3>{{ __('_record.edit') }}</h3>
        <form class="bk-form" action="{{ route('clients.update', $client) }}" method="POST" enctype="multipart/form-data">
            <div class="bk-form__wrapper">
                @csrf
                @method('PUT')
                <div class="bk-form__field">
                    <a href="{{ $client->photo ? asset('/storage/' . $client->photo) : asset('/assets/icons/anonymous.svg') }}" target="_blank">
                        <img class="bk-form__photo"
                             src="{{ $client->photo ? asset('/storage/' . $client->photo) : asset('/assets/icons/anonymous.svg') }}"
                             alt="{{ $client->full_name }}">
                    </a>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.fio') }}
                    </label>
                    <div class="bk-form__text">
                        {{ $client->full_name }}
                    </div>
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
                <div class="bk-form__field">
                    <label class="bk-form__label" for="benefit_id">
                        {{ __('_field.discount') }}
                    </label>
                    <select class="bk-form__select bk-max-w-300" id="benefit_id" name="benefit_id">
                        <option value="" selected>Выбрать</option>
                        @foreach($benefits as $benefit)
                        <option value="{{ $benefit->id }}" @isset($client) @if($client->benefit_id == $benefit->id) selected @endif @endisset>
                            {{ $benefit->name . ' (' . format_discount_for_display($benefit->discount) . ')' }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="bk-form__field position-relative">
                    <label class="bk-form__label" for="certificate">
                        {{ __('_field.discount_doc') }}
                    </label>
                    <input class="bk-form__input"
                           type="text"
                           value="{{ $client->certificate ?? null }}"
                           placeholder="{{ __('_field.file_not') }}"
                           disabled/>
                    <input class="bk-form__file"
                           data-file="upload"
                           type="file"
                           name="certificate"
                           accept="image/*"/>
                </div>
                <div class="mt-1 mb-0 form-group">
                    <button class="btn btn-outline-success">
                        {{ __('_action.save') }}
                    </button>
                    <a class="btn btn-outline-secondary" href="{{ route('clients.index') }}">
                        {{ __('_action.back') }}
                    </a>
                </div>
            </div>
        </form>
    </section>
@endsection
