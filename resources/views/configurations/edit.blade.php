@extends('layout.plantilla')

@section('titulo', 'Configuraciones')

@section('content')
    <h1>Editar Configuraciones</h1>
    <form class="form" action="{{ route('configurations.update', $config) }}" method="post">
        @csrf
        @method('patch')
        <label for="close">% Bolsa </label>
        <input type="number" step="0.01" min="0" name="close" value="{{ ($config->close - 1) * 100 }}">

        <span>
            @error('close')
                {{ $message }}
            @enderror
        </span>
        <label for="open">% Kilo</label>
        <input type="number" step="0.01" min="0" name="open" value="{{ ($config->open - 1) * 100 }}">

        <span>
            @error('open')
                {{ $message }}
            @enderror
        </span>
        <label for="expenses">Gastos</label>
        <input type="number" step="0.01" min="0" name="expenses" value="{{ $config->expenses }}">

        <span>
            @error('expenses')
                {{ $message }}
            @enderror
        </span>
        <input type="submit" class="boton verde" value="Actualizar"
            onclick="event.preventDefault(); if(confirm('Realmente desea actualizar el valor de las configuraciones a las siguientes: \n' 
            + 'Bolsa cerrada anterior valor = {{ round(($config->close - 1) * 100) }}%' + ' nuevo valor = ' + document.querySelector('input[name=close]').value + '%\n' 
            + 'Por kilo anterior valor = {{ round(($config->open - 1) * 100) }}%' + ' nuevo valor = ' + document.querySelector('input[name=open]').value + '%\n' 
            + 'Gastos anterior valor = ${{ number_format($config->expenses) }}' + ' nuevo valor = $' + document.querySelector('input[name=expenses]').value)) 
            { this.form.submit(); }">

    </form>
@endsection
