@extends('layout.plantilla')

@section('titulo', 'venta')

@section('content')

    <h1>nueva venta</h1>
    <img class="imagen" src="{{ asset('img/dolares.jpeg') }}" alt="">
    <form class="form fondo" action="{{ route('cart.store') }}" method="post">
        @csrf
        <label for="product">Producto</label>
        <select name="product">
            <option value="" disabled selected>seleccione un producto</option>
            @foreach ($products as $product)
                <option class="option" value="{{ $product->id }}">
                    {{ $product->brand . ' ' . $product->flavor . ' ' . $product->race . ' ' . $product->weight . ' kg' }}
                </option>
            @endforeach
        </select>
        <span>
            @error('product')
                {{ $message }}
            @enderror
        </span>
        <label for="quantity">kilos </label>
        <input type="number" step="0.001" min="0"name="quantity" placeholder="ingrese la cantidad de kilos">

        <span>
            @error('quantity')
                {{ $message }}
            @enderror
        </span>

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
                <th>Pecio</th>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                    <tr>
                        <td>
                            @if ($item->quantity < 1)
                                {{ $item->quantity }}
                            @else
                                {{ $item->quantity % $item->product->weight == 0 ? $item->quantity / $item->product->weight . ' bolsa/s' : $item->quantity . ' kg' }}
                            @endif
                        </td>
                        <td>{{ $item->product->brand->desc . ' ' . $item->product->flavor->desc . ' ' . $item->product->race->desc }}
                        </td>
                        <td><span class="texto-verde">$</span> {{ number_format($item->price) }}</td>
                        <td>
                            <x-boton>
                                <x-slot name="class">
                                    boton verde
                                </x-slot>
                                <x-slot name="texto">
                                    Editar
                                </x-slot>
                                <x-slot name="href">
                                    {{ route('cart.edit', $item) }}
                                </x-slot>
                            </x-boton>
                        </td>
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
