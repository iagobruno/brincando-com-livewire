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

{{-- @example
        <x-dropdown>
            <x-slot:trigger>
                <button class="button">Bulk action</button>
            </x-slot:trigger>
            <x-slot:content>
                <x-dropdown-item class="text-red-600">Deletar itens selecionados</x-dropdown-item>
            </x-slot:content>
        </x-dropdown> --}}
