<div x-data="dialog" class="w-fit" role="presentation">
    <div x-bind="trigger" class="w-fit">
        {{ $trigger }}
    </div>

    <div class="tablet:items-center fixed inset-0 z-50 grid items-end justify-center overflow-hidden"
        style="display: none;"
        x-show="show">
        <div x-bind="backdrop"
            class="fixed inset-0 z-10 bg-black/40"
            x-show="show"
            x-transition.opacity
            aria-hidden="true"></div>

        <div
            x-bind="dialogEl"
            {{ $body->attributes->merge([
                'class' =>
                    'relative z-20 max-h-[calc(100vh-40px)] w-screen max-w-screen tablet:w-[600px] rounded-t-md tablet:rounded-b-md bg-white py-6 px-6 shadow-lg overflow-auto overscroll-contain',
            ]) }}
            role="dialog"
            aria-modal="true"
            x-show="show"
            x-transition>
            {{ $body }}
            <button class="tablet:block !absolute right-1.5 top-1.5 hidden p-2" type="button"
                x-on:click="closeDialog">
                <svg class="h-5 w-5 stroke-gray-900" aria-hidden="true">
                    <use href="#close" />
                </svg>
            </button>
            <span
                class="tablet:hidden pointer-events-none absolute left-0 right-0 top-2 m-auto h-1 w-7 rounded-lg bg-gray-300"></span>
        </div>
    </div>
</div>

@once
    @push('svg_icons')
        <symbol id="close" viewBox="0 0 24 24" fill="none" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </symbol>
    @endpush
@endonce

{{-- @example
    <x-dialog>
        <x-slot:trigger>
            <x-button class="button-blue">Criar novo item</x-button>
        </x-slot:trigger>
        <x-slot:body class="tablet:!w-[400px]">
            <h3 class="text-2xl font-medium">Criar novo item</h3>
            <p class="mb-3 text-gray-500">Digite no campo baixo</p>
            <livewire:form />
        </x-slot:body>
    </x-dialog> --}}
