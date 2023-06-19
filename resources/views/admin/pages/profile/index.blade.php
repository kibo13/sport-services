@extends('admin.index')

@section('title-admin', __('_section.profile'))

@section('scripts')
    <script src="{{ mix('js/helpers/input-mask.js') }}"></script>
@endsection

@section('content-admin')
    <section id="profile-form">
        <h3>{{ __('_section.profile') }}</h3>

        @if(session()->has('success') || session()->has('warning'))
        @foreach(['success', 'warning'] as $alert)
        @if(session()->has($alert))
        <div class="my-2 alert alert-{{ $alert }}" role="alert">
            {{ session()->get($alert) }}
        </div>
        @endif
        @endforeach
        @endif

        <div class="bk-tabs">
            <input class="bk-tabs__input bk-tab-1"
                   id="tab-1"
                   type="radio"
                   name="tab"
                   checked>
            <label class="bk-tabs__label" for="tab-1">
                {{ __('_field.overview') }}
            </label>
            @if(auth()->user()->isClient())
            <input class="bk-tabs__input bk-tab-2"
                   id="tab-2"
                   type="radio"
                   name="tab">
            <label class="bk-tabs__label" for="tab-2">
                {{ __('_field.medical_card') }}
            </label>
            @endif
            <div class="bk-tabs__content bk-tab-content-1">
                @include('admin.pages.profile.tabs.form')
            </div>
            @if(auth()->user()->isClient())
            <div class="bk-tabs__content bk-tab-content-2">
                @include('admin.pages.profile.tabs.medical-card')
            </div>
            @endif
        </div>
    </section>
@endsection
