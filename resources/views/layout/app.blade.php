<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @meta_tags

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
<div id="app">
    <header class="main-header" :class="{ 'main-header--gray': active }">
        <div class="breadcrumb__wrapper d-none d-xl-block">
            <div class="main-container">
                @yield('breadcrumbs')
            </div>
        </div>
        <div class="main-container py-4 py-xl-0">
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
                            <a href="{{ route('subscribe.form') }}"
                               class="d-none d-lg-block btn btn-block btn-lg btn-warning btn-subscribe">
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
                        <a href="{{ route('subscribe.form') }}"
                           class="btn btn-block btn-lg btn-warning btn-subscribe mt-3 mb-5">
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

<!-- Facebook Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '598208574012142');
    fbq('track', 'PageView');
</script>
<noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=598208574012142&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
<script type="text/javascript">
    !function () {
        var t = document.createElement("script");
        t.type = "text/javascript", t.async = !0, t.src = "https://vk.com/js/api/openapi.js?160", t.onload = function () {
            VK.Retargeting.Init("VK-RTRG-355951-eG0U1"), VK.Retargeting.Hit()
        }, document.head.appendChild(t)
    }();
</script>
<noscript><img src="https://vk.com/rtrg?p=VK-RTRG-355951-eG0U1" style="position:fixed; left:-999px;" alt=""/></noscript>

</body>
</html>
