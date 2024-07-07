@extends('layout.plantilla')

@section('titulo', 'marcas')

@section('content')
<h1>editando  raza</h1>
<form action="{{route('races.update',$race)}}" class="form" method="POST">
    @csrf
    @method('patch')
    <label for="desc">Nombre </label>
        <input type="text" name="desc" value="{{$race->desc}}">

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