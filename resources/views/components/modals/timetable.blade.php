<div class="bk-modal" id="js-timetable-modal">
    <div class="bk-modal-wrapper">
        <form action="{{ route('timetable.replace.trainer') }}" method="POST">
            @csrf
            <h6 class="bk-modal-header">
                Замена тренера
            </h6>
            <div class="bk-modal-content is-validation">
                <input type="hidden" data-field="timetable-id" name="timetable_id">
                <div class="mb-2">
                    <label class="m-0 font-weight-bold">{{ __('_field.activity') }}</label>
                    <input class="form-control form-control-sm" type="text" data-field="activity" readonly>
                </div>
                <div class="mb-2">
                    <label class="m-0 font-weight-bold">{{ __('_field.group') }}</label>
                    <input class="form-control form-control-sm" type="text" data-field="group" readonly>
                </div>
                <div class="mb-2">
                    <label class="m-0 font-weight-bold">{{ __('_field.time_lesson') }}</label>
                    <input class="form-control form-control-sm" type="text" data-field="time-lesson" readonly>
                </div>
                <div class="mb-2">
                    <label class="m-0 font-weight-bold">{{ __('_field.trainer') }}</label>
                    <input class="form-control form-control-sm" type="text" data-field="trainer" readonly>
                </div>
                <div class="mb-2 d-flex flex-column">
                    <label class="m-0 font-weight-bold">
                        {{ __('_field.replacement_trainer') }}
                    </label>
                    <select class="form-control form-control-sm"
                            style="width: 100%;"
                            id="js-timetable-trainer-id"
                            data-field="trainer-id"
                            name="trainer_id"
                            required>
                        <option value="" hidden selected>Выбрать</option>
                    </select>
                </div>
                <div>
                    <label class="m-0 font-weight-bold">{{ __('_field.replacement_reason') }}</label>
                    <textarea class="bk-form__textarea"
                              style="width: 100%;"
                              data-field="replacement-reason"
                              name="note"
                              required></textarea>
                </div>
            </div>
            <div class="bk-modal-footer">
                <button class="btn btn-sm btn-success"
                        type="submit"
                        data-modal="submit">
                    {{ __('_action.save') }}
                </button>
                <button class="btn btn-sm btn-secondary"
                        type="button"
                        data-modal="close">
                    {{ __('_action.cancel') }}
                </button>
            </div>
        </form>
    </div>
</div>
