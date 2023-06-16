@extends('admin.index')

@section('title-admin', __('_section.reports'))

@section('content-admin')
    <section id="report-index">
        <h3>{{ __('_section.reports') }}</h3>

        @if(session()->has('warning'))
        <div class="my-2 alert alert-warning" role="alert">
            {{ session()->get('warning') }}
        </div>
        @endif

        <select class="form-control" id="report-menu">
            <option disabled hidden selected>Выберите отчет</option>
            <option value="js-report-payments">Отчет по финансам</option>
            <option value="js-report-clients">Отчет по клиентам</option>
            <option value="js-report-events">Отчет по соревнованиям</option>
        </select>

        @include('admin.pages.reports.form.payments')
        @include('admin.pages.reports.form.clients')
        @include('admin.pages.reports.form.events')
    </section>
@endsection
