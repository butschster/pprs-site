@extends('layout.app')

@section('content')
    {{ Breadcrumbs::render('page', $page) }}


    @if($page->hasBanner())
        <div class="card">
            <img src="{{ $page->bannerUrl() }}" class="card-img-top">
            <div class="card-body">
                <h1>{{ $page->title }}</h1>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    @endif

   <div class="row">
       <div class="col-8">
           @if(!$page->isArticle())
               @include('page._partials.subpages', ['pages' => $page->descendants])
           @else

           @endif
       </div>
       <div class="col-4">
           News
       </div>
   </div>
@endsection