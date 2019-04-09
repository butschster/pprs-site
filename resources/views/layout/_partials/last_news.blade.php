<h3>Новое на портале</h3>
@foreach($news as $item)
    <div class="media mb-5">
        <div class="media-body">
            <a href="{{ $item->url() }}"><strong><small>{{ $item->title }}</small></strong></a>
            <div class="my-2"><small class="text-muted">{{ $item->formatted_date }}</small></div>
            <small>{!! $item->description !!}</small>
        </div>
    </div>
@endforeach