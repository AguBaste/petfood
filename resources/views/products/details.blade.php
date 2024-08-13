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
            <p>{{ $product->weight }} kg</p>
            <p>${{ number_format(round($product->price * $config->close, -1)) }} x bolsa
            </p>
            <p>$
                {{ number_format(round(($product->price / $product->weight) * $config->open + $config->expenses, -1)) }} x kilo
                </p>
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
            <input type="submit" class=" boton rojo"  value="borrar" onclick="event.preventDefault();
            if(confirm('Realmente desea borrar este producto'))
            {this.form.submit();}">
        </form>

    </div>
@endsection
