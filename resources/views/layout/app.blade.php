<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @meta_tags

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        @yield('breadcrumbs')
        @include('layout._partials.menu')
        <div class="container my-3">
            @yield('banner')

            <div class="my-5">
                @if($showLastNews ?? true)
                <div class="row">
                    <div class="col-8">
                        @yield('content')
                    </div>
                    <div class="col-4">
                        @include('layout._partials.last_news')
                    </div>
                </div>
                @else
                    @yield('content')
                @endif
            </div>

            @include('layout._partials.random_articles')
        </div>
        <footer class="bg-dark text-white mt-5">
            <div class="container">
                <div class="p-5">
                    <ul class="list-inline list-unstyled">
                        <li><a href="{{ route('news.index') }}" class="text-white">Новости</a></li>
                    </ul>
                    <p>При поддержке ЗАО "Рош-Москва"</p>
                    <p>Информация, представленная на портале не должна использоваться для самодиагностики и лечения, а так же не может служить заменой консультации врача.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
