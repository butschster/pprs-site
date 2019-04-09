@extends('layout.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('page', $page) }}
@endsection

@section('banner')
    @if($page->has_banner)
        <div class="card">
            <img src="{{ $page->banner_url }}" class="card-img-top">
            <div class="card-body">
                <h1>{{ $page->title }}</h1>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
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
@endsection