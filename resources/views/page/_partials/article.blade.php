<article class="article-text main-container mb-5">
    <h2 class="article-text__title">{{ $page->title }}</h2>
    <h3>{{ $page->section_title }}</h3>
    <img src="{{ $page->section_image_url }}" alt="{{ $page->section_title }}">
    <div class="article-text__description">{!! $page->text !!}</div>
</article>