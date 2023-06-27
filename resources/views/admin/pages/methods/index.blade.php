@extends('admin.index')

@section('title-admin', __('_section.methods'))

@section('content-admin')
    <section>
        <h3>{{ __('_section.methods') }}</h3>
        <div class="bk-tabs">
            <input class="bk-tabs__input bk-tab-1"
                   id="tab-1"
                   type="radio"
                   name="tab"
                   checked>
            <label class="bk-tabs__label" for="tab-1">
                {{ __('_section.table') }}
            </label>
            <input class="bk-tabs__input bk-tab-2"
                   id="tab-2"
                   type="radio"
                   name="tab">
            <label class="bk-tabs__label" for="tab-2">
                {{ __('_section.documents') }}
            </label>
            <div class="bk-tabs__content bk-tab-content-1">
                @include('admin.pages.methods.tabs.table')
            </div>
            <div class="bk-tabs__content bk-tab-content-2">
                @include('admin.pages.methods.tabs.documents')
            </div>
        </div>
    </section>
@endsection
