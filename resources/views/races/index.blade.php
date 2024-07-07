@extends('layout.plantilla')

@section('titulo', 'crear')

@section('content')
    <h1>razas</h1>
    <img src="{{ asset('img/raza.jpeg') }}" alt="" class="imagen">
    <x-boton>
        <x-slot name="href">
            {{ route('races.create') }}
        </x-slot>
        <x-slot name="texto">
            registrar una nueva raza
        </x-slot>
        <x-slot name="class">
            boton azul
        </x-slot>
    </x-boton>

    <table class="table">

        <tbody>
            @foreach ($races as $race)
                <tr>
                    <td>{{ $race->desc }}</td>
                    <td>
                        <x-boton>
                            <x-slot name="href">
                                {{ route('races.show', $race->id) }}
                            </x-slot>
                            <x-slot name="texto">
                                ver +
                            </x-slot>
                            <x-slot name="class">
                                boton azul
                            </x-slot>
                        </x-boton>
                      <td>
                        <x-boton>
                            <x-slot name="href">
                                {{ route('races.edit', $race->id) }}
                            </x-slot>
                            <x-slot name="texto">
                                editar
                            </x-slot>
                            <x-slot name="class">
                                boton verde
                            </x-slot>
                        </x-boton>
                      </td>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $races->links() }}
@endsection
