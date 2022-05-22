<div x-data="dropdown" class="relative w-fit" x-id="['dropdown']">
    <button
        x-bind="trigger"
        {{ $button->attributes->merge(['type' => 'button'])->class(['button flex justify-between items-center gap-1']) }}
        :aria-expanded="show"
        :aria-controls="$id('dropdown')"
        aria-haspopup="menu">
        <span>{{ $button }}</span>
        <svg class="inline h-3.5 w-3.5 stroke-gray-800" aria-hidden="true">
            <use href="#down" />
        </svg>
    </button>

    <div
        x-bind="menu"
        {{ $menu->attributes->merge(['type' => 'button'])->class(['absolute z-20 top-full right-0 min-w-[140px] rounded bg-white py-1.5 shadow-lg']) }}
        style="display: none;"
        x-transition.origin.top.right
        :id="$id('dropdown')"
        role="menu"
        aria-orientation="vertical">
        {{ $menu }}
    </div>

</div>

@once
    @push('svg_icons')
        <symbol id="down" viewBox="0 0 24 24" fill="none" stroke-width="3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
        </symbol>
    @endpush
@endonce

{{-- @exemplo
    <x-dropdown>
        <x-slot:button class="button-blue">Bulk action</x-slot:button>
        <x-slot:menu>
            <x-dropdown-item class="">Arquivar</x-dropdown-item>
            <x-dropdown-item class="text-red-600">Deletar</x-dropdown-item>
        </x-slot:menu>
    </x-dropdown> --}}
