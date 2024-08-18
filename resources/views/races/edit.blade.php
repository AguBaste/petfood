@extends('layout.plantilla')

@section('titulo', 'marcas')

@section('content')
<h1>editando  raza</h1>
<form action="{{route('races.update',$race)}}" class="form" method="POST">
    @csrf
    @method('patch')
    <label for="desc">Nombre </label>
        <input type="text" name="desc" value="{{$race->desc}}">
         <span>
                @error('desc')
                    {{ $message }}
                @enderror
            </span>
    <input type="submit" class="boton verde" value="actualizar" onclick="event.preventDefault();if(confirm('Realmente desea actualizar la raza '+'{{$race->desc}}'+ ' por la nueva raza  ' + document.querySelector('input[name=desc]').value)){
    this.form.submit();}">
</form>
@endsection