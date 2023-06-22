@extends('admin.index')

@section('title-admin', __('_section.home'))

@section('scripts')
    <script src="{{ mix('js/modules/event-calendar.js') }}"></script>
@endsection

@section('content-admin')
    <section>
        <h3>{{ __('_section.home') }}</h3>
        <div id="js-events"></div>
    </section>
@endsection
