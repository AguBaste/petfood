@extends('layout.plantilla')

@section('titulo', 'aumentos')

@section('content')
<h1 class="titulo">aumentnado la marca {{$brand->desc}}</h1>
<form action="{{route('aumentos.update',$brandId)}}" class="form" method="post">
    @csrf
    @method('patch')

    <label for="valor">porcentaje de aumento</label>
        <input type="number" min="0" step="0.01" name="valor"  placeholder="Ingrese el porcentaje que desea para el aumento">
  
    <span>
        @error('valor'){{$message}}
        @enderror
    </span>

   <input type="sumbit" class="boton azul" value="aumentar" onclick="event.preventDefault();if(confirm('Realmente desea aumentar todos los productos de la marca ' +'{{$brand->desc}}' + ' en un '+ document.querySelector('input[name=valor]').value + '% ?')){this.form.submit();}">
</form>

@endsection