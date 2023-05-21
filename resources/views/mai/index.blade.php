@extends('layouts.master')

@section('content-head')
    <title>МАИ | {{ config('app.name') }} </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/vendors/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/mai.css') }}">
@endsection

@section('content-body')
    <div class="mai" id="mai">
        <div class="mai-wrapper">
            <div class="mai-logo">
                <a class="mai-logo__link" href="https://mai.ru/" target="_blank" >
                    <img class="mai-logo__icon"
                         src="{{ asset('assets/icons/mai.svg') }}"
                         alt="Московский Авиационный Институт" >
                </a>
            </div>
            <h3 class="mai-title">
                Автоматизированная информационная система организации спортивно-оздоровительных услуг
            </h3>
            <ul class="mai-contributors">
                <li class="mai-contributors__member">
                    <p class="mai-contributors__position">Руководитель:</p>
                    <p class="mai-contributors__fio">Н.Т. Дарибаева</p>
                </li>
                <li class="mai-contributors__member">
                    <p class="mai-contributors__position">Разработчик:</p>
                    <p class="mai-contributors__fio">Б.В. Ермекбаев</p>
                </li>
            </ul>
            <div class="mai-issue">2023</div>
            <a class="mai-login" href="{{ route('login') }}">Войти</a>
        </div>
    </div>
@endsection
