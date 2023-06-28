@extends('admin.index')

@section('title-admin', __('_section.events'))

@section('content-admin')
    <section>
        <h3>{{ $result->position . ' место' }}</h3>
        <form class="bk-form" action="{{ route('events.result.set', $result) }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.event') }}
                    </label>
                    <div class="bk-form__text">
                        {{ $result->event->title }}
                    </div>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.activity') }}
                    </label>
                    <div class="bk-form__text">
                        {{ $result->event->activity->name }}
                    </div>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="client_id">
                        {{ __('_field.event_type') }}
                    </label>
                    <select class="bk-form__select bk-max-w-300" id="client_id" name="client_id" required>
                        <option value="" hidden selected>Выбрать</option>
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}" @if($result->client_id == $client->id) selected @endif>
                            {{ $client->full_name }}
                        </option>
                        @endforeach
                    </select>
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
