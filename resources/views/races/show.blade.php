@extends('layout.plantilla')

@section('titulo', 'crear')

@section('content')
@isset($products)
@endisset
@if (count($products) > 0)
    <h1>productos para {{$products[0]->race->desc}}</h1>

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
                <td>{{$product->brand->desc .' '. $product->race->desc .' '. $product->flavor->desc  }} </td>
                <td>{{$product->weight . ' kg'}}</td>
                <td>$ {{$product->price * $config->close}}</td>
                <td>$ {{round($product->price/$product->weight * $config->open + $config->expenses)}}</td>
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
       {{$products->links()}}
@else
<h1>no hay productos de la raza seleccionada</h1>
@endif
@endsection
