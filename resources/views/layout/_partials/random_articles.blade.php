<div class="card-deck mt-5">
    @foreach($pages as $page)

        <div class="card">
            @if($page->parent)
                <div class="card-header">
                    <a class="card-text" href="{{ $page->parent->url() }}">{{ $page->parent->section_title }}</a>
                </div>
            @endif
            <div class="card-body text-white" style="background: url('{{ $page->section_image_url }};'">
                <a href="{{ $page->url() }}" style="color: white; background: {{ $page->color }}; display: block">
                    <h4>{{ $page->section_title }}</h4></a>
                <p class="card-text">{{ $page->section_text }}</p>
            </div>
        </div>
    @endforeach
</div>