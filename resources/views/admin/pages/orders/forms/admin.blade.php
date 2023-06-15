@extends('admin.index')

@section('title-admin', __('_section.orders'))

@section('content-admin')
    <section id="order-form">
        <h3>{{ 'Информация по заявке №' . $order->id }}</h3>

        <form class="bk-form" action="{{ route('orders.update', $order) }}" method="POST">
            <div class="bk-form__wrapper">
                @csrf
                @method('PUT')
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.client') }}
                    </label>
                    <div class="bk-form__text">
                        {{ $order->client->full_name }}
                    </div>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.topic') }}
                    </label>
                    <div class="bk-form__text">
                        {{ $order->subject }}
                    </div>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.activity') }}
                    </label>
                    <div class="bk-form__text">
                        {{ $order->activity->name }}
                    </div>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.trainer') }}
                    </label>
                    <div class="bk-form__text">
                        {{ $order->trainer->full_name }}
                    </div>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.message') }}
                    </label>
                    <div class="bk-form__text">
                        {{ $order->message }}
                    </div>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label" for="status_id">
                        {{ __('_field.activity') }}
                    </label>
                    <select class="bk-form__input bk-max-w-300" id="status_id" name="status_id" required>
                        <option value="" hidden selected>Выбрать</option>
                        <option value="2" {{ (isset($order->status_id) && $order->status_id == 2) ? 'selected' : '' }}>Завершить</option>
                        <option value="4" {{ (isset($order->status_id) && $order->status_id == 4) ? 'selected' : '' }} >Отклонить</option>
                    </select>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.comment') }}
                    </label>
                    <textarea class="bk-form__textarea"
                              id="comment"
                              name="comment">{{ isset($order) ? $order->comment : null }}</textarea>
                </div>
                <div class="mt-1 mb-0 form-group">
                    @if($order->status_id == 1)
                    <button class="btn btn-outline-success">
                        {{ __('_action.save') }}
                    </button>
                    @endif
                    <a class="btn btn-outline-secondary" href="{{ route('orders.index') }}">
                        {{ __('_action.back') }}
                    </a>
                </div>
            </div>
        </form>
    </section>
@endsection
