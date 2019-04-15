@extends('layout.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('page', $page) }}
@endsection

@section('banner')
    @if($page->has_banner)
        <div class="jumbotron jumbotron-fluid top-banner">
<<<<<<< HEAD
            <div class="top-banner__container main-container">
                <div class="top-banner__text"></div>
                <h1 class="top-banner__title">Section name</h1>
=======
            <div class="top-banner__container main-container" style="background-image: url('{{ $page->banner_url }};'">
                <strong class="d-block mb-1">Первично-прогрессирующий рассеянный склероз</strong>
                <p class="top-banner__text">{{ $page->banner_content }}</p>
                <h1 class="top-banner__title"><a href="{{ $page->url() }}">{{ $page->title }}</a></h1>
>>>>>>> feature/admin
            </div>
        </div>
    @endif
@endsection

@section('content')
    @if(!$page->isArticle())
        @include('page._partials.subpages', ['pages' => $page->getChildren()])
    @else
    <article class="article-text main-container mb-5">
        <h2 class="article-text__title">{{ $page->title }}</h2>
        <div class="article-text__description">{!! $page->text !!}</div>
    </article>
    @endif
@endsection
