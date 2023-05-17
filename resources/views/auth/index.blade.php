@extends('layouts.master')

@section('content-head')
    <title>@yield('title-auth') | {{ config('app.name') }} </title>
    <link rel="stylesheet" href="{{ mix('css/vendors/bootstrap.min.css') }}">
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
{{--            <div class="auth-header">--}}
{{--                <img class="auth-logo" src="{{ asset('images/logo.svg') }}" alt="logo">--}}
{{--            </div>--}}
            <h4>@yield('title-auth')</h4>
            @yield('content-auth')
        </div>
    </div>
@endsection
