@extends('layout.plantilla')

@section('titulo', 'compra')

@section('content')
<h1>editando producto</h1>
<form class="form" action="{{ route('stockCart.update',$stockCart) }}" method="post">
    @csrf
    @method('patch')

        <input type="text" name="product" value="{{$stockCart->product_id}}" hidden>

    <label for="quantity">Cantidad </label>
        <input type="number" step="{{$product[0]->weight}}" min="0" name="quantity" value="{{old('quantity',$stockCart->quantity)}}">
    <span>
        @error('quantity')
        {{ $message }}
    @enderror
    </span>
  
    <label for="price">Precio </label>
        <input type="number" step="0.01" min="0"name="price" value="{{$stockCart->price}}">
  
    <span>
        @error('price')
        {{ $message }}
    @enderror
    </span>
 
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