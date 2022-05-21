<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    @livewireStyles
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @stack('extra_head')
</head>

<body>
    <main class="m-auto max-w-4xl py-8 px-4">@yield('content')</main>

    <svg style="display: none" version="2.0">
        <defs>
            @stack('svg_icons')
        </defs>
    </svg>
    @livewireScripts
    <script src="{{ mix('/js/app.js') }}"></script>
    @stack('extra_body')
</body>

</html>
