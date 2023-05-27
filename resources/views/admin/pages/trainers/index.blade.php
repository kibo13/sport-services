@extends('admin.index')

@section('title-admin', __('_section.trainers'))

@section('content-admin')
    <section id="trainers-index">
        <h3>{{ __('_section.trainers') }}</h3>

        <div class="my-2 btn-group">
            <a class="btn btn-success" href="{{ route('trainers.export') }}">
                {{ __('_action.export') }}
            </a>
        </div>

        <table id="is-datatable" class="dataTables table table-bordered table-hover table-responsive">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.fio') }}</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.phone') }}</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.email') }}</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.specializations') }}</th>
                    @if(is_access('trainer_full'))
                    <th class="no-sort">{{ __('_action.this') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @foreach($trainers as $trainer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td title="{{ $trainer->full_name }}">{{ $trainer->short_name }}</td>
                    <td>
                        <a href="tel:{{ $trainer->phone }}">
                            {{ format_phone_number_for_display($trainer->phone) }}
                        </a>
                    </td>
                    <td>
                        <a href="mailto:{{ $trainer->email }}">
                            {{ $trainer->email }}
                        </a>
                    </td>
                    <td>
                        <ul>
                            @foreach($trainer->specializations as $specialization)
                            <li>
                                {{ $specialization->name }}
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    @if(is_access('trainer_full'))
                    <td>
                        <div class="bk-btn-actions">
                            <a class="bk-btn-action bk-btn-action--edit btn btn-warning"
                               href="{{ route('trainers.edit', $trainer) }}"
                               title="{{ __('_action.edit') }}"></a>
                        </div>
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
