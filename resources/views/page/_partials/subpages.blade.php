
@foreach($pages as $page)
    @if($page->has_section_image)
        <div class="banner">
            <h2 class="banner__name-page main-container" style="color: {{ $page->color }}">{{ $page->section_title }}</h2>
            <a href="{{ $page->url() }}" class="banner__container">
                <h2 class="banner__title" style="background: {{ $page->color }}">{{ $page->section_subtitle }}</h2>
                <div class="banner__text-preview main-container">{{ $page->section_text }}</div>
            </a>
        </div>
    @endif
@endforeach
