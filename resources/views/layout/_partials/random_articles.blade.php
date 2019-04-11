<div class="card-deck mt-5">
    @foreach($pages as $page)

        <div class="card">
            @if($page->parent)
                <div class="card-header">
                    <a class="card-text" href="{{ $page->parent->url() }}">{{ $page->parent->section_title }}</a>
                </div>
            @endif
            <div class="card-body text-white" style="background: url('{{ $page->section_image_url }};'">
                <a href="{{ $page->url() }}" class='w-100'>
                    <h3 style="color: white; background: {{ $page->color }}; display: block">{{ $page->section_title }}</h3>
                    <p class="card-text">{{ $page->section_text }}</p>
                </a>
            </div>
        </div>
    @endforeach
</div>
