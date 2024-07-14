@extends('layout.plantilla')

@section('titulo', 'crear producto')

@section('content')
    <h1 class="titulo"> registrar un producto</h1>
    <img class="imagen" src="{{asset('img/producto.jpeg')}}" alt="">
    <form class="form" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="brand">Marca </label> 
            <select name="brand">
                <option value="" disabled selected>seleccione una marca</option>
                @foreach ($brands as $brand)
                    <option value="{{old('brand', $brand->id) }}">{{ $brand->desc }}</option>
                @endforeach
            </select>
        
        <span>
            @error('brand'){{$message}}
            @enderror
        </span>
       
        <label for="race">Raza</label> 
            <select name="race">
                <option value="" disabled selected>seleccione una raza</option>
                @foreach ($races as $race)
                    <option value="{{ $race->id }}">{{ $race->desc }}</option>
                @endforeach
            </select>
         
        <span>
            @error('race'){{$message}}
            @enderror
        </span>
       
        <label for="flavor">Sabor</label> 
            <select name="flavor">
                <option value="" disabled  selected>seleccione un sabor</option>
                @foreach ($flavors as $flavor)
                    <option value="{{ $flavor->id }}">{{ $flavor->desc }}</option>
                @endforeach
            </select>
        <span>
            @error('flavor'){{$message}}
            @enderror
        </span>
      
        <label for="weight"> kilos</label> 
            <input type="number" step="0.01" min="0"  name="weight" value="{{old('weight')}}" placeholder="ingese la cantidad de kilos de la bolsa">

        <span>  
            @error('weight'){{$message}}
            @enderror
        </span>
       
        <label for="price">Precio</label> 
            <input type="number" step="0.01" min="1"  name = "price" value="{{old('price')}}" placeholder="ingrese el precio de compra ">
  
        <span>
            @error('price'){{$message}}
            @enderror
        </span>
       
        <label for="image">Imagen</label> 
            <input type="file" name="image" >
            <img  class="mini-imagen" id="img" alt="">
        <span>
            @error('image'){{$message}}
            @enderror
        </span>
       
        <x-input-btn> 
            <x-slot name="value">
                Guardar
            </x-slot>
            <x-slot name="class">
                boton-form verde
            </x-slot>
        </x-input-btn>
    </form>
@endsection
