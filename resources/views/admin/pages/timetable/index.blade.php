@extends('admin.index')

@section('title-admin', __('_section.timetable'))

@section('content-admin')
    <section id="timetable-index">
        <h3>{{ __('_section.timetable') }}</h3>

        <div class="mt-1 mb-2 bk-callout">
            <h5>Цветовые обозначения групп</h5>
            <hr>
            <div class="bk-grid bk-grid--gtc-150">
                @foreach($activities as $activity)
                    <div class="bk-grid bk-grid--gtr-30">
                        <h6>{{ $activity->name }}</h6>
                        @foreach($activity->groups as $group)
                            <div class="py-1 px-2 text-white rounded" style="background: {{ $group->color }};">
                                {{ $group->name }}
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        @foreach(['success', 'warning'] as $message)
        @if(session()->has($message))
        <div class="my-2 alert alert-{{ $message }}" role="alert">
            {{ session()->get($message) }}
        </div>
        @endif
        @endforeach

        @if(is_access('timetable_full') && $hasFullPermissions)
        <form class="my-2 bk-form" action="{{ route('timetable.generate') }}" method="POST">
            <div class="bk-form__wrapper">
                <div class="bk-grid bk-grid--gtc-150">
                    @csrf
                    <input class="form-control"
                           type="month"
                           name="month"
                           min="{{ date('Y-m') }}"
                           required>
                    <button class="btn btn-sm btn-primary">
                        {{ __('_action.generate') }}
                    </button>
                </div>
            </div>
        </form>
        @endif

        <input type="hidden" id="js-timetable-permission" value="{{ $hasFullPermissions ? 1 : 0 }}">
        <div id="js-timetable-calendar"></div>
    </section>
@endsection
