@extends('layout.plantilla')

@section('titulo', 'crear')

@section('content')
    @isset($products)
    @endisset
    @if (count($products) > 0)
        <h1 class="titulo"> {{ $brand->desc }}</h1>

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
                            <img src="{{ asset('upload/' . $product->image) }}" class="mini-imagen"
                                alt="">{{ $product->race . ' ' . $product->flavor }}
                        </td>
                        <td>{{ $product->weight }}<span class="texto-verde"> kg</span></td>
                        <td><span class="texto-verde">$</span>
                            {{ number_format(round($product->price * $config->close, -1)) }}</td>
                        <td><span class="texto-verde">$</span>
                            {{ number_format(round(($product->price / $product->weight) * $config->open + $config->expenses, -1)) }}
                        </td>

                        @php
                            $b = false;
                        @endphp
                        @foreach ($stock as $item)
                            @if ($item->product_id == $product->id)
                                <td>
                                    {{ floor($item->quantity / $item->product->weight) }} bolsa
                                    {{ ($item->quantity / $item->product->weight - floor($item->quantity / $item->product->weight)) * $item->product->weight }}
                                    kg
                                </td>
                                @php
                                    $b = true;
                                @endphp
                            @break
                        @endif
                    @endforeach
                    @if (!$b)
                        <td>sin stock</td>
                    @endif

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
    {{ $products->links() }}
@else
    <h1>no hay productos de la marca {{ $brand->desc }}</h1>
@endif
@endsection
