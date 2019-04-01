<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Spread the compassionate Vegan message with our curated playlists, or create your own from our huge video library.">
    <meta name="keywords" content="vegan, videos, playlists, activism, activist, hacktivists, veganism, share, youtube">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="https://i.imgur.com/Hfkiumn.png">
    <meta property="og:description" content="Spread the compassionate Vegan message with our curated playlists, or create your own from our huge video library.">
    <meta property="og:title" content="Vegan Playlist | Find and share inspirational Vegan videos">
    <meta property="og:site_name" content="Vegan Playlist | Find and share inspirational Vegan videos">
    <meta property="og:see_also" content="{{ url('/') }}">
    <meta itemprop="name" content="Vegan Playlist | Find and share inspirational Vegan videos">
    <meta itemprop="description" content="Spread the compassionate Vegan message with our curated playlists, or create your own from our huge video library.">
    <meta itemprop="image" content="https://i.imgur.com/Hfkiumn.png">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="{{ url('/') }}">
    <meta name="twitter:title" content="Vegan Playlist | Find and share inspirational Vegan videos">
    <meta name="twitter:description" content="Spread the compassionate Vegan message with our curated playlists, or create your own from our huge video library.">
    <meta name="twitter:image" content="https://i.imgur.com/Hfkiumn.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@yield('head')

    <title>Vegan Playlist | @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5c8fba2e1c07550011f24f3c&product=custom-share-buttons"></script>
    {!! NoCaptcha::renderJs() !!}
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body style="padding-bottom: 40px;">
    <div id="app">
        @yield('content')
    </div>
</body>
</html>
