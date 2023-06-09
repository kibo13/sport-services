@extends('layouts.master')

@section('content-head')
    <title>@yield('title-admin') | {{ config('app.name') }} </title>

    <!-- vendors -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/vendors/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors/select2.min.css') }}">
    <script src="{{ asset('js/vendors/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/vendors/popper.min.js') }}" defer></script>
    <script src="{{ asset('js/vendors/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/vendors/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('js/vendors/chart.min.js') }}" defer></script>
    <script src="{{ asset('js/vendors/moment.min.js') }}" defer></script>
    <script src="{{ asset('js/vendors/fullcalendar.min.js') }}" defer></script>
    <script src="{{ asset('js/vendors/select2.min.js') }}" defer></script>

    <!-- custom -->
    <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
    <script src="{{ mix('js/admin.js') }}" defer></script>
@endsection

@section('content-body')
    <div class="admin">
        @include('admin.partials.sidebar')
        <div class="admin-wrapper">
            <div class="admin-navbar">
                @include('admin.partials.navbar')
            </div>
            <div class="admin-content">
                @yield('content-admin')
            </div>
        </div>
    </div>
    @include('components.modals.client')
    @include('components.modals.delete')
    @include('components.modals.option')
    @include('components.modals.place')
    @include('components.modals.timetable')
    @yield('scripts')
@endsection
