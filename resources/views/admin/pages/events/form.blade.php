@extends('admin.index')

@section('title-admin', __('_section.events'))

@section('content-admin')
    <section id="event-form">
        <h3>{{ isset($event) ? __('_record.edit') : __('_record.new')  }}</h3>
        <form class="bk-form" action="{{ isset($event) ? route('events.update', $event) : route('events.store') }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                @isset($event)
                    @method('PUT')
                @endisset
                <div class="bk-form__field">
                    <label class="bk-form__label" for="title">
                        {{ __('_field.name') }}
                    </label>
                    <input class="bk-form__input"
                           id="title"
                           type="text"
                           name="title"
                           value="{{ isset($event) ? $event->title : null }}"
                           required/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="specialization_id">
                        {{ __('_field.event_type') }}
                    </label>
                    <select class="bk-form__select bk-max-w-300" id="specialization_id" name="specialization_id" required>
                        <option value="" disabled hidden selected>Выбрать</option>
                        @foreach($specializations as $specialization)
                        <option value="{{ $specialization->id }}" @isset($event) @if($event->specialization_id == $specialization->id) selected @endif @endisset>
                            {{ $specialization->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="trainer_id">
                        {{ __('_field.trainer') }}
                    </label>
                    <select class="bk-form__select bk-max-w-300" id="trainer_id" name="trainer_id" required>
                        <option value="" disabled hidden selected>Выбрать</option>
                        @foreach($trainers as $trainer)
                            <option value="{{ $trainer->id }}" @isset($event) @if($event->trainer_id == $trainer->id) selected @endif @endisset>
                                {{ $trainer->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="start">
                        {{ __('_field.event_date') }}
                    </label>
                    <input class="bk-form__input bk-max-w-300"
                           id="start"
                           type="date"
                           name="start"
                           value="{{ isset($event) ? $event->start : null }}"
                           min="{{ date('Y-m-d', strtotime('+5 days')) }}"
                           required/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="place">
                        {{ __('_field.event_place') }}
                    </label>
                    <input class="bk-form__input"
                           id="place"
                           type="text"
                           name="place"
                           value="{{ isset($event) ? $event->place : null }}"/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="note">
                        {{ __('_field.note') }}
                    </label>
                    <textarea class="bk-form__textarea"
                              id="note"
                              name="note">{{ isset($event) ? $event->note : null }}</textarea>
                </div>
                <div class="mt-1 mb-0 form-group">
                    <button class="btn btn-outline-success">
                        {{ __('_action.save') }}
                    </button>
                    <a class="btn btn-outline-secondary" href="{{ route('events.index') }}">
                        {{ __('_action.back') }}
                    </a>
                </div>
            </div>
        </form>
    </section>
@endsection
