@extends('layouts.default')

@section('title')
    Todos
@endsection

@section('content')
    <h1 class="text-2xl">Afazeres</h1>

    <livewire:form />
    <livewire:todos />
@endsection
