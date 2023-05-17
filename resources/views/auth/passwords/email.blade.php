@extends('auth.index')

@section('title-auth', 'Восстановление пароля')

@section('content-auth')
    <form class="auth-form" action="{{ route('password.email') }}" method="POST">
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
        <button type="submit" class="btn btn-primary">
            Восстановить
        </button>
        <hr>
        <div class="d-flex justify-content-center">
            <a class="text-dark" href="{{ route('login') }}">
                Я вспомнил пароль
            </a>
        </div>
    </form>
@endsection
