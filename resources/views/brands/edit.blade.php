@extends('layout.plantilla')

@section('titulo', 'marcas')

@section('content')
<h1>editando marca</h1>
<form action="{{route('brands.update',$brand)}}" class="form" method="POST">
    @csrf
    @method('patch')
    <label for="desc">Nombre </label>
        <input type="text" name="desc" value="{{$brand->desc}}">
   
    <input type="submit" class="boton verde" value="actualizar" onclick="event.preventDefault();if(confirm('Realmente desea actualizar  la marca '+'{{$brand->desc}}'+ ' con el nuevo nombre  ' + document.querySelector('input[name=desc]').value)){
    this.form.submit();}">
</form>
@endsection