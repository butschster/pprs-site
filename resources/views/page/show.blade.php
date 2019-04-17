@extends('layout.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('page', $page) }}
@endsection

@section('banner')
    @if($page->has_banner)
        <div class="jumbotron jumbotron-fluid top-banner" style="background-image: url('{{ $page->banner_url }};'">
            <div class="top-banner__container main-container">
                <strong>Первично-прогрессирующий рассеянный склероз</strong>
                <div class="top-banner__text">{{ $page->banner_content }}</div>
                <h1 class="top-banner__title">{{ $page->title }}</h1>
            </div>
        </div>
    @endif
@endsection

@section('content')
    @if(!$page->isArticle())
        @include('page._partials.subpages', ['pages' => $page->getChildren()])
    @else
        @include('page._partials.article')
    @endif
@endsection
