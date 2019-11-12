<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name') }} @yield('title')</title>

    <meta property="og:description" content="@yield('description', config('qeoqeo.description'))"/>
    <meta property="og:image" content="@yield('ogimage', asset('images/logo-400.jpg'))"/>
    <meta property="fb:app_id" content="534730943930964"/>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
    <link href="https://fonts.googleapis.com/css?family=Inconsolata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    @stack('css')
</head>
<body>
@include('embed')
<div class="container">
    <div class="top">
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" width="80" alt="{{ config('app.name') }}"/>
        </a>
        <p>{{ config('qeoqeo.description') }}</p>
        <ul class="menu">
            <li><a href="{{ route('indexVideo') }}"><strong>#video</strong></a></li>
            <li><a href="{{ config('qeoqeo.fb') }}" target="_blank">facebook</a></li>
            <li><a href="mailto:{{ config('qeoqeo.mail') }}">mail</a></li>
        </ul>
        <p></p>
    </div>

    @yield('content')
</div>

<script src="{{ asset('vendor/jquery/jquery-3.4.1.min.js') }}"></script>
@stack('js')
</body>
