@extends('layout.plantilla')

@section('titulo', 'editar carrito')

@section('content')
    <form class="form" action="{{ route('cart.update', $cart) }}" method="post">
        @csrf
        @method('patch')
            <label for="quantity">kilos</label>
            <input type="text" step="0.001" name="quantity" value="{{ $cart->quantity }}">

            <span>
                @error('quantity')
                    {{ $message }}
                @enderror
            </span>
             <label for="product">Producto </label>
        <select name="product">
            @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ $product->id == $cart->product_id ? 'selected' : '' }}>
                    {{ $product->brand . ' ' . $product->flavor . ' ' . $product->race }}
                </option>
            @endforeach

            <span>
                @error('product')
                    {{ $message }}
                @enderror
            </span>
            <label for="price">
                <input type="hidden" value="{{ $cart->price }}" name="price">
            </label>
            <x-input-btn>
                <x-slot name="class">
                    boton-form verde
                </x-slot>
                <x-slot name="value">
                    guardar
                </x-slot>
            </x-input-btn>
    </form>
@endsection
