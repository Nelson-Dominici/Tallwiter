<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
        <title>{{ $title ?? 'Page Title' }} / Tallwiter</title>
        <link rel="icon" href="{{asset('/images/favicon-logo.png')}}" type="image/x-icon">
        <tallstackui:script />
        @vite('resources/css/app.css')
        @vite('resources/css/tailwind.css')
    </head>
    <body class="flex justify-center overflow-y-scroll">

        {{ $slot }}

        @persist('toast')
            <x-toast />
        @endpersist

    </body>
</html>
