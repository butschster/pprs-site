@extends('layout.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('news.show', $news) }}
@endsection

@section('banner')
    <div class="jumbotron jumbotron-fluid top-banner top-banner--news">
        <div class="top-banner__container main-container">
            <div class="top-banner__text">
                <div class="top-banner__strong">Первично-прогрессирующий рассеянный склероз</div>
                <div class="top-banner__small">информационный портал для пациентов и их родственников</div>
            </div>
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

    <social-sharing url="{{ $news->url() }}"
                    title="{{ $news->title }}"
                    description="{{ $news->description }}"
                    hashtags="{{ $news->meta_keywords }}"
                    inline-template>
        <div class="mb-5">
            <network network="facebook">
                <img src="{{ asset('images/social/facebook.svg') }}" width="50px" class="mr-3" />
            </network>
            <network network="twitter">
                <img src="{{ asset('images/social/twitter.svg') }}" width="50px" class="mr-3" />
            </network>
            <network network="vk">
                <img src="{{ asset('images/social/vk.svg') }}" width="50px" />
            </network>
        </div>
    </social-sharing>
@endsection
