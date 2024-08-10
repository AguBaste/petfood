@extends('layout.plantilla')

@section('titulo', 'gastos')

@section('content')
    <h1 class="titulo">registrando un nuevo gasto</h1>
    <form class="form" action="{{ route('expenses.store') }}" method="POST">
        @csrf
        <label for="desc">Descripción del gasto</label>
        <input type="text" name="desc" placeholder="ingrese la descripción del gasto">

        <span>
            @error('desc')
                {{ $message }}
            @enderror
        </span>

        <label for="price">importe del gasto</label>
        <input type="text" name="price" placeholder="ingrese el importe del gasto">

        <span>
            @error('desc')
                {{ $message }}
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
