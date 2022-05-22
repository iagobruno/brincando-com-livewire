<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    @livewireStyles
    <script src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
    @stack('extra_head')
</head>

<body>
    <div class="hidden border-b border-sky-600 bg-sky-100 py-3 text-sky-900" x-data="alertState"
        x-bind:class="{ 'hidden': !show }">
        <div class="container" x-text="message"></div>
    </div>

    <main class="container py-8">@yield('content')</main>

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
