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

                <!-- <div class="my-5"> -->
                    @if($showLastNews ?? true)
                    <div class="row mx-0">
                        <section class="col-12 px-0 px-md-4 col-md-8 col-lg-9">
                            @yield('content')
                        </section>
                        <aside class="col-12 px-0 px-md-4 col-md-4 col-lg-3 bg-light sidebar">
                            <a  href="№" class="btn btn-subscribe">Подписаться на рассылку</a>
                            @include('layout._partials.last_news')
                        </aside>
                    </div>
                    @else
                    @yield('content')
                    @endif
                <!-- </div> -->
                <!-- @include('layout._partials.random_articles') -->
        </main>
        <footer class="main-footer bg-dark text-white">
            <div class="main-container">
                <div class="row">
                    <ol class="col-6 col-md-8 col-lg-9">
                        <a href="{{ route('news.index') }}">Новости</a>
                        <a href="#" class="d-none d-md-block">Карта сайта</a>
                    </ol>
                    <ul class="col-6 col-md-4 col-lg-3 social__list">
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
                <p class="col-12 col-md-8 col-lg-9">При поддержке ЗАО «Рош-Москва»</p>
                <p class="col-12 col-md-8 col-lg-9">Информация, представленная на портале, не должна использоваться для самодиагностики и лечения, а так же не может служить заменой консультации врача.</p>
            </div>
        </footer>
    </div>
</body>
</html>
