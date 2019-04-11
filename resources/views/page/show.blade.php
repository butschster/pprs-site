@extends('layout.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('page', $page) }}
@endsection

@section('banner')
    @if($page->has_banner)
        <div class="jumbotron jumbotron-fluid top-banner" style="background: url('{{ $page->section_image_url }};'">
            <div class="top-banner__container main-container">
                <strong>Первично-прогрессирующий рассеянный склероз</strong>
                <p class="top-banner__text">Информационный портал для пациентов и их родственников</p>
                <h1 class="display-4"><a href="#">{{ $page->title }}</a></h1>
            </div>
        </div>
    @endif
@endsection

@section('content')
    @if(!$page->isArticle())
        @include('page._partials.subpages', ['pages' => $page->getChildren()])
    @else
        {!! $page->text !!}
    @endif
    @include('layout._partials.random_articles')
@endsection
