@extends('admin.index')

@section('title-admin', __('_section.settings'))

@section('content-admin')
    <section id="option-form">
        <h3>{{ __('_section.settings') }}</h3>

        @foreach(['success', 'warning'] as $alert)
        @if(session()->has($alert))
        <div class="my-2 alert alert-{{ $alert }}" role="alert">
            {{ session()->get($alert) }}
        </div>
        @endif
        @endforeach

        <div class="bk-tabs">
            @if(auth()->user()->isOwner() || auth()->user()->isMethodist())
            <input class="bk-tabs__input bk-tab-1"
                   id="tab-1"
                   type="radio"
                   name="tab"
                   checked>
            <label class="bk-tabs__label" for="tab-1">
                {{ __('_section.timetable') }}
            </label>
            @endif
            @if(auth()->user()->isOwner() || auth()->user()->isPaymaster())
            <input class="bk-tabs__input bk-tab-2"
                   id="tab-2"
                   type="radio"
                   name="tab">
            <label class="bk-tabs__label" for="tab-2">
                {{ __('_section.payments') }}
            </label>
            @endif
            @if(auth()->user()->isOwner() || auth()->user()->isMethodist())
            <div class="bk-tabs__content bk-tab-content-1">
                @include('admin.pages.options.tabs.timetable')
            </div>
            @endif
            @if(auth()->user()->isOwner() || auth()->user()->isPaymaster())
            <div class="bk-tabs__content bk-tab-content-2">
                @include('admin.pages.options.tabs.payments')
            </div>
            @endif
        </div>
    </section>
@endsection
