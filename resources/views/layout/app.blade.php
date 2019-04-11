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
            <div class="breadcrumb__wrapper">
                <div class="main-container">
                    @yield('breadcrumbs')
                </div>
            </div>
            <div class="main-container">
                @include('layout._partials.menu')
            </div>
        </header>
        <main class="main-content">
            @yield('banner')
            <div class="main-container main-container--main-content">
                <div class="row mx-0 mx-lg-n4">

                    @if($showLastNews ?? true)
                        <section class="px-0 px-lg-4 col-lg-8  order-1">
                            @yield('content')
                        </section>
                        <aside class=" px-0 px-lg-4 col-lg-4 sidebar main-sidebar  order-3 order-lg-2">

                            @if(!request()->routeIs('subscribe.form'))
                                <a href="{{ route('subscribe.form') }}" class="btn btn-block btn-lg btn-warning btn-subscribe">
                                    Подписаться на рассылку
                                </a>
                            @endif
                            @include('layout._partials.last_news')
                        </aside>

                    @else
                        @yield('content')
                    @endif

                    @if(!request()->routeIs('home'))
                        @include('layout._partials.random_articles')
                    @endif
                </div>
            </div>
        </main>
        <footer class="main-footer bg-dark text-white">
            <div class="main-container">
                <div class="row">
                    <ol class="col-6 col-lg-8">
                        <a href="{{ route('news.index') }}">Новости</a>
                        <a href="#" class="d-none d-md-block">Карта сайта</a>
                    </ol>
                    <ul class="col-6 col-lg-4 social__list">
                        <li class="social__item">
                            <a class="social__link social__link--twitter" href="https://twitter.com">
                                <img width="17.5px" height="14.663px">
                                <span class="visually-hidden">Twitter</span>
                            </a>
                        </li>
                        <li class="social__item">
                            <a class="social__link social__link--facebook" href="https://www.facebook.com">
                                <img width="8.673px" height="18.944px">
                                <span class="visually-hidden">Facebook</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <p class="col-12 col-lg-8">При поддержке ЗАО «Рош-Москва»</p>
                <p class="col-12 col-lg-8">Информация, представленная на портале, не должна использоваться для самодиагностики и лечения, а так же не может служить заменой консультации врача.</p>
            </div>
        </footer>
    </div>
</body>
</html>
