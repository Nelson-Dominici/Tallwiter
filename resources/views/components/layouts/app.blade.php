<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/tailwind.css')
        <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
        <title>TALLBlog - {{ $title ?? 'Page Title' }}</title>
        <link rel="icon" href="{{asset('/images/fiveicon.png')}}" type="image/x-icon">
    </head>
    <body class="font-questrial h-screen">
        {{ $slot }}
    </body>
</html>
