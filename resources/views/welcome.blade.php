<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet">

    </head>
    <body class="d-flex justify-content-center bg-dark pt-5 pb-5 min-vh-100">
        <div id="app" class="d-flex flex-column align-items-center w-75 rounded bg-white p-5 overflow-scroll">
            <router-view></router-view>
        </div>
    </body>
<script src="/js/app.js"></script>
</html>
