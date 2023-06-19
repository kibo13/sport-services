<form class="bk-form" action="{{ route('profile.update', $user) }}" method="POST">
    <div class="bk-form__wrapper">
        @csrf
        @method('PUT')
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.photo') }}
            </label>
            <a href="{{ $user->photo ? asset('/storage/' . $user->photo) : asset('/assets/icons/anonymous.svg') }}" target="_blank">
                <img class="bk-form__photo"
                     id="photo"
                     src="{{ $user->photo ? asset('/storage/' . $user->photo) : asset('/assets/icons/anonymous.svg') }}"
                     alt="{{ $user->full_name }}">
            </a>
            <label class="btn btn-outline-primary bk-max-w-250" for="profile-photo">
                {{ __('_action.set') }}
            </label>
            <input class="d-none" type="file" id="profile-photo" accept="image/*">
        </div>
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
                   class="bk-form__input bk-max-w-250 @error('phone') border border-danger @enderror"
                   id="phone"
                   name="phone"
                   value="{{ $user->phone }}">
            @error('phone')
            <small class="bk-validation">
                {{ $message }}
            </small>
            @enderror
            @if(auth()->user()->isClient())
                <div class="form-check">
                    <input type="hidden" name="is_notify" value="0">
                    <input type="checkbox"
                           class="form-check-input"
                           id="is_notify"
                           name="is_notify"
                           value="1" {{ $user->is_notify ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_notify">
                        Получать SMS-уведомления
                    </label>
                </div>
            @endif
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label" for="email">
                {{ __('_field.email') }}
            </label>
            <input type="email"
                   class="bk-form__input bk-max-w-250 @error('email') border border-danger @enderror"
                   id="email"
                   name="email"
                   value="{{ $user->email }}">
            @error('email')
            <small class="bk-validation">
                {{ $message }}
            </small>
            @enderror
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label" for="address">
                {{ __('_field.address') }}
            </label>
            <input type="text"
                   class="bk-form__input"
                   id="address"
                   name="address"
                   value="{{ $user->address }}">
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.password') }}
                <span class="bk-field bk-field--tip">
                            мин.длина пароля 8 символов
                        </span>
            </label>
            <input class="bk-form__input bk-max-w-250 @error('password') border border-danger @enderror"
                   type="password"
                   name="password"
                   placeholder="Новый пароль"
                   minlength="8"
                   autocomplete="off"/>
            <input class="bk-form__input bk-max-w-250 @error('password') border border-danger @enderror"
                   type="password"
                   name="password_confirmation"
                   placeholder="Повторите пароль"
                   minlength="8"
                   autocomplete="off"/>
            @error('password')
            <div class="bk-validation">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mt-1 mb-0 form-group">
            <button class="btn btn-outline-success" type="submit">
                {{ __('_action.save') }}
            </button>
        </div>
    </div>
</form>
