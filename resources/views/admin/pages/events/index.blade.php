@extends('admin.index')

@section('title-admin', __('_section.events'))

@section('content-admin')
    <section id="events-index">
        <h3>{{ __('_section.events') }}</h3>

        @if(is_access('event_full'))
            <div class="my-2 btn-group">
                <a class="btn btn-primary" href="{{ route('events.create') }}">
                    {{ __('_record.new') }}
                </a>
            </div>
        @endif

        @if(session()->has('success'))
            <div class="my-2 alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif

        <table id="is-datatable" class="dataTables table table-bordered table-hover table-responsive">
            <thead class="thead-light">
            <tr>
                <th>#</th>
                <th class="w-25 bk-min-w-250">{{ __('_field.name') }}</th>
                <th class="w-25 bk-min-w-250">{{ __('_field.type') }}</th>
                <th class="w-25 bk-min-w-250">{{ __('_field.date') }}</th>
                <th class="w-25 bk-min-w-250">{{ __('_field.trainer') }}</th>
                @if(is_access('event_full'))
                <th class="no-sort">{{ __('_action.this') }}</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $event->name }}</td>
                    <td>{{ \App\Enums\Event\EventType::NAMES[$event->type_id] }}</td>
                    <td>{{ format_date_for_display($event->event_date) }}</td>
                    <td title="{{ $event->trainer->full_name }}">
                        {{ $event->trainer->short_name }}
                    </td>
                    @if(is_access('event_full'))
                        <td>
                            <div class="bk-btn-actions">
                                <a class="bk-btn-action bk-btn-action--edit btn btn-warning"
                                   href="{{ route('events.edit', $event) }}"
                                   title="{{ __('_action.edit') }}" ></a>
                                <a class="bk-btn-action bk-btn-action--delete btn btn-danger"
                                   href="javascript:void(0)"
                                   data-id="{{ $event->id }}"
                                   data-toggle="modal"
                                   data-target="#bk-delete-modal"
                                   title="{{ __('_action.delete') }}" ></a>
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
