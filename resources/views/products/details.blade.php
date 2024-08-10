@extends('layout.plantilla')

@section('titulo', 'detalle de producto')

@section('content')
    <h1 class="titulo">Detalles del producto</h1>
    <div class="contenedor-alimento">
        <div class="contenedor-alimento-imagen">
            <img class="imagen-detalle" src="{{ asset('upload/' . $product->image) }}" alt="imagen de producto">
        </div>
        <div class="contenedor-alimento-info">
            <p>{{ $product->brand->desc }}</p>
            <p>{{ $product->race->desc }}</p>
            <p>{{ $product->flavor->desc }}</p>
            <p>{{ $product->weight }}<span class="texto-verde"> kg</span></p>
            <p><span class="texto-verde">$</span> {{ round($product->price * $config->close, -1) }} x Bolsa</p>
            <p><span class="texto-verde">$</span>
                {{ round(($product->price / $product->weight) * $config->open + $config->expenses, -1) }} Suelto</p>
        </div>
    </div>
    <div class="btn-container">
        <x-boton>
            <x-slot name="class">
                boton verde
            </x-slot>
            <x-slot name="texto">
                editar
            </x-slot>
            <x-slot name="href">
                {{ route('products.edit', $product) }}
            </x-slot>
        </x-boton>
        <form action="{{ route('products.destroy', $product) }}" method="post">
            @csrf
            @method('delete')
            <input type="submit" class=" boton rojo" id="borrar" value="borrar">
        </form>

    </div>

@endsection
