<h2 class="d-none d-lg-block mb-4 main-sidebar__title">
    <a href="{{ route('news.index') }}" class="text-warning">Новое на портале</a>
</h2>
@foreach($news as $item)
    <div class="media mb-4 mt-5 pr-xl-3">
        <div class="media-body news">
            <h3 class="news__title text-break">{{ $item->title }}</h3>
            <small class="text-muted news__date">{{ $item->formatted_date }}</small>
            <div class="news__description text-break">
                <a href="{{ $item->url() }}" class="news__link">{!! $item->description !!}</a>
            </div>
        </div>
    </div>
@endforeach
