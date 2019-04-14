@extends('layout.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('page', $page) }}
@endsection

@section('banner')
    @if($page->has_banner)
        <div class="jumbotron jumbotron-fluid top-banner">
            <div class="top-banner__container main-container" style="background-image: url('{{ $page->section_image_url }};'">
                <strong class="d-block mb-1">Первично-прогрессирующий рассеянный склероз</strong>
                <p class="top-banner__text">{{ $page->banner_content }}</p>
                <h1 class="top-banner__title"><a href="#">{{ $page->title }}</a></h1>
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
        <p class="article-text__description">{!! $page->text !!}</p>
    </article>
    @endif
@endsection
