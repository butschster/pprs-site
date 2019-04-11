@extends('layout.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('news.show', $news) }}
@endsection

@section('banner')
    <div class="jumbotron jumbotron-fluid top-banner">
        <div class="top-banner__container main-container">
            <strong class="d-block mb-1">Первично-прогрессирующий рассеянный склероз</strong>
            <p class="top-banner__text">Информационный портал для пациентов и их родственников</p>
            <h1 class="top-banner__title"><a href="#">Новости</a></h1>
        </div>
    </div>
@endsection

@section('content')
    <article class="article-text main-container mb-5">
        <h2 class="article-text__title">{{ $news->title }}</h2>
        <small class="text-muted d-block mb-3">{{ $news->formatted_date }}</small>
        <p class="article-text__description">{!! $news->text !!}</p>
    </article>
@endsection
