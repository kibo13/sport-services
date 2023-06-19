@extends('admin.index')

@section('title-admin', __('_section.clients'))

@section('content-admin')
    <section>
        <h3>{{ __('_field.medical_card') }}</h3>
        <form class="bk-form" action="{{ route('clients.medical.card.update', $medicalCard) }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                @method('PUT')
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.client') }}
                    </label>
                    <div class="bk-form__text">
                        {{ $client->full_name }}
                    </div>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="medical_history">
                        {{ __('_field.medical_history') }}
                    </label>
                    <textarea class="bk-form__textarea"
                              id="medical_history"
                              name="medical_history">{{ $medicalCard->medical_history }}</textarea>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="allergies">
                        {{ __('_field.allergies') }}
                    </label>
                    <textarea class="bk-form__textarea"
                              id="allergies"
                              name="allergies">{{ $medicalCard->allergies }}</textarea>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="medications">
                        {{ __('_field.medications') }}
                    </label>
                    <textarea class="bk-form__textarea"
                              id="medications"
                              name="medications">{{ $medicalCard->medications }}</textarea>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="cardiovascular_system">
                        {{ __('_field.cardiovascular_system') }}
                    </label>
                    <textarea class="bk-form__textarea"
                              id="cardiovascular_system"
                              name="cardiovascular_system">{{ $medicalCard->cardiovascular_system }}</textarea>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="respiratory_system">
                        {{ __('_field.respiratory_system') }}
                    </label>
                    <textarea class="bk-form__textarea"
                              id="respiratory_system"
                              name="respiratory_system">{{ $medicalCard->respiratory_system }}</textarea>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="mobility">
                        {{ __('_field.mobility') }}
                    </label>
                    <textarea class="bk-form__textarea"
                              id="mobility"
                              name="mobility">{{ $medicalCard->mobility }}</textarea>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="doctor_recommendations">
                        {{ __('_field.doctor_recommendations') }}
                    </label>
                    <textarea class="bk-form__textarea"
                              id="doctor_recommendations"
                              name="doctor_recommendations">{{ $medicalCard->doctor_recommendations }}</textarea>
                </div>
                <div class="mt-1 mb-0 form-group">
                    <button class="btn btn-outline-success">
                        {{ __('_action.save') }}
                    </button>
                    <a class="btn btn-outline-secondary" href="{{ route('clients.index') }}">
                        {{ __('_action.back') }}
                    </a>
                </div>
            </div>
        </form>
    </section>
@endsection
