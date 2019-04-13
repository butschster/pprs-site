<div class="article-card card-deck mx-lg-n3 px-lg-4">
    @foreach($pages as $page)
        <div class="banner card mx-0 px-lg-3">
            @if($page->parent)
                <h3 class="card-header bg-white banner__name-page main-container px-0">
                    <a class="banner__name-page" href="{{ $page->parent->url() }}">{{ $page->parent->section_title }}</a>
                </h3>
            @endif
            <a href="{{ $page->url() }}" class='banner__container card-body'>
                <h3 class="banner__title card-title d-inline-flex w-auto" style="color: white; background: {{ $page->color }};">{{ $page->section_title }}</h3>
                <p class="banner__text-preview card-text main-container px-lg-3">{{ $page->section_text }}</p>
            </a>
        </div>
    @endforeach
</div>
