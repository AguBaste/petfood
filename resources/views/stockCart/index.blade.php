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
            <div class="contenedor-todo">
                <label for="price">Precio de compra anterior  </label>
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
                 <x-input-btn>
                <x-slot name="class">
                    boton-form azul
                </x-slot>
                <x-slot name="value">
                    Agregar mas productos
                </x-slot>
            </x-input-btn>
            </div>        
        </div>
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
                                <img src="{{ asset('upload/' . $item->product->image) }}" class="mini-imagen" alt="">
                                {{ $item->product->brand->desc . ' ' . $item->product->race->desc . ' ' . $item->product->flavor->desc . ' ' . $item->product->weight . ' kg' }}
                            </div>
                        </td>
                        <td><span class="texto-verde">$</span> {{ number_format($item->price) }}</td>

                        <td>
                            <form action="{{ route('stockCart.destroy', $item) }}" method="post">
                                @csrf
                                @method('delete')
                               <input type="submit" class="boton rojo" value="borrar" onclick="event.preventDefault();
                                 if(confirm('Realmente desea borrar el producto ' + '{{$item->product->brand->desc .' '. $item->product->race->desc .' '. $item->product->flavor->desc .' '. $item->quantity .'kg \n de esta compra'}}'))
                               {this.form.submit();}">
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
           
            <input type="submit" class="boton verde" value="guardar" onclick="event.preventDefault();
            if(confirm('Asegúrese de que los productos ingresados para esta compra sean los correctos')){this.form.submit();}">
        </form>
    @endif


@endsection
