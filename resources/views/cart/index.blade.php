@extends('layout.plantilla')

@section('titulo', 'venta')

@section('content')

    <h1>nueva venta</h1>
    <img class="imagen" src="{{ asset('img/dolares.jpeg') }}" alt="">
    <form id="form-venta" class="form" action="{{ route('cart.store') }}" method="post">
        @csrf
        <label for="product">Producto</label>
        <select name="product">
            <option value="" disabled selected>seleccione un producto</option>
            @foreach ($products as $product)
                <option class="option" value="{{old('product', $product->id )}}">
                    {{ $product->brand . ' ' . $product->race . ' ' . $product->flavor . ' ' . $product->weight . ' kg' }}
                </option>
            @endforeach
        </select>

        <span>
            @error('product')
                {{ $message }}
            @enderror
        </span>
        <div class="contenedor-foto-precio">
            <img name="img" class="imagen-compra" alt="">
            <div class="">
                <p>Precio X bolsa</p>
                <p id="precio"></p>
                
        <label for="amount">cantidad de plata</label>
        <input class="input-compra" type="number" step="0.001" min="0"name="amount" value="{{old('amount')}}" placeholder="kilos a vender">

        <span>
            @error('amount')
                {{ $message }}
            @enderror
        </span>
            </div>

        </div>


        <x-input-btn>
            <x-slot name="class">
                boton-form azul
            </x-slot>
            <x-slot name="value">
                Agregar mas productos
            </x-slot>
        </x-input-btn>
    </form>
    @isset($cart)
    @endisset
    @if (count($cart) > 0)
        <table class="table">
            <thead>
                <th>kilos/bolsas</th>
                <th>Producto</th>
                <th>Precio</th>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                    <tr>
                        <td>
                            @if ($item->quantity === $item->product->weight)
                                1 <span class="texto-verde">bolsa</span>
                            @else
                                {{ $item->quantity }} <span class="texto-verde"> kg</span>
                            @endif
                        </td>
                        <td><div class="contenedor-detalle">
                            <img class="mini-imagen" src="{{asset('upload/'. $item->product->image)}}" alt="">{{ $item->product->brand->desc . ' ' . $item->product->flavor->desc . ' ' . $item->product->race->desc }}
                        </div>
                        </td>
                        <td><span class="texto-verde">$</span> {{ number_format($item->price) }}</td>
            
                        <td>
                            <form action="{{ route('cart.destroy', $item) }}" method="post">
                                @csrf
                                @method('delete')
                                <x-input-btn>
                                    <x-slot name="class">
                                        boton-form rojo
                                    </x-slot>
                                    <x-slot name="value">
                                        Borrar
                                    </x-slot>
                                </x-input-btn>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h1>Total: <span class="texto-verde">$</span> {{ number_format($cart->sum('price')) }}</h1>
        <form class="form" action="{{ route('sales.store') }}" method="POST">
            @csrf
            <label for="payment">Seleccione medio de pago</label>
            <select name="payment">
                @foreach ($payments as $payment)
                    <option value="{{ $payment->id }}">{{ $payment->desc }}</option>
                @endforeach
            </select>

            <span>
                @error('payment')
                    {{ $message }}
                @enderror
            </span>

            <input type="hidden" name="cart" value="{{ json_encode($cart) }}">
            <x-input-btn>
                <x-slot name="class">
                    boton-form verde
                </x-slot>
                <x-slot name="value">
                    Cobrar
                </x-slot>
            </x-input-btn>
        </form>
    @endif
@endsection
