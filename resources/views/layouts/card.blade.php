@extends('layouts.master')

@section('content-head')
    <title>{{ __('_field.card') }}</title>
    <style>
        .card {
            margin: 0 auto;
            max-width: 350px;
            border: 1px solid gray;
        }
        .card-title {
            margin: 15px 0;
            text-align: center;
        }
        .card-line {
            margin: 0 auto;
            width: 90%;
            border-bottom: 1px dashed gray;
        }
        .card-wrapper {
            position: relative;
        }
        .card-info {
            padding-left: 20px;
            list-style-type: none;
        }
        .card-info__tip {
            font-size: 12px;
            font-weight: bold;
        }
        .card-info__text {
            margin-bottom: 10px;
            text-decoration: underline;
            font-size: 12px;
            color: gray;
        }
        .card-info__sign {
            margin-bottom: 10px;
            padding-left: 150px;
            text-align: center;
            font-size: 9px;
        }
        .card-info__line {
            width: 310px;
            border-bottom: 1px solid gray;
        }
        .card-photo {
            position: absolute;
            top: 5px;
            right: 20px;
            width: 150px;
        }
        .card-photo img {
            width: 100%;
            object-fit: cover;
        }
    </style>
@endsection

@section('content-body')
    <div class="card">
        <h3 class="card-title">Карточка №{{ $card->id }}</h3>
        <div class="card-line"></div>
        <div class="card-wrapper">
            <ul class="card-info">
                <li class="card-info__tip">Активность</li>
                <li class="card-info__text">{{ $card->activity->name }}</li>
                <li class="card-info__tip">Клиент</li>
                <li class="card-info__text">{{ $card->client->short_name }}</li>
                <li class="card-info__tip">Телефон</li>
                <li class="card-info__text">{{ format_phone_number_for_display($card->client->phone) }}</li>
                <li class="card-info__tip">Дейсвителен по</li>
                <li class="card-info__text">{{ format_date_for_display($card->end) }}</li>
                <li class="card-info__tip">
                    Кассир
                    <div class="card-info__line"></div>
                </li>
                <li class="card-info__sign">(подпись)</li>
                <li class="card-info__tip">
                    Администратор
                    <div class="card-info__line"></div>
                </li>
                <li class="card-info__sign">(подпись)</li>
                <li class="card-info__tip">
                    Врач
                    <div class="card-info__line"></div>
                </li>
                <li class="card-info__sign">(подпись)</li>
                <li class="card-info__tip">
                    Инструктор
                    <div class="card-info__line"></div>
                </li>
                <li class="card-info__sign">(подпись)</li>
            </ul>
            <div class="card-photo">
                @if($card->client->photo)
                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('storage/' . $card->client->photo))) }}" alt="">
                @else
                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('assets/icons/anonymous.svg'))) }}" alt="">
                @endif
            </div>
        </div>
    </div>
@endsection
