@extends('layout.plantilla')

@section('titulo', 'sabores')

@section('content')
    <h1 class="titulo">sabores</h1><img class="imagen" src="{{ asset('img/sabor.jpeg') }}" alt="">
    <x-boton>
        <x-slot name="href">
            {{ route('flavors.create') }}
        </x-slot>
        <x-slot name="texto">
            registrar un nuevo sabor
        </x-slot>
        <x-slot name="class">
            boton azul
        </x-slot>
    </x-boton>

    <table class="table">

        <tbody>
            @foreach ($flavors as $flavor)
                <tr>
                    <td>{{ $flavor->desc }}</td>
                    <td>
                        <x-boton>
                            <x-slot name="href">
                                {{ route('flavors.show', $flavor->id) }}
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
                                {{ route('flavors.edit', $flavor->id) }}
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
    {{ $flavors->links() }}
@endsection
