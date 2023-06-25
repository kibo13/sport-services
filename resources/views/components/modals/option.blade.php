<div class="bk-modal" id="js-timetable-option-modal">
    <div class="bk-modal-wrapper">
        <form action="{{ route('timetable.update.or.create') }}" method="POST">
            @csrf
            <h6 class="bk-modal-header">
                {{ __('_field.setting') }}
            </h6>
            <div class="bk-modal-content">
                <input type="hidden" id="js-action" name="action">
                <input type="hidden" id="js-group-id" name="group_id">
                <input type="hidden" id="js-day-of-week" name="day_of_week">
                <div class="mb-2">
                    <label class="m-0 font-weight-bold" for="start">
                        {{ __('_field.start_lesson') }}
                    </label>
                    <input class="form-control form-control-sm"
                           id="start"
                           type="time"
                           name="start"
                           required>
                </div>
                <div class="mb-2">
                    <label class="m-0 font-weight-bold" for="duration">
                        {{ __('_field.hours_per') }}
                    </label>
                    <input class="form-control form-control-sm"
                           id="duration"
                           type="number"
                           name="duration"
                           min="1"
                           max="3"
                           step="1"
                           required>
                </div>
            </div>
            <div class="bk-modal-footer">
                <button class="btn btn-sm btn-outline-success"
                        type="submit"
                        data-modal="submit">
                    {{ __('_action.save') }}
                </button>
                <button class="btn btn-sm btn-outline-secondary"
                        type="button"
                        data-modal="close">
                    {{ __('_action.cancel') }}
                </button>
            </div>
        </form>
    </div>
</div>
