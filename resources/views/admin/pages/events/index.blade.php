@extends('admin.index')

@section('title-admin', __('_section.events'))

@section('content-admin')
    <section id="event-index">
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
                    <th class="w-25 bk-min-w-250">{{ __('_field.event_type') }}</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.event_dt') }}</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.trainer') }}</th>
                    <th class="w-00 bk-min-w-250">{{ __('_field.result') }}</th>
                    @if(is_access('event_full'))
                    <th class="no-sort">{{ __('_action.this') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->specialization->name }}</td>
                    <td>
                        {{ format_date_for_display($event->start) }}
                        <small class="align-text-top text-primary font-weight-bold">
                            {{ format_time_for_display($event->init) }}
                        </small>
                    </td>
                    <td title="{{ $event->trainer->full_name }}">
                        {{ $event->trainer->short_name }}
                    </td>
                    <td>
                        <ul>
                            @foreach($event->results as $result)
                            <li>
                                <span class="text-primary">
                                    {{ $loop->iteration . ' место: ' }}
                                </span>
                                @if(is_access('event_full'))
                                <a class="text-muted {{ $result->client_id ? null : 'text-lowercase' }}"
                                   href="{{ route('events.result', $result) }}"
                                   title="{{ $result->client_id ? $result->client->full_name : null }}">
                                    {{ $result->client_id ? $result->client->short_name : __('_action.set') }}
                                </a>
                                @else
                                <span class="text-muted text-lowercase">
                                    {{ __('_record.no') }}
                                </span>
                                @endif
                            </li>
                            @endforeach
                        </ul>
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
