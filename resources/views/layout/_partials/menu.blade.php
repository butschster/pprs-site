<nav class="navbar navbar-expand-lg main-navbar navbar-light">
    <!-- <a class="navbar-brand" href="{{ route('home')  }}">ППРС</a> -->
    <button class="navbar-toggler main-navbar__toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav main-navbar__list">

        @foreach($pages as $page)
            @if($page->hasChildren())
            <li class="nav-item dropdown">
                <a class="nav-link main-navbar__link px-0" href="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-angle-right mr-1" style="color: {{ $page->color }}"></i>
                    <b>{{ $page->title }}</b>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ $page->url() }}">Перейти в раздел</a>
                    @foreach($page->children as $child)
                        <a class="dropdown-item" href="{{ $child->url() }}">{{ $child->title }}</a>
                        @endforeach
                </div>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ $page->url() }}">
                    <i class="fas fa-angle-right" style="color: {{ $page->color }}"></i> {{ $page->title }}
                </a>
            </li>
            @endif
        @endforeach
        </ul>
    </div>
</nav>
