<!DOCTYPE html>
<html lang="en">
<head>
    <title>PPRS Admin</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:500,400,300,700' rel='stylesheet' type='text/css'>
    <script src="{{ asset('admin/js/core/pace.js') }}"></script>
    <link href="{{  mix("/admin/css/laraspace.css") }}" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="/admin/img/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/admin/img/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/admin/img/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/admin/img/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/admin/img/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/admin/img/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/admin/img/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/admin/img/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/admin/img/favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/admin/img/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/admin/img/favicons/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/admin/img/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/admin/img/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/admin/img/favicons/manifest.json">
    <link rel="mask-icon" href="/admin/img/favicons/safari-pinned-tab.svg" color="#333333">
    <link rel="shortcut icon" href="/admin/img/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="/admin/img/favicons/mstile-144x144.png">
    <meta name="msapplication-config" content="/admin/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#333333">
</head>
<body class="layout-default skin-stark">
<div id="app" class="site-wrapper">
    <div class="mobile-menu-overlay" @click.prevent="$utils.toggleSidebar"></div>
    <router-view></router-view>
</div>
<script type="text/javascript">
    window.FILES_PATH = '{{ config('lfm.url_prefix') }}';
</script>
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ mix("/admin/js/app.js" )}}"></script>
</body>
</html>
