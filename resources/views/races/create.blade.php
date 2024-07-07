@extends('layout.plantilla')

@section('titulo', 'crear')

@section('content')

<h1 class="titulo">Registrar una raza</h1>
    <form class="form" action="{{ route('races.store') }}" method="POST">
        @csrf
        <label for="desc">Descripcion de la raza </label>
            <input type="text" name="desc" placeholder="ingrese la descripcion de la nueva raza">
 
        <span>
            @error('desc'){{$message}}
            @enderror
        </span>
        
        <x-input-btn>
            <x-slot name="class">
                boton-form verde
            </x-slot>
            <x-slot name="value">
                guardar
            </x-slot>
        </x-input-btn>
    </form>
    @endsection
