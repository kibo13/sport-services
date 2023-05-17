@extends('auth.index')

@section('title-auth', 'Авторизация')

@section('content-auth')
    <form class="auth-form" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   id="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="E-mail"
                   required>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password"
                   class="form-control @error('email') is-invalid @enderror"
                   id="password"
                   name="password"
                   placeholder="Пароль"
                   autocomplete="off"
                   required>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Войти
        </button>
        <hr>
        <div class="d-flex justify-content-between">
            <a class="text-dark" href="{{ route('password.request') }}">
                Забыли пароль?
            </a>
            <a class="text-dark" href="{{ route('register') }}">
                Регистрация
            </a>
        </div>
    </form>
@endsection
