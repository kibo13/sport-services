@extends('admin.index')

@section('title-admin', __('_section.educations'))

@section('content-admin')
    <section id="education-form">
        <h3>{{ isset($education) ? __('_record.edit') : __('_record.new')  }}</h3>
        <form class="bk-form" action="{{ isset($education) ? route('educations.update', $education) : route('educations.store') }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                @isset($education)
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
                           value="{{ isset($education) ? $education->name : null }}"
                           required/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="note">
                        {{ __('_field.note') }}
                    </label>
                    <textarea class="bk-form__textarea"
                              id="note"
                              name="note">{{ isset($education) ? $education->note : null }}</textarea>
                </div>
                <div class="mt-1 mb-0 form-group">
                    <button class="btn btn-outline-success">
                        {{ __('_action.save') }}
                    </button>
                    <a class="btn btn-outline-secondary" href="{{ route('educations.index') }}">
                        {{ __('_action.back') }}
                    </a>
                </div>
            </div>
        </form>
    </section>
@endsection
