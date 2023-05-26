@extends('admin.index')

@section('title-admin', __('_section.passes'))

@section('content-admin')
    <section id="passes-index">
        <h3>{{ __('_section.passes') }}</h3>

        @if(session()->has('success'))
        <div class="my-2 alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif

        <table id="is-datatable" class="dataTables table table-bordered table-hover table-responsive">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.fio') }}</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.type_service') }}</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.action_from') }}</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.action_till') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($passes as $pass)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td title="{{ $pass->client->full_name }}">
                        {{ $pass->client->short_name }}
                    </td>
                    <td>
                        <ul>
                            <li class="font-weight-bold">
                                {{ ServiceActivity::NAMES[$pass->service->activity_id] }}
                            </li>
                            <li class="bk-field bk-field--tip">
                                {{ $pass->service->name }}
                            </li>
                            <li class="bk-field bk-field--tip">
                                {{ $pass->service->unit }}
                                {{ $pass->service->unit == 1 ? ' посещение' : ' посещений' }}
                            </li>
                        </ul>
                    </td>
                    <td>{{ format_date_for_display($pass->start_date) }}</td>
                    <td>{{ format_date_for_display($pass->end_date) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
