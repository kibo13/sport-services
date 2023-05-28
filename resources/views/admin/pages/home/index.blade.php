@extends('admin.index')

@section('title-admin', __('_section.home'))

@section('content-admin')
    <section id="home-index">
        <h3>{{ __('_section.home') }}</h3>
        <input type="hidden" id="is_director" value="{{ auth()->user()->isAdmin() }}">
        <div id="events"></div>
    </section>
@endsection
