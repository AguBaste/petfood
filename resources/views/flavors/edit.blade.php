@extends('layout.plantilla')

@section('titulo', 'sabores')

@section('content')
<h1>editando sabor</h1>
<form action="{{route('flavors.update',$flavor)}}" class="form" method="POST">
    @csrf
    @method('patch')
    <label for="desc">Nombre </label>
        <input type="text" name="desc" value="{{$flavor->desc}}">
   
    <x-input-btn>
        <x-slot name="value">
             actualizar
        </x-slot>
        <x-slot name="class">    
            boton-form verde
        </x-slot>
    </x-input-btn>
</form>
@endsection