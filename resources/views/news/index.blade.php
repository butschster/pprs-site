@extends('layout.app', ['showLastNews' => false])

@section('breadcrumbs')
    {{ Breadcrumbs::render('news') }}
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
    <section class="px-0 px-lg-4 col-12 order-1">
        @foreach($news as $item)
            <div class="media mb-5 main-container news-container">
                <div class="media-body">
                    <h3 class="mt-0"><strong>{{ $item->title }}</strong></h3>
                    <div class="my-2"><small class="text-muted">{{ $item->formatted_date }}</small></div>
                    {!! $item->description !!}

                    <div class="mt-3">
                        <a href="{{ $item->url() }}" class="btn btn-outline-success">Читать далее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
        {!! $news->render() !!}
    @include('layout._partials.random_articles')
@endsection
