@extends('layout.plantilla')

@section('titulo', 'compras')

@section('content')

    @if (!request()->has('date') || $purchases->isEmpty())
        <h1>comras</h1>

        <form action="{{ route('purchases.index') }}" method="get" class="form form-chico">
            @csrf

                <label for="date"> seleccione un mes</label>
                    <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}">
                
                <x-input-btn>
                    <x-slot name="class">
                        boton-form azul
                    </x-slot>
                    <x-slot name="value">
                        buscar
                    </x-slot>
                </x-input-btn>

            <span class="texto-rojo">
                @error('date')
                    {{ $message }}
                @enderror
            </span>
        </form>
        @if ($purchases->isEmpty())
            <h1>no hay compras</h1>
            <img class="imagen" src="{{ asset('img/noCompras.jpeg') }}" alt="">
        @endif
    @else
        <form action="{{ route('purchases.index') }}" method="get" class="form form-chico">
            @csrf
            <label for="date"> seleccione un mes </label>
            <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}">

            <span class="texto-rojo">
                @error('date')
                    {{ $message }}
                @enderror
            </span>
            <x-input-btn>
                <x-slot name="class">
                    boton-form azul
                </x-slot>
                <x-slot name="value">
                    buscar
                </x-slot>
            </x-input-btn>
        </form>
        <h1>compras del mes {{ $purchases[0]->created_at->format('m-Y') }}</h1>
        <h1>total <span class="texto-verde">$</span> {{ number_format($total) }}</h1>
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
                @foreach ($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->created_at->format('d-m-Y') }}</td>
                        <td>{{ $purchase->created_at->format('H:i') }}</td>
                        <td>
                            <p>{{ $purchase->provider->name }}</p>
                        </td>
                        <td><span class="texto-verde">$</span> {{ number_format($purchase->total) }}</td>
                        <td> <x-boton>
                                <x-slot name="class">
                                    boton verde
                                </x-slot>
                                <x-slot name="texto">
                                    ver
                                </x-slot>
                                <x-slot name="href">
                                    {{ route('purchases.show', $purchase) }}
                                </x-slot>
                            </x-boton>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $purchases->links() }}
    @endif


@endsection
