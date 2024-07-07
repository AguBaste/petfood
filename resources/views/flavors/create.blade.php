@extends('layout.plantilla')

@section('titulo', 'crear sabor')

@section('content')
<h1 class="titulo">registrar sabor</h1>
    <form class="form" action="{{ route('flavors.store') }}" method="POST">
        @csrf
        <label for="desc">Descripcion del sabor</label>
            <input type="text" name="desc" placeholder="ingrese la descripcion del sabor">
        
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
