@extends('admin.index')

@section('title-admin', __('_section.groups'))

@section('scripts')
    <script src="{{ mix('js/api/get-trainers-by-specialization.js') }}"></script>
@endsection

@section('content-admin')
    <section id="group-form">
        <h3>{{ isset($group) ? __('_record.edit') : __('_record.new')  }}</h3>
        <form class="bk-form" action="{{ isset($group) ? route('groups.update', $group) : route('groups.store') }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                @isset($group)
                @method('PUT')
                @endisset
                <div class="bk-form__field">
                    <label class="bk-form__label" for="name">
                        {{ __('_field.name') }}
                    </label>
                    <input class="bk-form__input"
                           id="name"
                           type="text"
                           name="name"
                           value="{{ isset($group) ? $group->name : null }}"
                           required/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="specialization_id">
                        {{ __('_field.activity') }}
                    </label>
                    <select class="bk-form__input bk-max-w-300" id="specialization_id" name="activity_id" required>
                        @isset($group)
                        <option value="{{ $group->activity_id }}" selected>
                            {{ $group->activity->name }}
                        </option>
                        @else
                        <option value="" disabled hidden selected>Выбрать</option>
                        @foreach($activities as $activity)
                        <option value="{{ $activity->id }}">
                            {{ $activity->name }}
                        </option>
                        @endforeach
                        @endisset
                    </select>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="trainer_id">
                        {{ __('_field.trainer') }}
                    </label>
                    <select class="bk-form__input bk-max-w-300" id="trainer_id" name="trainer_id" required>
                        <option value="" disabled hidden selected>Выбрать</option>
                        @foreach($trainers as $trainer)
                        <option value="{{ $trainer->id }}" @isset($group) @if($group->trainer_id == $trainer->id) selected @endif @endisset>
                            {{ $trainer->full_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="workload">
                        {{ __('_field.hours_per_month') }}
                    </label>
                    <input class="bk-form__input bk-max-w-100"
                           id="workload"
                           type="number"
                           name="workload"
                           min="1"
                           max="100"
                           step="1"
                           value="{{ isset($group) ? $group->workload : null }}"
                           required/>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="color">
                        {{ __('_field.color') }}
                    </label>
                    <input class="bk-form__input w-100"
                           id="color"
                           type="color"
                           name="color"
                           value="{{ isset($group) ? $group->color : null }}"/>
                </div>
                <div class="mt-1 mb-0 form-group">
                    <button class="btn btn-outline-success">
                        {{ __('_action.save') }}
                    </button>
                    <a class="btn btn-outline-secondary" href="{{ route('groups.index') }}">
                        {{ __('_action.back') }}
                    </a>
                </div>
            </div>
        </form>
    </section>
@endsection
