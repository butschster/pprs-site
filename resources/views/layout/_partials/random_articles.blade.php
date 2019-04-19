<div class="article-card card-deck row mx-lg-n3 px-lg-2">
    @foreach($pages as $page)
        <div class="banner card col-12 col-lg-4 mx-0 px-lg-3 mb-4 mb-lg-0">
            <h3 class="card-header bg-white banner__name-page main-container px-0">
                <a class="banner__name-page" href="{{ $page->url() }}" style="color: {{ $page->color }}">{{ $page->section_title }}</a>
            </h3>
            <a href="{{ $page->url() }}" class="banner__container card-body p-0" style="background-image: url({{ $page->section_image_url }})">
                <div class="banner__bg-blur">
                    <h4 class="banner__title card-title d-inline-flex w-auto" style="color: white; background: {{ $page->color }}; display: block">{{ $page->section_subtitle }}</h4>
                    <div class="banner__text-preview card-text main-container px-lg-4">{!! $page->section_text !!}</div>
                </div>
            </a>
        </div>
    @endforeach
</div>
