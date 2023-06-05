@extends('admin.index')

@section('title-admin', __('_section.clients'))

@section('scripts')
    <script src="{{ mix('js/helpers/input-mask.js') }}"></script>
@endsection

@section('content-admin')
    <section id="client-form">
        <h3>{{ __('_record.new') }}</h3>
        <form class="bk-form" action="{{ route('payments.clients.store') }}" method="POST" enctype="multipart/form-data">
            <div class="bk-form__wrapper">
                @csrf
                <div class="bk-form__field">
                    <label class="bk-form__label" for="name">
                        {{ __('_field.first_name') }}
                    </label>
                    <input class="bk-form__input bk-max-w-300"
                           id="name"
                           type="text"
                           name="name"
                           required/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="surname">
                        {{ __('_field.last_name') }}
                    </label>
                    <input class="bk-form__input bk-max-w-300"
                           id="surname"
                           type="text"
                           name="surname"
                           required/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="patronymic">
                        {{ __('_field.middle_name') }}
                    </label>
                    <input class="bk-form__input bk-max-w-300"
                           id="patronymic"
                           type="text"
                           name="patronymic"/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="birthday">
                        {{ __('_field.birthday') }}
                    </label>
                    <input class="bk-form__input bk-max-w-300"
                           id="birthday"
                           type="date"
                           name="birthday"
                           max="{{ date('Y-m-d', strtotime('-7 years')) }}"/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="phone">
                        {{ __('_field.phone') }}
                    </label>
                    <input class="bk-form__input bk-max-w-300"
                           id="phone"
                           type="text"
                           name="phone"
                           required/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="email">
                        {{ __('_field.email') }}
                    </label>
                    <input class="bk-form__input bk-max-w-300"
                           id="email"
                           type="email"
                           name="email"
                           required/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="benefit_id">
                        {{ __('_field.discount') }}
                    </label>
                    <select class="bk-form__select bk-max-w-300" id="benefit_id" name="benefit_id">
                        <option value="" selected>Выбрать</option>
                        @foreach($benefits as $benefit)
                        <option value="{{ $benefit->id }}">
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
                    <a class="btn btn-outline-secondary" href="{{ route('payments.create') }}">
                        {{ __('_action.back') }}
                    </a>
                </div>
            </div>
        </form>
    </section>
@endsection
