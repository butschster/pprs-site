<article class="article-text main-container mb-5">
    <h2 class="article-text__title" style="color: {{ $page->color }}">{{ $page->title }}</h2>
    <div class="article-text__description mb-3">{!! $page->section_text !!}</div>
    <img src="{{ $page->section_image_url }}" alt="{{ $page->section_title }}">
    <div class="article-text__description">{!! $page->parsed_text !!}</div>
</article>