@extends('layout.app')

@section('banner')
    <div class="jumbotron jumbotron-fluid top-banner top-banner--main">
        <div class="top-banner__container main-container">
            <h1 class="top-banner__title top-banner--main__title">Первично-прогрессирующий рассеянный склероз</h1>
            <p class="top-banner__text top-banner--main__text">Информационный портал для пациентов и их родственников</p>
        </div>
    </div>
@endsection

@section('content')
<ol class="list-group banners-group mb-5">
    <li class="list-group-item banner">
        <h2 class="banner__name-page main-container">РС- это</h2>
        <a href="#" class="banner__container">
            <h3 class="banner__title">Что такое рассеянный склероз?</h3>
            <p class="banner__text-preview main-container">Для чего используется контрастное вещество и как с его помощью отслеживают эффективность проводимой терапии</p>
        </a>
    </li>
    <li class="list-group-item banner">
        <h2 class="banner__name-page main-container">Диагностика</h2>
        <a href="#" class="banner__container">
            <h3 class="banner__title">Как диагностируют рассеянный склероз?</h3>
            <p class="banner__text-preview main-container">Рассеянный склероз — не повод оставаться на обочине активной жизни. Спектр возможной физической нагрузки очень широк, практически каждый может найти для себя что-то подходящее и вдохновляющее</p>
        </a>
    </li>
    <li class="list-group-item banner">
        <h2 class="banner__name-page main-container">Лечение</h2>
        <a href="#" class="banner__container">
            <h3 class="banner__title">Как лечат ППРС?</h3>
            <p class="banner__text-preview main-container">Существует особая группа лекарств — препараты, изменяющие течение рассеянного склероза (ПИТРС). Они позволяют замедлить прогрессирование заболевания и продлить время, в течение которого человек остается трудоспособным</p>
        </a>
    </li>
    <li class="list-group-item banner">
        <h2 class="banner__name-page main-container">Жизнь с ППРС</h2>
        <a href="#" class="banner__container">
            <h3 class="banner__title">Как жить с ППРС?</h3>
            <p class="banner__text-preview main-container">Для чего используется контрастное вещество и как с его помощью отслеживают эффективность проводимой терапии</p>
        </a>
    </li>
    <li class="list-group-item banner">
        <h2 class="banner__name-page main-container">Правовая информация</h2>
        <a href="#" class="banner__container">
            <h3 class="banner__title">Какие у меня права?</h3>
            <p class="banner__text-preview main-container">Для чего используется контрастное вещество и как с его помощью отслеживают эффективность проводимой терапии</p>
        </a>
    </li>
</ol>
<nav aria-label="Страницы баннеров" class="d-block d-lg-none">
    <ul class="pagination pagination-banners">
        <li class="page-item pagination-banners__item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li class="page-item pagination-banners__item"><a class="page-link" href="#">1</a></li>
        <li class="page-item pagination-banners__item"><a class="page-link" href="#">2</a></li>
        <li class="page-item pagination-banners__item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
@endsection
