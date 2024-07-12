@extends('layout.plantilla')

@section('titulo', 'compra')

@section('content')
    <h1>Nueva compra</h1>
    <img src="{{ asset('img/compra.jpeg') }}" alt="" class="imagen">
    <form class="form" id="form-compras" action="{{ route('stockCart.store') }}" method="post">
        @csrf
        <label for="product">Producto </label>
        <select name="product">
            <option value="" disabled selected>seleccione un producto</option>
            @foreach ($products as $product)
                <option class="option" value="{{ $product->id }}">
                    {{ $product->brand . ' ' . $product->race . ' ' . $product->flavor . ' ' . $product->weight . ' kilos' }}
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
            <div class="contenedor-compra-detalle">
                <label for="price">Precio </label>
                <input class="input-compra" type="number" step="0.01" min="0"name="price">
                <span>
                    @error('price')
                        {{ $message }}
                    @enderror
                </span>

                <label for="quantity">Cantidad </label>
                <input class="input-compra" type="number" step="1" min="1" value="1" name="quantity">

                <span>
                    @error('quantity')
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
    @isset($stockCart)
    @endisset
    @if (count($stockCart) > 0)
        <table class="table">
            <thead>
                <th>Cantidad</th>
                <th>Producto</th>
                <th>precio</th>
                <th>opciones</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($stockCart as $item)
                    <tr>
                        <td>{{ $item->quantity / $item->product->weight . ' bolsa/s' }}</td>
                        <td>
                            <div class="contenedor-detalle">
                                <img src="{{asset('upload/'. $item->product->image)}}" class="mini-imagen" alt="">
                                {{ $item->product->brand->desc . ' ' . $item->product->race->desc . ' ' . $item->product->flavor->desc . ' ' . $item->product->weight . ' kg' }}
                            </div>
                        </td>
                        <td><span class="texto-verde">$</span> {{ number_format($item->price) }}</td>
          
                        <td>
                            <form action="{{ route('stockCart.destroy', $item) }}" method="post">
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
        <h1 class="total-compras">Total: $ {{ number_format($total) }}</h1>
        <form class="form" action="{{ route('purchases.store') }}" method="POST">
            @csrf
            <label for="provider">Seleccion un proveedor </label>
            <select name="provider">
                @foreach ($providers as $provider)
                    <option class="option" value="{{ $provider->id }}">
                        {{ $provider->name }}</option>
                @endforeach
            </select>

            <span>
                @error('provider')
                    {{ $message }}
                @enderror
            </span>
            <input type="hidden" name="stockCart" value="{{ json_encode($stockCart) }}">
            <x-input-btn>
                <x-slot name="class">
                    boton-form verde
                </x-slot>
                <x-slot name="value">
                    guardar esta compra
                </x-slot>
            </x-input-btn>
        </form>
    @endif


@endsection
