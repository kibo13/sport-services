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
        .card-photo {
            position: absolute;
            top: 5px;
            right: 20px;
            width: 130px;
            height: 160px;
            line-height: 140px;
            vertical-align: middle;
            text-align: center;
            font-size: 12px;
            border: 1px solid gray;
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
            </ul>
            <div class="card-photo">
                Место для фото
            </div>
        </div>
    </div>
@endsection
