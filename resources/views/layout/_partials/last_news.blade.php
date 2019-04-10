<h3 class="mb-4">Новое на портале</h3>
@foreach($news as $item)
    <div class="media mb-4">
        <div class="media-body">
            <h5><a href="{{ $item->url() }}">{{ $item->title }}</a></h5>
            <div class="my-2"><small class="text-muted">{{ $item->formatted_date }}</small></div>
            <small>{!! $item->description !!}</small>
        </div>
    </div>
@endforeach