@extends('admin.index')

@section('title-admin', __('_section.groups'))

@section('content-admin')
    <section id="group-index">
        <h3>{{ __('_section.groups') }}</h3>

        @if(is_access('group_full'))
        <div class="my-2 btn-group">
            <a class="btn btn-primary" href="{{ route('groups.create') }}">
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
                    <th class="w-25 bk-min-w-200">{{ __('_field.name') }}</th>
                    <th class="w-25 bk-min-w-200">{{ __('_field.activity') }}</th>
                    <th class="w-25 bk-min-w-200">{{ __('_field.trainer') }}</th>
                    <th class="w-25 bk-min-w-150">{{ __('_field.max_seating') }}</th>
                    @if(is_access('group_full'))
                    <th class="no-sort">{{ __('_action.this') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @foreach($groups as $group)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->activity->name }}</td>
                    <td title="{{ $group->trainer->full_name }}">{{ $group->trainer->short_name }}</td>
                    <td>{{ $group->limit }}</td>
                    @if(is_access('group_full'))
                    <td>
                        <div class="bk-btn-actions">
                            <a class="bk-btn-action bk-btn-action--edit btn btn-warning"
                               href="{{ route('groups.edit', $group) }}"
                               title="{{ __('_action.edit') }}" ></a>
                            <a class="bk-btn-action bk-btn-action--delete btn btn-danger"
                               href="javascript:void(0)"
                               data-id="{{ $group->id }}"
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
