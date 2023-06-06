@extends('admin.index')

@section('title-admin', __('_section.lessons'))

@section('content-admin')
    <section id="lesson-index">
        <h3>{{ __('_section.lessons') }}</h3>
        <h5>
            История посещения занятий
        </h5>
        <hr>
        @foreach($activities as $activity)
        @foreach($cards as $card)
        @if ($card->activity_id == $activity->id)
        <table class="dataTables table table-bordered table-responsive">
            <tbody>
                <tr class="font-weight-bold">
                    <td rowspan="2" class="align-middle">{{ $activity->name }}</td>
                    <td colspan="12" class="text-center">Кол-во посещений</td>
                </tr>
                <tr class="text-center font-weight-bold">
                    @foreach($card->lessons as $lesson)
                    <td class="text-center bk-min-w-100">{{ $lesson->number }}</td>
                    @endforeach
                </tr>
                <tr class="font-weight-bold">
                    <td>
                        {{ __('_field.date') }}
                    </td>
                    @foreach($card->lessons as $lesson)
                    <td class="text-center {{ $lesson->is_attended ? 'text-success' : 'text-muted' }}">
                        {{ $lesson->attended_at ? format_date_for_display($lesson->attended_at) : null }}
                    </td>
                    @endforeach
                </tr>
                <tr class="font-weight-bold">
                    <td>
                        {{ __('_field.mark') }}
                    </td>
                    @foreach($card->lessons as $lesson)
                    <td class="text-center {{ $lesson->is_attended ? 'text-success' : 'text-muted' }}">
                        {{ $lesson->is_attended ? '∨' : null }}
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        @endif
        @endforeach
        @endforeach
    </section>
@endsection
