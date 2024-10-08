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
                        <form action="{{ route('expenses.destroy', $expense) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit"
                                onclick="event.preventDefault();
                             if(confirm('Realmente desea borrar el gasto\n'
                             + '{{$expense->desc}} por ' +' {{number_format($expense->price)}}' ))
                             {
                                    this.form.submit();
                                };"
                                class=" boton rojo" value="borrar">
                        </form>
                    </td>
                </tr>

                </div>
            @endforeach
        </tbody>
    </table>

@endsection
