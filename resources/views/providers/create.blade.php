@extends('layout.plantilla')

@section('titulo', 'crear')

@section('content')
<h1 class="titulo">Registrar un proveedor</h1>
    <form class="form" action="{{ route('providers.store') }}" method="post">
        @csrf
        <label for="name">Nombre </label>
            <input type="text" name="name" placeholder="ingrese el nombre y apellido del nuevo proveedor">
    
        <span>
            @error('name'){{$message}}
            @enderror
        </span>
       
        <label for="phone">Telefono </label>
            <input type="text" name="phone" placeholder="ingrese el telefono del nuevo proveedor ">
  
        <span>  
            @error('phone'){{$message}}
            @enderror
        </span>
       
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
