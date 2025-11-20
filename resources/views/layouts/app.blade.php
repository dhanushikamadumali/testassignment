<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
     {{-- notify css --}}
    @notifyCss
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- css --}}
    @include('layouts.css')

  

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
     <x-notify::notify />
   

    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

     {{-- notify js --}}
    @notifyJs
</body>
</html>
