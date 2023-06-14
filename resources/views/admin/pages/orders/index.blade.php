@extends('admin.index')

@section('title-admin', __('_section.orders'))

@section('content-admin')
    <section id="order-index">
        <h3>{{ __('_section.orders') }}</h3>

        @if(auth()->user()->isClient())
        <div class="my-2 btn-group">
            <a class="btn btn-primary" href="{{ route('orders.create') }}">
                {{ __('_record.new') }}
            </a>
        </div>
        @endif

        @if(session()->has('success'))
        <div class="my-2 alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif

        @if(auth()->user()->isClient())
        @include('admin.pages.orders.tables.client')
        @else
        @include('admin.pages.orders.tables.admin')
        @endif
    </section>
@endsection
