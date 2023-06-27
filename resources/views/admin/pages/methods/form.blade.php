@extends('admin.index')

@section('title-admin', __('_section.methods'))

@section('content-admin')
    <section id="methods-form">
        <h3>{{ isset($method) ? __('_record.edit') : __('_record.new')  }}</h3>

        <form class="bk-form" action="{{ isset($method) ? route('methods.update', $method) : route('methods.store') }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                @isset($method)
                @method('PUT')
                @endisset
                <div class="bk-form__field">
                    <label class="bk-form__label" for="activity_id">
                        {{ __('_field.activity') }}
                    </label>
                    <select class="bk-form__input bk-max-w-300 @error('activity_id') border border-danger @enderror"
                            id="activity_id"
                            name="activity_id"
                            required>
                        <option value="" hidden selected>Выбрать</option>
                        @foreach($activities as $activity)
                        <option value="{{ $activity->id }}"
                                @isset($method)
                                @if($method->activity_id == $activity->id)
                                selected
                                @endif
                                @endisset>
                            {{ $activity->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('activity_id')
                    <small class="bk-validation">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="lesson">
                        {{ __('_field.lesson') }}
                    </label>
                    <input class="bk-form__input bk-max-w-100 @error('number') border border-danger @enderror"
                           id="lesson"
                           type="number"
                           name="number"
                           value="{{ isset($method) ? $method->number : null }}"
                           min="1"
                           max="12"
                           step="1"
                           required/>
                    @error('number')
                    <small class="bk-validation">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="content">{{ __('_field.content') }}</label>
                    <textarea class="bk-form__textarea" id="content" name="note">{{ isset($method) ? $method->note : null }}</textarea>
                </div>
                <div class="mt-1 mb-0 form-group">
                    <button class="btn btn-outline-success">
                        {{ __('_action.save') }}
                    </button>
                    <a class="btn btn-outline-secondary" href="{{ route('methods.index') }}">
                        {{ __('_action.back') }}
                    </a>
                </div>
            </div>
        </form>
    </section>
@endsection
