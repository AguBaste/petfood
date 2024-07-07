@extends('layout.plantilla')

@section('titulo', 'ventas')

@section('content')

    @if (!request()->has('date') || $sales->isEmpty())
        <h1>Ventas</h1>
        @include('layout.form-sales')
        @if($sales->isEmpty())
        <h1>no hay ventas</h1>
        <img src="{{asset('img/noVentas.jpeg')}}" alt="" class="imagen">
        @endif
    @else
    @include('layout.form-sales')
    <h1>ventas de {{ $sales[0]->created_at->format('m-Y') }}</h1>
    <h1>total <span class="texto-verde">$</span> {{number_format($total)}}</h1>

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
            @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->created_at->format('d-m-Y') }}</td>
                    <td>{{ $sale->created_at->format('H:i') }}</td>
                    <td>
                        <p class="{{ $sale->payment_id == 1 ? 'texto-azul' : 'texto-verde' }}">
                            {{ $sale->payment->desc }}</p>
                    </td>
                    <td><span class="texto-verde">$</span> {{number_format( $sale->total) }}</td>
                    <td> <x-boton>
                            <x-slot name="class">
                                boton verde
                            </x-slot>
                            <x-slot name="texto">
                                ver
                            </x-slot>
                            <x-slot name="href">
                                {{ route('sales.show', $sale) }}
                            </x-slot>
                        </x-boton>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $sales->links() }}
    @endif


@endsection
