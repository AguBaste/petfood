@extends('layout.plantilla')

@section('titulo', 'marcas')

@section('content')
    <h1 class="titulo">marcas</h1>
    <img class="imagen" src="{{ asset('img/marca.jpeg') }}" alt="">
    <x-boton>
        <x-slot name="href">
            {{ route('brands.create') }}
        </x-slot>
        <x-slot name="texto">
            registrar una nueva marca
        </x-slot>
        <x-slot name="class">
            boton verde
        </x-slot>
    </x-boton>
   
    <table class="table">

        <tbody>
            @foreach ($brands as $brand)
                <tr>
                    <td>{{ $brand->desc }}</td>
                    <td>
                        <x-boton>
                            <x-slot name="href">
                                {{ route('products.show', $brand->id) }}
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
                                {{ route('brands.edit', $brand->id) }}
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
    {{ $brands->links() }}
@endsection
