@extends('admin.index')

@section('title-admin', __('_section.orders'))

@section('scripts')
    <script src="{{ mix('js/api/get-trainers-by-specialization.js') }}"></script>
@endsection

@section('content-admin')
    <section id="order-form">
        <h3>{{ isset($order) ? __('_record.edit') : __('_record.new')  }}</h3>

        <form class="bk-form" action="{{ isset($order) ? route('orders.update', $order) : route('orders.store') }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                @isset($order)
                @method('PUT')
                @endisset
                <div class="bk-form__field">
                    <label class="bk-form__label" for="subject">
                        {{ __('_field.topic') }}
                    </label>
                    <select class="bk-form__select bk-max-w-300" id="subject" name="subject" required>
                        <option value="" hidden selected>Выбрать</option>
                        <option value="Запись в группу">Запись в группу</option>
                    </select>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="specialization_id">
                        {{ __('_field.activity') }}
                    </label>
                    <select class="bk-form__input bk-max-w-300" id="specialization_id" name="activity_id" required>
                        <option value="" disabled hidden selected>Выбрать</option>
                        @foreach($activities as $activity)
                        <option value="{{ $activity->id }}" @isset($order) @if($order->activity_id == $activity->id) selected @endif @endisset>
                            {{ $activity->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="trainer_id">
                        {{ __('_field.trainer') }}
                    </label>
                    <select class="bk-form__input bk-max-w-300" id="trainer_id" name="trainer_id" required>
                        <option value="" disabled hidden selected>Выбрать</option>
                        @foreach($trainers as $trainer)
                        <option value="{{ $trainer->id }}" @isset($order) @if($order->trainer_id == $trainer->id) selected @endif @endisset>
                            {{ $trainer->full_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="message">
                        {{ __('_field.message') }}
                    </label>
                    <textarea class="bk-form__textarea"
                              id="message"
                              name="message">{{ isset($order) ? $order->message : null }}</textarea>
                </div>
                <div class="mt-1 mb-0 form-group">
                    <button class="btn btn-outline-success">
                        {{ __('_action.save') }}
                    </button>
                    <a class="btn btn-outline-secondary" href="{{ route('orders.index') }}">
                        {{ __('_action.back') }}
                    </a>
                </div>
            </div>
        </form>
    </section>
@endsection
