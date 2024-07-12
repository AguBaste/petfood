@extends('layout.plantilla')

@section('titulo', 'crear')

@section('content')
@isset($products)
@endisset
@if (count($products) > 0)
    <h1 class="titulo"> {{$products[0]->brand}}</h1>

    <table class="table">
        <thead>
            <tr>
                <td>descripcion</td>
                <td>kilos </td>
                <td>precio x bolsa</td>  
                <td>precio x kilo</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            {{-- <a class="boton" href="{{ route('products.show', $product) }}">Ver Producto</a> --}}
            <tr class="row">
                <td>{{ $product->race .' '. $product->flavor }} </td>
                <td>{{$product->weight}}<span class="texto-verde"> kg</span></td>
                <td><span class="texto-verde">$</span> {{round($product->price * $config->close,-1)}}</td>
                <td><span class="texto-verde">$</span> {{round($product->price/$product->weight * $config->open + $config->expenses,-1)}}</td>
                <td><x-boton>
                    <x-slot name="class">
                        boton azul
                    </x-slot>
                    <x-slot name="texto">
                        ver foto
                    </x-slot>
                    <x-slot name="href">
                        {{ route('products.details', $product) }}
                    </x-slot>
                </x-boton></td>
            @endforeach
            </tr>
       

        </tbody>
    </table>
       {{$products->links()}}
@else
<h1>no hay productos de la marca seleccionada</h1>
@endif
@endsection
