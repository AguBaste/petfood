@extends('layout.plantilla')

@section('titulo', 'aumentos')

@section('content')
<form action="{{route('aumentos.update',$brandId)}}" class="form" method="post">
    @csrf
    @method('patch')

    <label for="valor">porcentaje para el aumento  </label>
        <input type="number" min="0" step="0.01" name="valor"  placeholder="Ingrese el porcentaje que desea para el aumento">
  
    <span>
        @error('valor'){{$message}}
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