@foreach($pages as $page)
    @if($page->has_section_image)
        <a href="{{ $page->url() }}" class="card mt-5 d-block" style="background: url('{{ $page->section_image_url }};'">
            <!-- <img src="{{ $page->section_image_url }}" class="card-img-top"> -->
            <div class="card-body  fa-fa-fa">
                <h4 style="background: {{ $page->color }}">{{ $page->section_title }}</h4>
                <p class="card-text">{{ $page->section_text }}</p>
            </div>
        </a>
    @endif
@endforeach
