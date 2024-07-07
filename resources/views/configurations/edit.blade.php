@extends('layout.plantilla')

@section('titulo', 'Configuraciones')

@section('content')
<h1 >Editar Configuraciones</h1>
    <form class="form" action="{{ route('configurations.update', $config) }}" method="post">
        @csrf
        @method('patch')
        <label for="close">% Bolsa </label>
            <input type="number" step="0.01" min="0" name="close" value="{{$config->close}}">
       
        <span>  
            @error('close')
            {{ $message }}
        @enderror
        </span>
        <label for="open">% Kilo</label>
            <input type="number" step="0.01" min="0" name="open" value="{{$config->open}}">
        
        <span>  
            @error('open')
            {{ $message }}
        @enderror
        </span>
        <label for="expenses">Gastos</label>
            <input type="number" step="0.01" min="0" name="expenses" value="{{$config->expenses}}">
        
        <span>  
            @error('expenses')
            {{ $message }}
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
