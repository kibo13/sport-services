@extends('layouts.master')

@section('content-head')
    <title>@yield('title-auth') | {{ config('app.name') }} </title>
    <link rel="stylesheet" href="{{ asset('css/vendors/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/auth.css') }}">
@endsection

@section('content-body')
    <div class="auth">
        @foreach (session()->all() as $key => $value)
        @if (in_array($key, ['message', 'success', 'error']))
        <div class="auth-alert alert alert-{{ $key == 'success' ? 'success' : 'danger' }}">
            {{ $value }}
        </div>
        @endif
        @endforeach
        <div class="auth-container">
            <h4>@yield('title-auth')</h4>
            @yield('content-auth')
        </div>
        <div class="auth-mai">
            <a class="auth-mai__link" href="{{ route('mai') }}">
                Автоматизированная информационная система организации спортивно-оздоровительных услуг
            </a>
        </div>
    </div>
@endsection
