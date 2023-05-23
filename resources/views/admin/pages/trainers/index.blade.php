@extends('admin.index')

@section('title-admin', __('_section.trainers'))

@section('content-admin')
    <section id="trainers-index">
        <h3>{{ __('_section.trainers') }}</h3>

        <div class="my-2 btn-group">
            <a class="btn btn-success" href="#">
                {{ __('_action.export') }}
            </a>
        </div>

        <table id="is-datatable" class="dataTables table table-bordered table-hover table-responsive">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.fio') }}</th>
                    <th class="w-25 bk-min-w-200">{{ __('_field.phone') }}</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.email') }}</th>
                    <th class="w-25 no-sort bk-min-w-150">{{ __('_field.photo') }}</th>
                    <th class="no-sort">{{ __('_action.this') }}</th>
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
                        <div class="bk-zoom">
                            {{ __('_action.look') }}
                            <img class="bk-zoom__img"
                                 src="{{ $trainer->photo ? asset('/storage/' . $trainer->photo) : asset('/assets/icons/anonymous.svg') }}"
                                 alt="{{ $trainer->full_name }}"
                                 tabindex="0">
                            <div class="bk-zoom__bg"></div>
                        </div>
                    </td>
                    <td>
                        <div class="bk-btn-actions">
                            <a class="bk-btn-action bk-btn-action--info btn btn-info"
                               href="{{ route('trainers.show', $trainer) }}"
                               data-tip="{{ __('_action.look') }}" ></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
