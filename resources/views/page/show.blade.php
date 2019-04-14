@extends('layout.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('page', $page) }}
@endsection

@section('banner')
    @if($page->has_banner)
        <div class="jumbotron jumbotron-fluid top-banner">
            <div class="top-banner__container main-container">
                <div class="top-banner__text"></div>
                <h1 class="top-banner__title">Section name</h1>
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
