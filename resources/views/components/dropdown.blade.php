<div x-data="{ show: false }" class="relative w-fit">
    <div class="w-fit" x-on:click="show = !show">{{ $trigger }}</div>

    <div class="absolute top-full right-0 rounded bg-white py-1 shadow-lg"
        style="display: none;"
        x-show="show"
        x-on:click.away="show = false"
        x-on:click="show = false">
        {{ $content }}
    </div>

</div>
