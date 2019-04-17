@extends('layout.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('page', $page) }}
@endsection

@section('banner')
    @if($banner = $page->banner_data)
        @if(!$banner->isPage($page->getModel()))
        <a href="{{ $banner->url() }}" class="d-block jumbotron jumbotron-fluid top-banner" style="background-image: url({{ $banner->imageUrl() }})">
        @else
        <div class="jumbotron jumbotron-fluid top-banner" style="background-image: url({{ $banner->imageUrl() }})">
        @endif
            <div class="top-banner__container main-container">
                <div class="top-banner__text">{{ $banner->content() }}</div>
                <h1 class="top-banner__title">{{ $banner->title() }}</h1>
            </div>

        @if(!$banner->isPage($page->getModel()))
        </a>
        @else
        </div>
        @endif
    @endif
@endsection

@section('content')
    @if(!$page->isArticle())
        @include('page._partials.subpages', ['pages' => $page->getChildren()])
    @else
        @include('page._partials.article')
    @endif
@endsection
