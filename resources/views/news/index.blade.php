@extends('layout.app', ['showLastNews' => false])

@section('breadcrumbs')
    {{ Breadcrumbs::render('news') }}
@endsection

@section('banner')
    <div class="card">
        <img src="https://dummyimage.com/800x200/666/fff&text=News" class="card-img-top">
    </div>
@endsection

@section('content')
    <div class="mt-5">
        @foreach($news as $item)
            <div class="media mb-5">
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

        {!! $news->render() !!}
    </div>
    @include('layout._partials.random_articles')
@endsection
