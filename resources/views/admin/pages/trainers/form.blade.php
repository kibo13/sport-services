@extends('admin.index')

@section('title-admin', __('_section.trainers'))

@section('content-admin')
    <section id="trainers-form">
        <h3>{{ __('_record.edit') }}</h3>
        <form class="bk-form" action="{{ route('trainers.update', $trainer) }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                @method('PUT')
                <div class="bk-form__field">
                    <a href="{{ $trainer->photo ? asset('/storage/' . $trainer->photo) : asset('/assets/icons/anonymous.svg') }}" target="_blank">
                        <img class="bk-form__photo"
                             src="{{ $trainer->photo ? asset('/storage/' . $trainer->photo) : asset('/assets/icons/anonymous.svg') }}"
                             alt="{{ $trainer->full_name }}">
                    </a>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.fio') }}
                    </label>
                    <div class="bk-form__text">
                        {{ $trainer->full_name }}
                    </div>
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
                        {{ __('_field.specializations') }}
                    </label>
                    <ul class="bk-form__text">
                        @foreach($specializations as $specialization)
                            <li class="form-check">
                                <input class="form-check-input"
                                       id="specialization-{{ $specialization->id }}"
                                       type="checkbox"
                                       name="specializations[]"
                                       value="{{ $specialization->id }}"
                                       @if($trainer->specializations->where('id', $specialization->id)->count()) checked @endif>
                                <label class="form-check-label" for="specialization-{{ $specialization->id }}">
                                    {{ $specialization->name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
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
                <div class="mt-1 mb-0 form-group">
                    <button class="btn btn-outline-success">
                        {{ __('_action.save') }}
                    </button>
                    <a class="btn btn-outline-secondary" href="{{ route('trainers.index') }}">
                        {{ __('_action.back') }}
                    </a>
                </div>
            </div>
        </form>
    </section>
@endsection
