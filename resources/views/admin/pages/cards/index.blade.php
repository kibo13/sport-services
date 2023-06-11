@extends('admin.index')

@section('title-admin', __('_section.cards'))

@section('content-admin')
    <section id="cards-index">
        <h3>{{ __('_section.cards') }}</h3>

        @if(session()->has('success'))
        <div class="my-2 alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif

        <div class="bk-tabs">
            <input class="bk-tabs__input bk-tab-1"
                   id="tab-1"
                   type="radio"
                   name="tab"
                   checked>
            <label class="bk-tabs__label" for="tab-1">
                Активные
            </label>
            <input class="bk-tabs__input bk-tab-2"
                   id="tab-2"
                   type="radio"
                   name="tab">
            <label class="bk-tabs__label" for="tab-2">
                Неактивные
            </label>
            <div class="bk-tabs__content bk-tab-content-1">
                @include('admin.pages.cards.tabs.active')
            </div>
            <div class="bk-tabs__content bk-tab-content-2">
                @include('admin.pages.cards.tabs.inactive')
            </div>
        </div>
    </section>
@endsection
