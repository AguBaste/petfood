@extends('layout.plantilla')
@section('title', 'Dashboard')

@section('content')
    <h1>
        resumen del mes</h1>
    <img class="imagen" src="{{ asset('img/contador.jpeg') }}" alt="">
    <div class="contenedor-tarjetas">
        <div class="tarjeta tarjeta-verde">
            <h2>ventas del mes </h2>
            <h1><span class="span">$ </span>
                @if (!empty($sales && isset($sales[0]->total)))
                    {{ number_format($sales[0]->total) }}
                @else
                    0
                @endif
            </h1>
        </div>
        <div class="tarjeta tarjeta-azul">
            <h2>ventas del dia </h2>
            <h1><span class="span">$ </span>
                @if (!empty($salesDia && isset($salesDia[0]->total)))
                    {{ number_format($salesDia[0]->total) }}
                @else
                    0
                @endif
            </h1>
        </div>
        <div class="tarjeta tarjeta-amarilla">
            <h2>compras del mes</h2>
            <h1><span class="span">$ </span>
                @if (!empty($purchases && isset($purchases[0]->total)))
                    {{ number_format($purchases[0]->total) }}
                @else
                    0
                @endif
            </h1>
        </div>
        <div class="tarjeta tarjeta-roja">
            <h2>gastos del mes </h2>
            <h1><span class="span">$ </span>
                @if (!empty($expenses && isset($expenses[0]->total)))
                    {{ number_format($expenses[0]->total) }}
                @else
                    0
                @endif
            </h1>
        </div>
    </div>
    <h1>top 5 productos mas vendidos del mes</h1>
    <img src="{{ asset('img/podio.jpeg') }}" alt="" class="imagen">
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>descripcion</th>
                <th>cantidad vendida</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topSellingProducts as $product)
                <tr>
                  
                    <td><img src="{{asset('upload/'.$product->image)}}" class="mini-imagen" alt=""></td>
                    <td>{{ $product->product->brand->desc . ' ' . $product->product->race->desc . ' ' . $product->product->flavor->desc }}
                    </td>
                    <td><span class="texto-verde">{{ $product->total_sales }} </span>kilos</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection