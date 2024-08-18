@extends('layout.plantilla')

@section('titulo', 'Configuraciones')

@section('content')
<h1 class="titulo">Configuraciones</h1>
<img src="{{asset('img/config.jpeg')}}" alt="" class="imagen">
@if($config == null)
<x-boton>
    <x-slot name="href">
        {{ route('configurations.create', $config) }}
    </x-slot>
    <x-slot name="texto">
        crear
    </x-slot>
    <x-slot name="class">
        boton azul
    </x-slot>
</x-boton>
@else
<table class="table">
    <thead>
        <tr>
            <th>Valor del aumento por bolsa cerrada</th>
            <th>Valor del aumento por kilo</th>
            <th>Valor del aumento por gastos</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ round(($config->close -1) * 100) }} <span class="texto-verde">%</span></td>
            <td>{{ round(($config->open -1) * 100) }} <span class="texto-verde">%</span></td>
            <td><span class="texto-verde">$</span> {{ $config->expenses }}</td>
        </tr>

    </tbody>
</table>
  
    <x-boton>
        <x-slot name="href">
            {{ route('configurations.edit', $config) }}
        </x-slot>
        <x-slot name="texto">
            editar
        </x-slot>
        <x-slot name="class">
            boton azul
        </x-slot>
    </x-boton>
@endif
@endsection
