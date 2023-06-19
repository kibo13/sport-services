<div class="bk-form">
    <div class="bk-form__wrapper">
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.medical_history') }}
            </label>
            <div class="bk-form__text">
                {{ $user->medical_card->medical_history ?? __('_record.no') }}
            </div>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.allergies') }}
            </label>
            <div class="bk-form__text">
                {{ $user->medical_card->allergies ?? __('_record.no') }}
            </div>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.medications') }}
            </label>
            <div class="bk-form__text">
                {{ $user->medical_card->medications ?? __('_record.no') }}
            </div>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.cardiovascular_system') }}
            </label>
            <div class="bk-form__text">
                {{ $user->medical_card->cardiovascular_system ?? __('_record.no') }}
            </div>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.respiratory_system') }}
            </label>
            <div class="bk-form__text">
                {{ $user->medical_card->respiratory_system ?? __('_record.no') }}
            </div>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.mobility') }}
            </label>
            <div class="bk-form__text">
                {{ $user->medical_card->mobility ?? __('_record.no') }}
            </div>
        </div>
        <div class="bk-form__field">
            <label class="bk-form__label">
                {{ __('_field.doctor_recommendations') }}
            </label>
            <div class="bk-form__text">
                {{ $user->medical_card->doctor_recommendations ?? __('_record.no') }}
            </div>
        </div>
    </div>
</div>
