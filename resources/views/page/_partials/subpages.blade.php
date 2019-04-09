@foreach($pages as $page)
    @if($page->has_section_image)
        <a href="{{ $page->url() }}" class="card mt-5">
            <img src="{{ $page->section_image_url }}" class="card-img-top">
            <div class="card-body">
                <h4 style="background: {{ $page->color }}">{{ $page->section_title }}</h4>
                <p class="card-text">{{ $page->section_text }}</p>
            </div>
        </a>
    @endif
@endforeach