@extends('layout.plantilla')

@section('titulo', 'editar producto')

@section('content')

    <h1 class="titulo">aca vas a poder editar un producto</h1>
    <form class="form" action="{{ route('products.update', $product) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <label for="brand">Marca </label>
            <select name="brand">
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                        {{ $brand->desc }}
                    </option>
                @endforeach
            </select>
       
        <span>
            @error('brand'){{$message}}
            @enderror
        </span>
     
        <label for="race">Raza </label>
            <select name="race">
                @foreach ($races as $race)
                    <option value="{{ $race->id }}" {{ $race->id == $product->race_id ? 'selected' : '' }}>
                        {{ old('race', $race->desc) }}</option>
                @endforeach
            </select>
    
        <span>
            @error('race'){{$message}}
            @enderror
        </span>
       
        <label for="flavor">Sabor </label>
            <select name="flavor">
                @foreach ($flavors as $flavor)
                    <option value="{{ $flavor->id }}" {{ $flavor->id == $product->flavor_id ? 'selected' : '' }}>
                        {{ $flavor->desc }}
                    </option>
                @endforeach
            </select>
    
        <span>
            @error('flavor'){{$message}}
            @enderror
        </span>
       
        <label for="price">Precio </label>
            <input type="number" step="0.01" min="1" name ="price" value="{{ $product->price }}">
     
        <span>
            @error('price'){{$message}}
            @enderror
        </span>
       
        <label for="weight">Kilos </label>
            <input type="number" step="0.01" min="1" max="500" name="weight" value="{{ $product->weight }}">
    
        <span>
            @error('weight')
            {{ $message }}
        @enderror
        </span>
     
        <label for="image">Imagen </label>
            <input type="file" name="image" >

        <span>
            @error('image'){{$message}}
            @enderror
        </span>
        
        <x-input-btn>
            <x-slot name="value">
                 actualizar
            </x-slot>
            <x-slot name="class">    
                boton-form verde
            </x-slot>
        </x-input-btn>
    </form>
@endsection
