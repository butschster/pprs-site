@extends('layout.app')

@section('banner')
    <div class="jumbotron jumbotron-fluid top-banner top-banner--main">
        <div class="top-banner__container main-container">
            <div class="top-banner__text-wrapper">
                <h1 class="top-banner__title top-banner--main__title"></h1>
                <p class="top-banner__text top-banner--main__text"></p>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="list-group banners-group mb-5">
    @include('page._partials.subpages')
</div>
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
