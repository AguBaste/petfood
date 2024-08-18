@extends('layout.plantilla')

@section('titulo', 'sabores')

@section('content')
<h1>editando sabor</h1>
<form action="{{route('flavors.update',$flavor)}}" class="form" method="POST">
    @csrf
    @method('patch')
    <label for="desc">Nombre </label>
        <input type="text" name="desc" value="{{$flavor->desc}}">
   
       <input type="submit" class="boton verde" value="actualizar" onclick="event.preventDefault();if(confirm('Realmente desea actualizar el sabor '+'{{$flavor->desc}}'+ ' por el nuevo sabor  ' + document.querySelector('input[name=desc]').value)){
    this.form.submit();}">
</form>
@endsection