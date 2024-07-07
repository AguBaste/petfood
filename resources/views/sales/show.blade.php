@extends('layout.plantilla')

@section('titulo', 'ventas')

@section('content')
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
                <td><span class="texto-verde">$</span>{{number_format( $sale->total) }}</td>
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
                    <td><span class="texto-verde">$ </span>{{number_format( $sale->price) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection