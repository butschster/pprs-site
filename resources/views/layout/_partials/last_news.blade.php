<h2 class="mb-4">Новое на портале</h2>
@foreach($news as $item)
    <div class="media mb-4">
        <div class="media-body">
            <h3><a href="{{ $item->url() }}">{{ $item->title }}</a></h3>
            <div class="my-2"><small class="text-muted">{{ $item->formatted_date }}</small></div>
            <small>{!! $item->description !!}</small>
        </div>
    </div>
@endforeach
