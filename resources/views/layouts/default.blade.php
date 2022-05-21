<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    @livewireStyles
    @stack('extra_head')
</head>

<body>
    <main>@yield('content')</main>

    @livewireScripts
    <script src="{{ mix('/js/app.js') }}"></script>
    @stack('extra_body')
</body>

</html>
