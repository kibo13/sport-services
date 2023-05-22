@extends('admin.index')

@section('title-admin', __('_section.rules'))

@section('content-admin')
    <section id="rules-index">
        <h3>{{ __('_section.rules') }}</h3>

        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ asset('assets/rules/pool.docx') }}" download>
                    Правила бассейна
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ asset('assets/rules/gym.docx') }}" download>
                    Правила тренажёрного зала
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ asset('assets/rules/gym.docx') }}" download>
                    Правила теннисных кортов
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ asset('assets/rules/gym.docx') }}" download>
                    Правила спортзала
                </a>
            </li>
            <li class="list-group-item">
                <a href="{{ asset('assets/rules/gym.docx') }}" download>
                    Правила безопасности
                </a>
            </li>
        </ul>
    </section>
@endsection
