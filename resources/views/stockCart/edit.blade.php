@extends('layout.plantilla')

@section('titulo', 'compra')

@section('content')
<h1>editando producto</h1>
<form class="form" action="{{ route('stockCart.update',$stockCart) }}" method="post">
    @csrf
    @method('patch')

        <select hidden name="product">
            @foreach ($products as $product)
                <option  value="{{ $product->id }}" {{$product->id == $stockCart->product_id ? 'selected' :''}} >
                    {{ $product->brand . ' ' . $product->flavor . ' ' . $product->race.' '.$product->weight .' kilos' }}</option>
            @endforeach
        </select>

    <label for="quantity">Cantidad </label>
        <input type="number" step="{{$product->weight}}" min="0"name="quantity" value="{{$stockCart->quantity}}">

    <span>
        @error('quantity')
        {{ $message }}
    @enderror
    </span>
  
    <label for="price">Precio </label>
        <input type="number" step="0.01" min="0"name="price" value="{{$stockCart->price/$stockCart->quantity}}">
  
    <span>
        @error('price')
        {{ $message }}
    @enderror
    </span>
 

        <select hidden name="provider">
            @foreach ($providers as $provider)
                <option class="option" value="{{ $provider->id ? 'selected' : '' }}">
                    {{ $provider->name}}</option>
            @endforeach
        </select>

     
    </label>
    <x-input-btn>
        <x-slot name="class">
            boton verde
        </x-slot>
        <x-slot name="value">
            actualizar
        </x-slot>
    </x-input-btn>
</form>
@endsection