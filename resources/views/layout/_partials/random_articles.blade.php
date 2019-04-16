<div class="article-card card-deck mx-lg-n3 px-lg-4">
    @foreach($pages as $page)
        <div class="banner card mx-0 px-lg-3 mb-4 mb-lg-0">
            <h3 class="card-header bg-white banner__name-page main-container px-0">
                <a class="banner__name-page" href="{{ $page->parent->url() }}" style="color: {{ $page->color }}">{{ $page->parent->section_title }}</a>
            </h3>
            <a href="{{ $page->url() }}" class='banner__container card-body'>
                <h4 class="banner__title card-title d-inline-flex w-auto" style="color: white; background: {{ $page->color }}; display: block">{{ $page->section_subtitle }}</h4>
                <div class="banner__text-preview card-text main-container px-lg-4">{{ $page->section_text }}</div>
            </a>
        </div>
    @endforeach
</div>
