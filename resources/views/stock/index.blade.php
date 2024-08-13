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
                    <th>descripcion</th>
                    <th>bolsas</th>
                    <th>kilos</th>
                    <td>editar</td>
                </tr>
            </thead>
            <tbody>

                @foreach ($stocks as $stock)
                    <tr>
                        <td class="det-img"><img src="{{ asset('upload/' . $stock->image) }}" class="mini-imagen" alt="">{{ $stock->brand_desc . ' ' . $stock->race_desc . ' ' . $stock->flavor_desc . ' ' . $stock->weight . ' kg' }}
                        </td>
                        <td>
                            {{ floor($stock->quantity / $stock->weight) }}</td>
                        <td>
                            {{ ($stock->quantity / $stock->weight - floor($stock->quantity / $stock->weight)) * $stock->weight }} kg
                        </td>
                        <td><a href="{{route('stock.edit',$stock->stock_id)}}" class="boton verde">editar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$stocks->links()}}
    @endif
@endsection
