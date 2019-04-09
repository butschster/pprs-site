@foreach($pages as $page)
    @if($page->hasSectionImage())
        <div class="card mt-5">
            <img src="{{ $page->sectionImageUrl() }}" class="card-img-top">
            <div class="card-body">
                <h4 style="background: {{ $page->color }}">{{ $page->section_title }}</h4>
                <p class="card-text">{{ $page->section_text }}</p>
            </div>
        </div>
    @endif
@endforeach