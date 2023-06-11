@extends('admin.index')

@section('title-admin', __('_section.trainers'))

@section('content-admin')
    <section id="trainers-index">
        <h3>{{ __('_section.trainers') }}</h3>

        @if(is_access('trainer_full'))
        <div class="my-2 btn-group">
            <a class="btn btn-success" href="{{ route('trainers.export') }}">
                {{ __('_action.export') }}
            </a>
        </div>
        @endif

        <table id="is-datatable" class="dataTables table table-bordered table-hover table-responsive">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th class="w-25 bk-min-w-200">{{ __('_field.fio') }}</th>
                    <th class="w-25 bk-min-w-250">{{ __('_field.education') }}</th>
                    <th class="w-00 bk-min-w-100">{{ __('_field.experience') }}</th>
                    <th class="w-25 bk-min-w-200">{{ __('_field.specializations') }}</th>
                    <th class="w-25 bk-min-w-300 no-sort">{{ __('_field.description') }}</th>
                    <th class="w-00 bk-min-w-150 no-sort">{{ __('_field.photo') }}</th>
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
                    <td>{{ $trainer->education ? $trainer->education->name : null }}</td>
                    <td>
                        <b>{{ $trainer->experience }}</b>
                        <span class="bk-field bk-field--tip">{{ experience_label($trainer->experience) }}</span>
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
                    <td>
                        <div class="bk-btn-info">
                            {{ $trainer->note }}
                            @if($trainer->note)
                            <i class="fa fa-eye bk-btn-info--fa"></i>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="bk-zoom">
                            <span class="text-primary">
                                {{ __('_action.look') }}
                            </span>
                            <img class="bk-zoom__img"
                                 src="{{ $trainer->photo ? asset('/storage/' . $trainer->photo) : asset('/assets/icons/anonymous.svg') }}"
                                 alt="{{ $trainer->full_name }}"
                                 tabindex="0">
                            <div class="bk-zoom__bg"></div>
                        </div>
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
