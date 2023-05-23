@extends('admin.index')

@section('title-admin', __('_section.benefits'))

@section('content-admin')
    <section id="benefits-form">
        <h3>{{ isset($benefit) ? __('_record.edit') : __('_record.new')  }}</h3>

        <form class="bk-form" action="{{ isset($benefit) ? route('benefits.update', $benefit) : route('benefits.store') }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                @isset($benefit)
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
                           value="{{ isset($benefit) ? $benefit->name : null }}"
                           required/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="discount">
                        {{ __('_field.discount') }}
                        <span class="bk-field bk-field--tip">
                            %
                        </span>
                    </label>
                    <input class="bk-form__input bk-max-w-100"
                           id="discount"
                           type="number"
                           name="discount"
                           value="{{ isset($benefit) ? $benefit->discount * 100 : null }}"
                           min="10"
                           max="100"
                           required/>
                </div>
                <div class="mt-1 mb-0 form-group">
                    <button class="btn btn-outline-success">
                        {{ __('_action.save') }}
                    </button>
                    <a class="btn btn-outline-secondary" href="{{ route('benefits.index') }}">
                        {{ __('_action.back') }}
                    </a>
                </div>
            </div>
        </form>
    </section>
@endsection
