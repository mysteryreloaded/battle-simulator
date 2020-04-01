<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Nenad - Battle Simulator</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="bg-blue-300">
        <div id="app">
            <div class="flex justify-around bg-gray-800 text-white text-xl h-16 items-center">
                <router-link :to="{ name: 'battle-list' }">Battle Simulator</router-link>
            </div>
            <div class="bg-blue-300 h-full">
                <router-view></router-view>
                {{-- Work in Progress here... --}}
            </div>

        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
