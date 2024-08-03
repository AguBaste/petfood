@extends('layout.plantilla')

@section('titulo', 'ventas')

@section('content')
<h1>Detalle de venta</h1>
    <table class="table">
        <thead>
            <tr>
                <th>fecha</th>
                <th>hora</th>
                <th>medio de pago</th>
                <th>total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $sale->created_at->format('d-m-y') }}</td>
                <td>{{ $sale->created_at->format('H:i') }}</td>
                <td>{{ $sale->payment->desc }}</>
                </td>
                <td><span class="texto-verde">$</span>{{ number_format($sale->total) }}</td>
            </tr>
        </tbody>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th>cantidad</th>
                <th>descripcion</th>
                <th>precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailSale as $sale)
            @if ($sale->product ==null)
            <tr>
                <td>no hay detalles, el producto fue borrado</td>

            </tr>
            @else
                <tr>
                    <td>
                        @if ($sale->quantity < 1)
                            {{ $sale->quantity . ' kg' }}
                        @else
                            {{ $sale->quantity % $sale->product->weight == 0 ? $sale->quantity / $sale->product->weight . ' bolsa/s' : $sale->quantity . ' kg' }}
                        @endif
                    </td>
                    <td>{{ $sale->product->brand->desc . ' ' . $sale->product->race->desc . ' ' . $sale->product->flavor->desc }}
                    </td>


                    <td><span class="texto-verde">$ </span>{{ number_format($sale->price) }}</td>
                    
                </tr>
            @endif
                
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('sales.destroy', $sale) }}" method="post">
        @csrf
        @method('delete')
        <x-input-btn>
            <x-slot name="value">
                borar
            </x-slot>
            <x-slot name="class">
                boton-form rojo
            </x-slot>
        </x-input-btn>
    </form>
@endsection
