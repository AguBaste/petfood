@extends('layout.plantilla')

@section('titulo', 'proveedores')

@section('content')
<h1>editando proveedor</h1>
    <form action="{{ route('providers.update',$provider) }}" class="form" method="POST">
        @csrf
        @method('patch')
        <label for="name">Nombre </label>
            <input type="text" name="name" value="{{ $provider->name }}">

        @error('name')
            {{ $message }}
        @enderror
        <label for="phone">Telefono </label>
            <input type="text" name="phone" value="{{ $provider->phone }}">
            @error('phone')
                {{ $message }}
            @enderror
           
 
        <x-input-btn>
            <x-slot name="value">
                guardar
            </x-slot>
            <x-slot name="class">
                boton-form verde
            </x-slot>
        </x-input-btn>
    </form>


@endsection
