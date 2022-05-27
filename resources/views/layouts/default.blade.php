<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    @livewireStyles

    @livewireScripts
    <script src="https://unpkg.com/@hotwired/turbo@7.1.0/dist/turbo.es2017-umd.js" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" defer
        data-turbolinks-eval="false"></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>

    @stack('extra_head')
</head>

<body>
    <main class="container py-8">
        @yield('content')
    </main>

    <div class="modals"></div>
    @include('layouts.partials.notifications')
    <svg style="display: none" version="2.0">
        <defs>
            @stack('svg_icons')
        </defs>
    </svg>
    @stack('extra_body')
</body>

</html>
