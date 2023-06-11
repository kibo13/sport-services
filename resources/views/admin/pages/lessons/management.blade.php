@extends('admin.index')

@section('title-admin', __('_section.management'))

@section('content-admin')
    <section id="management-index">
        <h3>{{ __('_section.management') }}</h3>
        <form class="my-2 bk-form" action="{{ route('lessons.management') }}" method="GET">
            <div class="bk-form__wrapper">
                <div class="bk-search">
                    <input class="form-control"
                           type="number"
                           name="search"
                           min="1"
                           step="1"
                           value="{{ $searchQuery ?? null }}"
                           placeholder="Введите номер карточки"
                           required>
                    <button class="btn btn-sm btn-primary">
                        {{ __('_action.search') }}
                    </button>
                </div>
            </div>
        </form>
       <div class="bk-form">
            <div class="bk-form__wrapper">
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.client') }}
                    </label>
                    <div class="bk-form__text">
                        {{ $card ? $card->client->full_name : 'Клиент не найден' }}
                    </div>
                </div>
                @if($card)
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.expiration_at') }}
                    </label>
                    <div class="bk-form__text {{ $card->isCardActive() ? 'text-success' : 'text-danger' }}">
                        {{ format_date_for_display($card->end) }}
                    </div>
                </div>
                <div class="bk-form__field">
                    <label class="bk-form__label">
                        {{ __('_field.card') }}
                    </label>
                    @if($card->isCardActive())
                    <table class="dataTables table table-bordered table-responsive">
                        <tbody>
                            <tr class="font-weight-bold">
                                <td rowspan="2" class="align-middle">{{ $card->activity->name }}</td>
                                <td colspan="12" class="text-center">Кол-во посещений</td>
                            </tr>
                            <tr class="text-center font-weight-bold">
                                @foreach($card->lessons as $lesson)
                                <td class="text-center bk-min-w-100">{{ $lesson->number }}</td>
                                @endforeach
                            </tr>
                            <tr class="font-weight-bold">
                                <td>
                                    {{ __('_field.date') }}
                                </td>
                                @foreach($card->lessons as $lesson)
                                <td class="text-center {{ $lesson->is_attended ? 'text-success' : 'text-muted' }}">
                                    {{ $lesson->attended_at ? format_date_for_display($lesson->attended_at) : '-' }}
                                </td>
                                @endforeach
                            </tr>
                            <tr class="font-weight-bold">
                                <td>
                                    {{ __('_field.mark') }}
                                </td>
                                @foreach($card->lessons as $index => $lesson)
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        @if($lesson->is_attended)
                                        <span class="text-success">∨</span>
                                        @else
                                        <form action="{{ route('lessons.update', $lesson) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="is_attended" value="1">
                                            <button style="font-size: 16px; outline: none;"
                                                    @if($lesson->number > 1 && ! $card->lessons[$index - 1]['is_attended']) disabled @endif>
                                                <i class="fa fa-square-o"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                    @else
                    <div class="bk-form__text">
                        Карточка неактивна, необходимо приобрести новую
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection
