<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Vue Js Page</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @vite('resources/js/app.js')
    </head>
    <body>

        <div id="app">
            
            <home-example />

        </div>
        
    </body>
</html>