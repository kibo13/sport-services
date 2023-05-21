@extends('admin.index')

@section('title-admin', __('_section.profile'))

@section('content-admin')
    <section id="profile-form" class="bk-overflow-hidden">
        <h3>{{ __('_section.profile') }}</h3>

        @if(session()->has('success') || session()->has('warning'))
        @foreach(['success', 'warning'] as $alert)
        @if(session()->has($alert))
        <div class="my-2 alert alert-{{ $alert }}" role="alert">
            {{ session()->get($alert) }}
        </div>
        @endif
        @endforeach
        @endif

        <form class="bk-form" action="{{ route('profile.update', $user) }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                @method('PUT')
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.last_name') }}
                    </label>
                    <div class="bk-form__text">
                        {{ $user->surname }}
                    </div>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.first_name') }}
                    </label>
                    <div class="bk-form__text">
                        {{ $user->name }}
                    </div>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="patronymic">
                        {{ __('_field.middle_name') }}
                    </label>
                    <input type="text"
                           class="bk-form__input bk-max-w-250"
                           id="patronymic"
                           name="patronymic"
                           value="{{ $user->patronymic }}">
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="birthday">
                        {{ __('_field.birthday') }}
                    </label>
                    <input type="date"
                           class="bk-form__input bk-max-w-250"
                           id="birthday"
                           name="birthday"
                           value="{{ $user->birthday }}"
                           max="{{ now()->subYears(7)->format('Y-m-d') }}">
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="phone">
                        {{ __('_field.phone') }}
                    </label>
                    <input type="tel"
                           class="bk-form__input bk-max-w-250"
                           id="phone"
                           name="phone"
                           value="{{ $user->phone }}">
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="email">
                        {{ __('_field.email') }}
                    </label>
                    <input type="email"
                           class="bk-form__input bk-max-w-250"
                           id="email"
                           name="email"
                           value="{{ $user->email }}">
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="">
                        {{ __('_field.password') }}
                        {{ @tip('мин.длина пароля 8 символов') }}
                    </label>
                    <input class="bk-form__input bk-max-w-250 @error('password') border border-danger @enderror"
                           type="password"
                           name="password"
                           placeholder="Новый пароль"
                           autocomplete="off"/>
                    <input class="bk-form__input bk-max-w-250 @error('password') border border-danger @enderror"
                           type="password"
                           name="password_confirmation"
                           placeholder="Повторите пароль"
                           autocomplete="off"/>
                    @error('password')
                    <div class="bk-validation">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-1 mb-0 form-group">
                    <button class="btn btn-outline-success">
                        {{ __('_action.save') }}
                    </button>
                </div>
            </div>
        </form>
    </section>
@endsection
