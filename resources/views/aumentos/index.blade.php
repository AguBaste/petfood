@extends('layout.plantilla')

@section('titulo', 'aumentos')

@section('content')
<h1 class="titulo">aumentos</h1>
<img src="{{asset('img/aumento.jpeg')}}" alt="" class="imagen">
<table class="table">

    <tbody>
        @foreach ($brands as $brand)
            <tr>
                <td>{{ $brand->desc}}</td>
                <td>
                    <x-boton>
                        <x-slot name="href">
                            {{ route('aumentos.show', $brand->id) }}
                        </x-slot>
                        <x-slot name="texto">
                            aumentar precios
                        </x-slot>
                        <x-slot name="class">
                            boton azul
                        </x-slot>
                    </x-boton>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{$brands->links()}}
@endsection