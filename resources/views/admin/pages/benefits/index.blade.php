@extends('admin.index')

@section('title-admin', __('_section.benefits'))

@section('content-admin')
    <section id="benefits-index">
        <h3>{{ __('_section.benefits') }}</h3>

        <div class="my-2 btn-group">
            <a class="btn btn-primary" href="{{ route('benefits.create') }}">
                {{ __('_record.new') }}
            </a>
        </div>

        @if(session()->has('success'))
            <div class="my-2 alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif

        <table id="is-datatable" class="dataTables table table-bordered table-hover table-responsive">
            <thead class="thead-light">
            <tr>
                <th>#</th>
                <th class="w-50 bk-min-w-250">{{ __('_field.name') }}</th>
                <th class="w-50 bk-min-w-150">{{ __('_field.discount') }}</th>
                <th class="no-sort">{{ __('_action.this') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($benefits as $benefit)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $benefit->name }}</td>
                    <td>{{ format_discount_for_display($benefit->discount) }}</td>
                    <td>
                        <div class="bk-btn-actions">
                            <a class="bk-btn-action bk-btn-action--edit btn btn-warning"
                               href="{{ route('benefits.edit', $benefit) }}"
                               data-tip="{{ __('_action.edit') }}" ></a>
                            <a class="bk-btn-action bk-btn-action--delete btn btn-danger"
                               href="javascript:void(0)"
                               data-id="{{ $benefit->id }}"
                               data-toggle="modal"
                               data-target="#bk-delete-modal"
                               data-tip="{{ __('_action.delete') }}" ></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
