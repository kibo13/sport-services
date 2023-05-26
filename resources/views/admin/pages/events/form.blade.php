@extends('admin.index')

@section('title-admin', __('_section.events'))

@section('content-admin')
    <section id="events-form">
        <h3>{{ isset($event) ? __('_record.edit') : __('_record.new')  }}</h3>
        <form class="bk-form" action="{{ isset($event) ? route('events.update', $event) : route('events.store') }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                @isset($event)
                    @method('PUT')
                @endisset
                <div class="bk-form__field">
                    <label class="bk-form__label" for="name">
                        {{ __('_field.name') }}
                    </label>
                    <input class="bk-form__input"
                           id="name"
                           type="text"
                           name="name"
                           value="{{ isset($event) ? $event->name : null }}"
                           required/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="type_id">
                        {{ __('_field.type') }}
                    </label>
                    <select class="bk-form__select bk-max-w-300" id="type_id" name="type_id" required>
                        <option value="" disabled hidden selected>Выбрать</option>
                        @foreach($types as $id => $name)
                            <option value="{{ $id }}" @isset($event) @if($event->type_id == $id) selected @endif @endisset>
                                {{ $name }}
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
                    <label class="bk-form__label" for="event_date">
                        {{ __('_field.date_till') }}
                    </label>
                    <input class="bk-form__input bk-max-w-300"
                           id="event_date"
                           type="date"
                           name="event_date"
                           value="{{ isset($event) ? $event->event_date : null }}"
                           min="{{ date('Y-m-d') }}"
                           required/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="venue">
                        {{ __('_field.venue') }}
                    </label>
                    <textarea class="bk-form__textarea"
                              id="venue"
                              name="venue">{{ isset($event) ? $event->venue : null }}</textarea>
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
