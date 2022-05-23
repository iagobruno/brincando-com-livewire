@extends('layouts.default')

@section('title')
    Afazeres
@endsection

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between">
        <h1 class="text-4xl font-bold">Afazeres</h1>
        <x-dialog>
            <x-slot:trigger>
                <x-button class="button-blue">Criar novo item</x-button>
            </x-slot:trigger>
            <x-slot:body class="tablet:!w-[400px]">
                <h3 class="text-2xl font-medium">Criar novo item</h3>
                <p class="mb-3 text-gray-500">Digite no campo baixo</p>
                <livewire:form />
            </x-slot:body>
        </x-dialog>
    </div>

    <div class="flex items-center justify-between gap-3">
        <x-input type="search" class="my-4 w-full px-3 py-1" placeholder="🔍 Pesquisar..."></x-input>

        <x-dropdown>
            <x-slot:button class="whitespace-nowrap">Bulk action</x-slot:button>
            <x-slot:menu>
                <x-dropdown-item class="">Arquivar itens selecionados</x-dropdown-item>
                <x-dropdown-item class="text-red-600">Deletar itens selecionados</x-dropdown-item>
            </x-slot:menu>
        </x-dropdown>
    </div>

    <livewire:table />
@endsection
