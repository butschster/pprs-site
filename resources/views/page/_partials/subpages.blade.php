@foreach($pages as $page)
    @if($page->has_section_image)
        <div class="banner">
            <!-- <a href="{{ $page->url() }}" class="banner__container" style="background: url('{{ $page->section_image_url }};')"> -->
            <a href="{{ $page->url() }}" class="banner__container">
                <h2 class="banner__title" style="background: {{ $page->color }}">{{ $page->section_title }}</h2>
                <p class="banner__text-preview main-container">{{ $page->section_text }}</p>
            </a>
        </div>
    @endif
@endforeach
