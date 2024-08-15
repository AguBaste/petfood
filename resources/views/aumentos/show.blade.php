@extends('layout.plantilla')

@section('titulo', 'aumentos')

@section('content')
    <h1 class="titulo">modificando precio de la marca {{ $brand->desc }}</h1>
    <form action="{{ route('aumentos.update', $brandId) }}" class="form" method="post">
        @csrf
        @method('patch')

        <label for="valor">porcentaje a modificar</label>
        <input type="number" min="0" step="0.01" name="valor"
            placeholder="Ingrese el porcentaje que desea para el aumento">

        <span>
            @error('valor')
                {{ $message }}
            @enderror
        </span>
        <label for="type">acción a realizar</label>
        <select name="type">
            <option value="aumentar" selected>aumentar</option>
            <option value="disminuir">disminuir</option>
        </select>

        <span>
            @error('type')
                {{ $message }}
            @enderror
        </span>
        <input type="sumbit" class="boton verde" value="actualizar"
            onclick="event.preventDefault();
            if(confirm('Realmente desea '+ document.querySelector('select[name=type]').value+ ' todos los productos de la marca ' +'{{ $brand->desc }}' + ' en un '+ document.querySelector('input[name=valor]').value + '% ?'))
            {this.form.submit();}">
    </form>

@endsection
