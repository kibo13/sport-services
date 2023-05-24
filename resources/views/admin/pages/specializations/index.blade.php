@extends('admin.index')

@section('title-admin', __('_section.specializations'))

@section('content-admin')
    <section id="specializations-index">
        <h3>{{ __('_section.specializations') }}</h3>

        @if(is_access('specialization_full'))
        <div class="my-2 btn-group">
            <a class="btn btn-primary" href="{{ route('specializations.create') }}">
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
                    <th class="w-50 bk-min-w-250">{{ __('_field.name') }}</th>
                    <th class="w-50 bk-min-w-300 no-sort">{{ __('_field.note') }}</th>
                    @if(is_access('specialization_full'))
                    <th class="no-sort">{{ __('_action.this') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @foreach($specializations as $specialization)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $specialization->name }}</td>
                    <td>
                        <div class="bk-btn-info">
                            {{ $specialization->note }}
                            @if($specialization->note)
                            <i class="fa fa-eye bk-btn-info--fa"></i>
                            @else
                            null
                            @endif
                        </div>
                    </td>
                    @if(is_access('specialization_full'))
                    <td>
                        <div class="bk-btn-actions">
                            <a class="bk-btn-action bk-btn-action--edit btn btn-warning"
                               href="{{ route('specializations.edit', $specialization) }}"
                               data-tip="{{ __('_action.edit') }}" ></a>
                            <a class="bk-btn-action bk-btn-action--delete btn btn-danger"
                               href="javascript:void(0)"
                               data-id="{{ $specialization->id }}"
                               data-toggle="modal"
                               data-target="#bk-delete-modal"
                               data-tip="{{ __('_action.delete') }}" ></a>
                        </div>
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
