@extends('layout.plantilla')

@section('titulo', 'ventas')

@section('content')
<h1>detalle de compra</h1>
<table class="table">
    <thead>
        <tr>
            <th>fecha</th>
            <th>hora</th>
            <th>proveedor</th>
            <th>total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$purchase->created_at->format('d-m-y')}}</td>
            <td>{{$purchase->created_at->format('H:i')}}</td>
            <td>{{$purchase->provider->name}}</td>
            <td><span class="texto-verde">$ </span>{{number_format($purchase->total)}}</td>
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
            @foreach ($detailPurchase as $purchase)
             @if ($purchase->product ==null)
            <tr>
                <td>no hay detalles, el producto fue borrado</td>

            </tr>
            @else
                <tr>
                    <td>{{ $purchase->quantity/$purchase->product->weight .' bolsa/s'}}</td>
                    <td>{{ $purchase->product->brand->desc.' '. $purchase->product->race->desc .' '. $purchase->product->flavor->desc .' '. $purchase->product->weight .' kg'}}</td>
                    <td><span class="texto-verde">$ </span>{{number_format($purchase->price) }}</td>

                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
     <form action="{{route('purchases.destroy',$purchase)}}" method="post">
         @csrf
         @method('delete')
        <x-input-btn> 
            <x-slot name="value">
                borrar
            </x-slot>
            <x-slot name="class">
                boton-form rojo
            </x-slot>
        </x-input-btn>
    </form>
@endsection
