@extends('layout.plantilla')

@section('titulo', 'crear')

@section('content')
<h1 class="titulo">proveedores</h1>
<img class="imagen" src="{{asset('img/proveedor.jpeg')}}" alt="">
    <x-boton>
        <x-slot name="href">
            {{ route('providers.create') }}
        </x-slot>
        <x-slot name="texto">
            registrar un nuevo proveedor
        </x-slot>
        <x-slot name="class">
            boton azul
        </x-slot>
    </x-boton>

<table class="table">

    <tbody>
        @foreach ($providers as $provider)
      <tr>
        <td>{{ $provider->name }}</td>
        <td>{{ $provider->phone }}</td>
        <td>
            <x-boton>
                <x-slot name="href">
                    {{ route('providers.edit',$provider) }}
                </x-slot>
                <x-slot name="texto">
                   editar
                </x-slot>
                <x-slot name="class">
                    boton verde
                </x-slot>
            </x-boton>
        </td>
      </tr>
    @endforeach
    </tbody>
</table>
   

@endsection
