@extends('layout.plantilla')

@section('titulo', 'Stock')

@section('content')
    <h1 class="titulo">stock</h1>
    <img class="imagen" src="{{asset('img/stock.jpeg')}}" alt="">
    @if ($stocks->isEmpty())
        <h1>no tienes productos en stock</h1>
    @else
        <table class="table">
            <thead>
                <tr>
                    <td></td>
                    <th>descripcion</th>
                    <th>quedan</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($stocks as $stock)
                    <tr>
                        <td><img src="{{asset('upload/'.$stock->image)}}" class="mini-imagen" alt=""></td>
                        <td>{{ $stock->product->brand->desc . ' ' . $stock->product->race->desc . ' ' . $stock->product->flavor->desc . ' ' . $stock->product->weight . ' kg' }}   </td>
                        {{-- hacer un if y modificar los span sacarlos del table y poner
                        .span-verde o span-rojo --}}
                        <td><span
                                class="{{ $stock->quantity <= $stock->product->weight / 2 ? 'texto-rojo' : 'texto-verde' }}">{{ $stock->quantity }}
                                </span>kilos</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $stocks->links() }}
    @endif
@endsection
