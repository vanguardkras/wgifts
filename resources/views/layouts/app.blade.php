<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta', '')

    <title>Выбор подарков {{ config('app.name') }}</title>

    {{-- Styles --}}
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Marck+Script&display=swap" rel="stylesheet">

    {{-- JS --}}
    <script defer src="/js/functions.js"></script>
    {{-- VK share --}}
    <script type="text/javascript" src="https://vk.com/js/api/share.js?95" charset="windows-1251"></script>
</head>
<body>
@include('layouts.header')
<main class="content">
    @yield('content')
</main>
@include('layouts.footer')
</body>
</html>
