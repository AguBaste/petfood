@extends('layout.plantilla')

@section('titulo', 'Stock')

@section('content')
    <h1 class="titulo">stock</h1>
    <img class="imagen" src="{{ asset('img/stock.jpeg') }}" alt="">
    @if ($stocks->isEmpty())
        <h1>no tienes productos en stock</h1>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>descripción</th>
                    <th>bolsas</th>
                    <th>kilos</th>
                    <th>editar</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($stocks as $stock)
                    <tr>
                        <td class="det-img"><img src="{{ asset('upload/' . $stock->image) }}" class="mini-imagen" alt="">{{ $stock->product->brand->desc . ' ' . $stock->product->race->desc . ' ' . $stock->product->flavor->desc . ' ' . $stock->product->weight . ' kg' }}
                        </td>
                        <td>
                            {{ floor($stock->quantity / $stock->product->weight) }}</td>
                        <td>
                            {{ ($stock->quantity / $stock->product->weight - floor($stock->quantity / $stock->product->weight)) * $stock->product->weight }} kg
                        </td>
                        <td><a href="{{route('stock.edit',$stock)}}" class="boton verde">editar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $stocks->links() }}
    @endif
@endsection
