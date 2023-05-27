@extends('admin.index')

@section('title-admin', __('_section.users'))

@section('content-admin')
    <section id="user-index">
        <h3>{{ __('_section.users') }}</h3>

        @if(auth()->user()->isAdmin())
        <div class="my-2 btn-group">
            <a class="btn btn-primary" href="{{ route('users.create') }}">
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
                    <th class="w-25 bk-min-w-150">{{ __('_field.fio') }}</th>
                    <th class="w-25 bk-min-w-150">{{ __('_field.role') }}</th>
                    <th class="w-25 bk-min-w-150">{{ __('_field.phone') }}</th>
                    <th class="w-25 bk-min-w-150">{{ __('_field.email') }}</th>
                    <th class="bk-min-w-300 no-sort">{{ __('_field.permissions') }}</th>
                    <th class="no-sort">{{ __('_action.this') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td title="{{ $user->full_name }}">
                        {{ $user->short_name }}
                    </td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                        <a href="tel:{{ $user->phone }}">
                            {{ format_phone_number_for_display($user->phone) }}
                        </a>
                    </td>
                    <td>
                        <a href="mailto:{{ $user->email }}">
                            {{ $user->email }}
                        </a>
                    </td>
                    <td>
                        <ul class="bk-btn-info">
                            @foreach($sections as $section)
                            <li>
                                @if($user->permissions->where('name', $section->name)->count())
                                    <strong>{{ $section->name }}</strong>
                                @endif
                                @foreach($user->permissions as $permission)
                                @if($permission->name == $section->name)
                                    <span class="bk-field bk-field--tip">
                                    {{ $permission->note }}
                                    </span>
                                @endif
                                @endforeach
                            </li>
                            @endforeach
                            @if($user->permissions->count())
                            <i class="fa fa-eye bk-btn-info--fa"></i>
                            @endif
                        </ul>
                    </td>
                    <td>
                        <div class="bk-btn-actions">
                            <a class="bk-btn-action bk-btn-action--edit btn btn-warning"
                               href="{{ route('users.edit', $user) }}"
                               title="{{ __('_action.edit') }}" ></a>
                            <a class="bk-btn-action bk-btn-action--delete btn btn-danger"
                               href="javascript:void(0)"
                               data-id="{{ $user->id }}"
                               data-toggle="modal"
                               data-target="#bk-delete-modal"
                               title="{{ __('_action.delete') }}" ></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
