@extends('admin.index')

@section('title-admin', __('_section.educations'))

@section('content-admin')
    <section id="education-index">
        <h3>{{ __('_section.educations') }}</h3>

        @if(is_access('education_full'))
        <div class="my-2 btn-group">
            <a class="btn btn-primary" href="{{ route('educations.create') }}">
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
                    <th class="w-75 bk-min-w-300">{{ __('_field.note') }}</th>
                    @if(is_access('education_full'))
                    <th class="no-sort">{{ __('_action.this') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @foreach($educations as $education)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $education->name }}</td>
                    <td>{{ $education->note }}</td>
                    @if(is_access('education_full'))
                    <td>
                        <div class="bk-btn-actions">
                            <a class="bk-btn-action bk-btn-action--edit btn btn-warning"
                               href="{{ route('educations.edit', $education) }}"
                               title="{{ __('_action.edit') }}" ></a>
                            <a class="bk-btn-action bk-btn-action--delete btn btn-danger"
                               href="javascript:void(0)"
                               data-id="{{ $education->id }}"
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
