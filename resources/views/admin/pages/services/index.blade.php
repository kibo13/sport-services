@extends('admin.index')

@section('title-admin', __('_section.services'))

@section('content-admin')
    <section id="services-index" class="bk-overflow-hidden">
        <h3>{{ __('_section.services') }}</h3>

        <div class="my-2 btn-group">
            <a class="btn btn-primary" href="{{ route('services.create') }}">
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
                    <th class="w-100 bk-min-w-150">{{ __('_field.name') }}</th>
                    <th class="no-sort">{{ __('_action.this') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $service->name }}</td>
                    <td>
                        <div class="bk-btn-actions">
                            <a class="bk-btn-action bk-btn-action--edit btn btn-warning"
                               href="{{ route('services.edit', $service) }}"
                               data-tip="{{ __('_action.edit') }}" ></a>
                            <a class="bk-btn-action bk-btn-action--delete btn btn-danger"
                               href="javascript:void(0)"
                               data-id="{{ $service->id }}"
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
