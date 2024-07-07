@extends('layout.plantilla')

@section('titulo', 'crear marca')

@section('content') 
<h1 class="titulo">Registrar una marca</h1>
    <form class="form" action="{{ route('brands.store') }}" method="POST">
        @csrf
        <label for="desc">Nombre de la marca</label>
            <input type="text" name="desc" placeholder="ingrese el nombre de la marca ">
        
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
