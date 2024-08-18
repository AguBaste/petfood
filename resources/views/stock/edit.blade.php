@extends('layout.plantilla')

@section('titulo', 'Stock')

@section('content')
    <h1 class="titulo">editando stock</h1>
    <form class="form" action="{{ route('stock.update', $stock) }}" method="post">
        @csrf
        @method('PATCH')
        <input class="input-img" type="image" src="{{ asset('upload/' . $stock->product->image) }}">
        <div class="cont-kilos-bolsas">
            <label for="bags">bolsas</label>
            <input class="edit-input" type="number" step="1" name="bags"
                value="{{ floor($stock->quantity / $stock->product->weight) }}">
            <span>
                @error('bgas')
                    {{ $message }}
                @enderror
            </span>
            <label for="pounds">kilos</label>

            <input class="edit-input" step="0.001" type="number" name="pounds"
                value="{{ ($stock->quantity / $stock->product->weight - floor($stock->quantity / $stock->product->weight)) * $stock->product->weight }}">
            <span>
                @error('pounds')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <input type="submit" class="boton verde" value="Actualizar"
            onclick="event.preventDefault(); if(prompt('ingrese clave')==='soyjorge'){
            this.closest('form').submit();}"
            </form>
    @endsection
