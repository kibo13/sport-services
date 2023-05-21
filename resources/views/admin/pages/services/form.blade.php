@extends('admin.index')

@section('title-admin', __('_section.services'))

@section('content-admin')
    <section id="services-form" class="bk-overflow-hidden">
        <h3>{{ isset($service) ? __('_record.edit') : __('_record.new')  }}</h3>

        <form class="bk-form" action="{{ isset($service) ? route('services.update', $service) : route('services.store') }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                @isset($service)
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
                           value="{{ isset($service) ? $service->name : null }}"
                           required/>
                </div>
                <div class="mt-1 mb-0 form-group">
                    <button class="btn btn-outline-success">
                        {{ __('_action.save') }}
                    </button>
                    <a class="btn btn-outline-secondary" href="{{ route('services.index') }}">
                        {{ __('_action.back') }}
                    </a>
                </div>
            </div>
        </form>
    </section>
@endsection
