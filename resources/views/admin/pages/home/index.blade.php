@extends('admin.index')

@section('title-admin', __('_section.home'))

@section('scripts')
    <script src="{{ mix('js/modules/event-calendar.js') }}"></script>
@endsection

@section('content-admin')
    <section>
        <h3>{{ __('_section.home') }}</h3>
        <input type="hidden" id="is_director" value="{{ auth()->user()->isAdmin() }}">
        <div id="events"></div>
    </section>
@endsection
