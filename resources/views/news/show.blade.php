@extends('layout.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('news.show', $news) }}
@endsection

@section('banner')
    <div class="jumbotron jumbotron-fluid top-banner top-banner--news">
        <div class="top-banner__container main-container">
            <div class="top-banner__text"></div>
            <h1 class="top-banner__title">Новости</h1>
        </div>
    </div>
@endsection

@section('content')
    <article class="article-text main-container mb-5">
        <h2 class="article-text__title">{{ $news->title }}</h2>
        <small class="text-muted d-block mb-3">{{ $news->formatted_date }}</small>
        <div class="article-text__description">{!! $news->parsed_text !!}</div>
    </article>
@endsection
