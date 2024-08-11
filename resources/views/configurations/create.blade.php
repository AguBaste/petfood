@extends('layout.plantilla')

@section('titulo', 'Configuraciones')

@section('content')
<h1>creando los porcentajes de ganancias</h1>
<form class="form" action="{{route('configurations.store')}}" method="post">
    @csrf
    <label for="close">% x bolsa cerrada </label>
        <input name="close" type="number" step="0.001" min="0" placeholder="ingrese el valor de la ganancia por bolsa">
   
    <span>
        @error('close')
        {{$message}}
        @enderror
    </span>
    <label for="open">% x kilo</label>
        <input name="open" type="number" step="0.001" min="0" placeholder="ingrese el valor de la ganancia por kilo">
    
    <span>
        @error('open')
        {{$message}}
        @enderror
    </span>
    <label for="expenses">% gastos</label>
        <input name="expenses" type="number" step="0.001" min="0" placeholder="ingrese el valor de los gastos">
    
    <span>
        @error('expenses')
        {{$message}}
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