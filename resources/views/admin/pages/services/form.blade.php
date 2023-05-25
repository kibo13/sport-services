@extends('admin.index')

@section('title-admin', __('_section.services'))

@section('content-admin')
    <section id="services-form">
        <h3>{{ isset($service) ? __('_record.edit') : __('_record.new')  }}</h3>

        <form class="bk-form" action="{{ isset($service) ? route('services.update', $service) : route('services.store') }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                @isset($service)
                @method('PUT')
                @endisset
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.activity') }}
                    </label>
                    <div class="bk-form__text">
                        {{ ServiceActivity::NAMES[$service->activity_id] }}
                    </div>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.name') }}
                    </label>
                    <div class="bk-form__text">
                        {{ $service->name }}
                    </div>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.unit') }}
                    </label>
                    <div class="bk-form__text">
                        {{ $service->unit }}
                        <span class="bk-field bk-field--tip">
                            {{ $service->unit == 1 ? ' посещение' : ' посещений' }}
                        </span>
                    </div>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.category') }}
                    </label>
                    <div class="bk-form__text">
                        {{ ServiceCategory::NAMES[$service->category_id] }}
                    </div>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="price">
                        {{ __('_field.price') }}
                    </label>
                    <input class="bk-form__input bk-max-w-150"
                           id="price"
                           type="number"
                           name="price"
                           value="{{ $service->price }}"
                           min="50"
                           max="3000"
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
