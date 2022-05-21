@extends('layouts.default')

@section('title')
    Afazeres
@endsection

@section('content')
    <div class="mb-3 flex items-center justify-between">
        <h1 class="text-3xl font-bold">Afazeres</h1>
        <button
            class="flex cursor-pointer items-center gap-1 rounded bg-emerald-400 p-2 py-1 text-sm uppercase text-emerald-900 !outline-none hover:bg-emerald-500/80 focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2">Criar</button>
    </div>

    <div class="my-3 flex items-center justify-between">
        <div></div>
        <x-dropdown>
            <x-slot name="trigger">
                <button>Bulk action</button>
            </x-slot>
            <x-slot name="content">
                <x-dropdown-item class="text-red-600">Deletar itens selecionados</x-dropdown-item>
            </x-slot>
        </x-dropdown>
    </div>

    <livewire:table />
@endsection
