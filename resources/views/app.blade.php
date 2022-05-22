@extends('layouts.default')

@section('title')
    Afazeres
@endsection

@section('content')
    <div class="mb-4 flex flex-wrap items-center justify-between">
        <h1 class="text-4xl font-bold">Afazeres</h1>
        <x-dialog>
            <x-slot:trigger>
                <x-button class="button button-blue">Criar novo item</x-button>
            </x-slot:trigger>
            <x-slot:body>
                <h3 class="mb-3 text-2xl font-medium">Criar novo item</h3>
                <livewire:form />
            </x-slot:body>
        </x-dialog>
    </div>

    <livewire:table />
@endsection