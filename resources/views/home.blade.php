@extends('layout.app')

@section('banner')
    <!-- <div class="card">
        <div class="card-body">
            <h3>Первично-прогрессирующий рассеянный склероз</h3>
            <p class="card-text">Информационный портал для пациентов и родственников</p>
        </div>
        <img src="https://dummyimage.com/800x200/666/fff&text=HomePage" class="card-img-top">
    </div> -->
    <div class="jumbotron jumbotron-fluid top-banner top-banner--main">
        <div class="top-banner__container main-container">
            <h1 class="top-banner--main__title">Первично-прогрессирующий рассеянный склероз</h1>
            <p class="top-banner__text top-banner--main__text">Информационный портал для пациентов и их родственников</p>
        </div>
    </div>
@endsection
@section('content')
    <ol class="list-group list-group-flush">
         <li class="list-group-item banner">
            <h2 class="banner__name-page">РС- это</h2>
            <a href="#" class="banner__container">
                <h3 class="banner__title">Магнитно-резонансная томография (МРТ)</h3>
                <p class="banner__text-preview">Для чего используется контрастное вещество и как с его помощью отслеживают эффективность проводимой терапии</p>
            </a>
        </li>
        <li class="list-group-item banner">
            <h2 class="banner__name-page">Диагностика</h2>
            <a href="#" class="banner__container">
                <h3 class="banner__title">Упражнения в удовольствие</h3>
                <p class="banner__text-preview">Рассеянный склероз — не повод оставаться на обочине активной жизни. Спектр возможной физической нагрузки очень широк, практически каждый может найти для себя что-то подходящее и вдохновляющее</p>
            </a>
        </li>
        <li class="list-group-item banner">
            <h2 class="banner__name-page">Лечение</h2>
            <a href="#" class="banner__container">
                <h3 class="banner__title">Лекарственные препараты</h3>
                <p class="banner__text-preview">Существует особая группа лекарств — препараты, изменяющие течение рассеянного склероза (ПИТРС). Они позволяют замедлить прогрессирование заболевания и продлить время, в течение которого человек остается трудоспособным</p>
            </a>
        </li>
        <li class="list-group-item banner">
            <h2 class="banner__name-page">Жизнь с ППРС</h2>
            <a href="#" class="banner__container">
                <h3 class="banner__title">Магнитно-резонансная томография (МРТ)</h3>
                <p class="banner__text-preview">Для чего используется контрастное вещество и как с его помощью отслеживают эффективность проводимой терапии</p>
            </a>
        </li>
        <li class="list-group-item banner">
            <h2 class="banner__name-page">Правовая информация</h2>
            <a href="#" class="banner__container">
                <h3 class="banner__title">Магнитно-резонансная томография (МРТ)</h3>
                <p class="banner__text-preview">Для чего используется контрастное вещество и как с его помощью отслеживают эффективность проводимой терапии</p>
            </a>
        </li>
    </ol>
    <nav aria-label="Страницы баннеров" class="d-block d-md-none">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
@endsection
