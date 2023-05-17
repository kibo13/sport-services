@extends('auth.index')

@section('title-auth', 'Сброс пароля')

@section('content-auth')
    <form class="auth-form" action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <input type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   id="email"
                   name="email"
                   value="{{ $email ?? old('email') }}"
                   placeholder="E-mail"
                   autocomplete="email"
                   autofocus
                   required>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   id="password"
                   name="password"
                   placeholder="Новый пароль"
                   autocomplete="new-password"
                   required>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password"
                   class="form-control"
                   id="password-confirm"
                   name="password_confirmation"
                   placeholder="Повторите пароль"
                   autocomplete="new-password"
                   required>
        </div>
        <button type="submit" class="btn btn-primary">
            Сбросить
        </button>
    </form>
@endsection
