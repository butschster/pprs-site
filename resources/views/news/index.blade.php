@extends('layout.app', ['showLastNews' => false])

@section('breadcrumbs')
    {{ Breadcrumbs::render('news') }}
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
    <section class="px-0 px-lg-4 col-12 order-1">
        @foreach($news as $item)
            <div class="media mb-5 main-container news-container">
                <div class="media-body">
                    <h2 class="mt-0"><strong>{{ $item->title }}</strong></h2>
                    <div class="my-2"><small class="text-muted">{{ $item->formatted_date }}</small></div>
                    {!! $item->description !!}

                    <div class="mt-3">
                        <a href="{{ $item->url() }}" class="btn btn-outline-success">Читать далее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="pagination-banners">
        {!! $news->render() !!}
    </div>
    @include('layout._partials.random_articles')
@endsection
