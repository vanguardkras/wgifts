<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    {{-- Styles --}}
    <link href="{{ asset('css/list.css') }}" rel="stylesheet">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    {{-- JS --}}
    <script defer src="{{ asset('js/main.js') }}"></script>
</head>
<body>
<main>
    <h6><a href="{{ config('app.url') }}" target="_blank">{{ config('app.name') }}</a></h6>
    {{ $slot }}
</main>
</body>
</html>
