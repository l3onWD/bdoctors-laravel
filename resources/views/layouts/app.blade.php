<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BDoctors') }} @yield('title')</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Fix Style Loading --}}
    <style>
        body {
            display: none;
        }
    </style>

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])

</head>

<body>
    <div id="app">

        {{-- Main Header --}}
        @include('includes.header')

        <div class="app-wrapper">

            {{-- Sidebar --}}
            @include('includes.sidebar')

            {{-- Main content --}}
            <main class="app-main bg-light">
                @yield('content')
            </main>
        </div>

    </div>

    {{-- Scripts --}}
    @vite(['resources/js/commons/sidebar-toggling.js'])
    @yield('scripts')
</body>

</html>