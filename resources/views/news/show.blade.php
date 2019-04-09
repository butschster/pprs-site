@extends('layout.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('news.show', $news) }}
@endsection

@section('banner')
    <div class="card">
        <img src="https://dummyimage.com/800x200/666/fff&text=News" class="card-img-top">
    </div>
@endsection

@section('content')
    <h1>{{ $news->title }}</h1>
    <div class="my-2"><small class="text-muted">{{ $news->formatted_date }}</small></div>
    <div>
        {!! $news->text !!}
    </div>
@endsection