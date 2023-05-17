@extends('auth.index')

@section('title-auth', 'Регистрация')

@section('content-auth')
    <form class="auth-form" action="{{ route('register') }}" method="POST">
        @csrf
{{--        <div class="form-group">--}}
{{--            <input type="text"--}}
{{--                   class="form-control @error('name') is-invalid @enderror"--}}
{{--                   id="name"--}}
{{--                   name="name"--}}
{{--                   placeholder="Имя"--}}
{{--                   required>--}}
{{--            @error('name')--}}
{{--            <span class="invalid-feedback" role="alert">--}}
{{--                <strong>{{ $message }}</strong>--}}
{{--            </span>--}}
{{--            @enderror--}}
{{--        </div>--}}
        <div class="form-group">
            <input type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   id="email"
                   name="email"
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
                   class="form-control @error('password') is-invalid @enderror"
                   id="password"
                   name="password"
                   placeholder="Придумайте пароль"
                   required>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
{{--        <div class="form-group">--}}
{{--            <input type="password"--}}
{{--                   class="form-control"--}}
{{--                   id="password-confirm"--}}
{{--                   name="password_confirmation"--}}
{{--                   placeholder="Повторите пароль"--}}
{{--                   autocomplete="new-password"--}}
{{--                   required>--}}
{{--        </div>--}}
        <button type="submit" class="btn btn-primary">
            Регистрация
        </button>
        <hr>
        <div class="d-flex justify-content-center">
            <a class="text-dark" href="{{ route('login') }}">
                Уже зарегистрированы? Войти
            </a>
        </div>
    </form>
@endsection
