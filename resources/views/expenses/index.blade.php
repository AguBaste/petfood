@extends('layout.plantilla')

@section('titulo', 'gastos')

@section('content')
    <h1 class="titulo">gastos</h1>
    <img class="imagen" src="{{ asset('img/exito.jpeg') }}" alt="">
    <x-boton>
        <x-slot name="href">
            {{ route('expenses.create') }}
        </x-slot>
        <x-slot name="texto">
            registrar nuevo gasto
        </x-slot>
        <x-slot name="class">
            boton verde
        </x-slot>
    </x-boton>

    <table class="table">
        <thead>
            <tr>
                <th>descripción</th>
                <th>monto</th>
                <th>fecha del gasto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ $expense->desc }}</td>
                    <td><span class="texto-verde">$ </span>{{ number_format($expense->price) }}</td>
                    <td>{{ $expense->created_at->format('d-m-Y') }}</td>

                    <td>
                        <form action="{{ route('expenses.destroy', $expense->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <x-input-btn>
                                <x-slot name="class">
                                    boton-form rojo
                                </x-slot>
                                <x-slot name="value">
                                    borrar
                                </x-slot>
                            </x-input-btn>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
