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
        <header class="main-header">
            <div class="breadcrumb__wrapper d-none d-lg-block">
                <div class="main-container">
                    @yield('breadcrumbs')
                </div>
            </div>
            <div class="main-container py-4 py-lg-0">
                @include('layout._partials.menu')
            </div>
        </header>
        <main class="main-content">
            <div class="top-banner-wrapper">
                    @yield('banner')
            </div>
            <div class="main-container main-container--main-content">
                <div class="row mx-0 mx-lg-n2">

                    @if($showLastNews ?? true)
                        <section class="px-0 px-lg-2 pr-xl-0 col-lg-8  order-1">
                            @yield('content')
                        </section>
                        <aside class=" px-0 px-lg-2 pl-xl-4 mb-5 mb-lg-0 col-lg-4 sidebar main-sidebar main-container order-3 order-lg-2">

                            @if(!request()->routeIs('subscribe.form'))
                                <a href="{{ route('subscribe.form') }}" class="d-none d-lg-block btn btn-block btn-lg btn-warning btn-subscribe">
                                    Подписаться на рассылку
                                </a>
                            @endif
                            @include('layout._partials.last_news')
                        </aside>

                    @else
                        @yield('content')
                    @endif

                    <div class="main-container d-block d-lg-none order-2">
                        @if(!request()->routeIs('subscribe.form'))
                            <a href="{{ route('subscribe.form') }}" class="btn btn-block btn-lg btn-warning btn-subscribe mt-3 mb-5">
                                Подписаться на рассылку
                            </a>
                        @endif
                    </div>

                    @if(!request()->routeIs('home'))
                        @include('layout._partials.random_articles')
                    @endif
                </div>
            </div>
        </main>
        <footer class="main-footer">
            <div class="main-container">
                @include('layout._partials.footer')
            </div>
        </footer>
    </div>
</body>
</html>
