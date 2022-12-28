<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Writebot - AI Writing Assistant for Bloggers</title>

    @vite('resources/css/app.css')
</head>

<body class="antialiased font-space-grotesk">
    <div id="app"></div>
</body>

@vite('resources/js/app.js')

</html>
