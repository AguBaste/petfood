@extends('layout.plantilla')

@section('titulo', 'crear')

@section('content')
    @isset($products)
    @endisset
    @if (count($products) > 0)
        <h1 class="titulo">productos de sabor {{ $flavor->desc }}</h1>

        <table class="table">
            <thead>
                <tr>
                    <td>descripción</td>
                    <td>kilos </td>
                    <td>x bolsa</td>
                    <td>x kilo</td>
                    <td>stock</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    {{-- <a class="boton" href="{{ route('products.show', $product) }}">Ver Producto</a> --}}
                    <tr class="row">
                        <td class="det-img">
                            <img src="{{ asset('upload/' . $product->image) }}" class="mini-imagen" alt="">
                            {{ $product->brand->desc . ' ' . $product->race->desc }}
                        </td>
                        <td>{{ $product->weight . ' kg' }} <span class="verde"></span> </td>
                        <td>$ {{ $product->price * $config->close }}</td>
                        <td>$ {{ round(($product->price / $product->weight) * $config->open + $config->expenses) }}</td>
                       
                    <td><x-boton>
                            <x-slot name="class">
                                boton azul
                            </x-slot>
                            <x-slot name="texto">
                                ver +
                            </x-slot>
                            <x-slot name="href">
                                {{ route('products.details', $product) }}
                            </x-slot>
                        </x-boton></td>
            @endforeach
            </tr>


        </tbody>
    </table>
    {{ $products->links() }}
@else
    <h1>no hay productos del sabor {{ $flavor->desc }}</h1>
@endif
@endsection
