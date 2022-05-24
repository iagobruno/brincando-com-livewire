<div>
    <div class="mb-4 flex flex-wrap items-center justify-between">
        <h1 class="text-4xl font-bold">Produtos</h1>
        <x-dialog>
            <x-slot:trigger>
                <x-button class="button-blue">Criar produto</x-button>
            </x-slot:trigger>
            <x-slot:body class="tablet:!w-[400px]">
                <h3 class="text-2xl font-medium">Criar novo produto</h3>
                <p class="mb-3 text-gray-500">Preencha o formulário abaixo</p>
                <livewire:form />
            </x-slot:body>
        </x-dialog>
    </div>

    <div class="my-4 flex items-center justify-between gap-3">
        <x-input
            type="search"
            class="w-full px-3 py-1"
            placeholder="🔍 Pesquisar produtos..."
            wire:model.debounce.500ms="query" />

        <x-dropdown>
            <x-slot:button class="whitespace-nowrap">Ordenar por</x-slot:button>
            <x-slot:menu>
                <x-dropdown-item class="">Mais antigos primeiro</x-dropdown-item>
                <x-dropdown-item class="">Mais recentes primeiro</x-dropdown-item>
            </x-slot:menu>
        </x-dropdown>
    </div>

    <livewire:table />
</div>
