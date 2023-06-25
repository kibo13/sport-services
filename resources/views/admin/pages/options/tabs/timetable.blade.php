<div class="mt-1 mb-2 bk-callout">
    <h5>Цветовые обозначения групп</h5>
    <hr>
    <div class="bk-grid bk-grid--gtc-150">
        @foreach($activities as $activity)
            <div class="bk-grid bk-grid--gtr-30">
                <h6>{{ $activity->name }}</h6>
                @foreach($activity->groups as $group)
                    <div class="py-1 px-2 text-white rounded" style="background: {{ $group->color }};">
                        {{ $group->name }}
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

<div id="timetable-option-index">
    <h5>Таблица настроек расписания по часам</h5>
    <table class="dataTables table table-bordered table-hover table-responsive">
        <thead class="thead-light">
            <tr class="text-center">
                <th class="bk-min-w-100">{{ __('_field.time') }}</th>
                @foreach($days as $day)
                    <th class="bk-min-w-150">{{ $day['short_name'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach($hours as $index => $hour)
            @if($index > 6 && $index < 22)
                <tr class="text-center">
                    <td>
                        <strong>{{ $hour }}</strong>
                    </td>
                    @foreach($days as $day)
                    <td class="align-middle">
                        <ul>
                            @foreach($timetableOptions->where('day_of_week', $day['id']) as $option)
                            @if($option->isHourWithinDuration($hour))
                            <li class="text-white" style="background: {{ $option->group->color }}; cursor: pointer;">
                                {{ $option->group->name }}
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </td>
                    @endforeach
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>

    <h5>Таблица настроек расписания по дням недели</h5>

    <table class="dataTables table table-bordered table-hover table-responsive">
        <thead class="thead-light">
        <tr class="text-center">
            <th>#</th>
            <th class="bk-min-w-200">{{ __('_field.activity') }}</th>
            <th class="bk-min-w-150">{{ __('_field.group') }}</th>
            <th title="{{ __('_field.hours_per_month') }}">
                {{ __('_field.month') }}
                <i class="fa fa-info-circle"></i>
            </th>
            <th title="{{ __('_field.hours_per_week') }}">
                {{ __('_field.week') }}
                <i class="fa fa-info-circle"></i>
            </th>
            @foreach($days as $day)
            <th>{{ $day['short_name'] }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($groups as $group)
            <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $group->activity->name }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->workload . ' ч.' }}</td>
                <td>{{ $group->workload / 4 . ' ч.'}}</td>
                @foreach($days as $day)
                <td class="align-middle">
                    @if(is_access('timetable_full'))
                        @if(! is_null($group->getOptionByDayOfWeek($day['id'])))
                            <button class="text-secondary js-option-set"
                                    data-action="update"
                                    data-group="{{ $group->id }}"
                                    data-dow="{{ $day['id'] }}"
                                    data-start="{{ $group->getOptionByDayOfWeek($day['id'])->start }}"
                                    data-duration="{{ $group->getOptionByDayOfWeek($day['id'])->duration }}"
                                    title="{{ __('_action.edit') }}">
                                {{ $group->getOptionByDayOfWeek($day['id'])->duration . ' ч' }}
                            </button>
                            {{ '/' }}
                            <button class="bk-btn-action--delete text-danger"
                                    data-id="{{ $group->getOptionByDayOfWeek($day['id'])->id }}"
                                    data-toggle="modal"
                                    data-table="timetable-option"
                                    data-target="#bk-delete-modal"
                                    title="{{ __('_action.reset') }}">
                                ✖
                            </button>
                        @else
                            <button class="text-primary js-option-set"
                                    data-action="create"
                                    data-group="{{ $group->id }}"
                                    data-dow="{{ $day['id'] }}"
                                    data-start="{{ null }}"
                                    data-duration="{{ null }}">
                                {{ __('_action.set') }}
                            </button>
                        @endif
                    @else
                        <span class="text-muted">
                            @if($group->getOptionByDayOfWeek($day['id'])->count())
                                {{ $group->getOptionByDayOfWeek($day['id'])->duration . ' ч' }}
                            @else
                                {{ '-' }}
                            @endif
                        </span>
                    @endif
                </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


