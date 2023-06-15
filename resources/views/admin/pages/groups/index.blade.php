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

        @foreach($activities as $activity)
            <h5 class="my-2">{{ $activity->name }}</h5>
            <hr class="my-2">
            @foreach($groups->where('activity_id', $activity->id) as $group)
            <table class="dataTables table table-bordered table-responsive">
                <tbody>
                    <tr>
                        <td class="font-weight-bold">{{ __('_field.group') }}</td>
                        <td colspan="12">
                            <a class="{{ is_access('group_full') ? 'text-primary' : 'text-muted' }}"
                               href="{{ is_access('group_full') ? route('groups.edit', $group) : null }}"
                               target="{{ is_access('group_full') ? '_blank' : null }}">
                                {{ $group->name }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">{{ __('_field.trainer') }}</td>
                        <td colspan="12">
                            <a class="{{ is_access('trainer_full') ? 'text-primary' : 'text-muted' }}"
                               href="{{ is_access('trainer_full') ? route('trainers.edit', $group->trainer) : null }}"
                               target="{{ is_access('trainer_full') ? '_blank' : null }}">
                                {{ $group->trainer->full_name }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold bk-min-w-100">{{ __('_field.place') }}</td>
                        @foreach($group->places as $place)
                        <td class="bk-min-w-50 text-center">
                            <div class="bk-btn-actions">
                                @if($place->is_busy)
                                <a class="bk-btn-action bk-btn-action--user btn btn-info"
                                   href="javascript:void(0)"
                                   data-id="{{ $place->id }}"
                                   data-toggle="modal"
                                   data-target="#bk-client-modal"
                                   title="{{ __('_action.look') }}"></a>
                                @else
                                <a class="bk-btn-action bk-btn-action--plus btn btn-primary"
                                   href="javascript:void(0)"
                                   data-id="{{ $place->id }}"
                                   data-toggle="modal"
                                   data-target="#bk-place-modal"
                                   title="{{ __('_action.set') }}"></a>
                                @endif
                            </div>
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            @endforeach
        @endforeach
    </section>
@endsection
