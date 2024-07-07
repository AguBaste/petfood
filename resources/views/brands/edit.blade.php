@extends('layout.plantilla')

@section('titulo', 'marcas')

@section('content')
<h1>editando marca</h1>
<form action="{{route('brands.update',$brand)}}" class="form" method="POST">
    @csrf
    @method('patch')
    <label for="desc">Nombre </label>
        <input type="text" name="desc" value="{{$brand->desc}}">
   
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