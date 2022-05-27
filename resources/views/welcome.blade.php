@extends('layouts.default')

@section('title')
    Welcome
@endsection

@section('content')
    <a href="{{ route('products') }}" class="cursor-pointer text-blue-500 underline">Gerenciar produtos ></a>
@endsection
