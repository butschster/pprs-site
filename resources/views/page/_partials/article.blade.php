<article class="article-text main-container mb-5">
    <h2 class="article-text__title" style="color: {{ $page->color }}">{{ $page->title }}</h2>
    <div class="article-text__description mb-3">{!! $page->section_text !!}</div>
    <img src="{{ $page->section_image_url }}" alt="{{ $page->section_title }}">
    <div class="article-text__description">{!! $page->parsed_text !!}</div>
</article>

<social-sharing url="{{ $page->url() }}"
                title="{{ $page->title }}"
                description="{{ $page->meta_description }}"
                hashtags="{{ $page->meta_keywords }}"
                inline-template>
    <div class="mb-5">
        <network network="facebook">
            <img src="{{ asset('images/social/facebook.svg') }}" width="50px" class="mr-3" />
        </network>
        <network network="twitter">
            <img src="{{ asset('images/social/twitter.svg') }}" width="50px" class="mr-3" />
        </network>
        <network network="vk">
            <img src="{{ asset('images/social/vk.svg') }}" width="50px" />
        </network>
    </div>
</social-sharing>