@extends('layout.plantilla')

@section('titulo', 'crear')

@section('content')

<h1 class="titulo">Registrar una raza</h1>
    <form class="form" action="{{ route('races.store') }}" method="POST">
        @csrf
        <label for="desc">Descripción de la raza </label>
            <input type="text" name="desc" placeholder="ingrese la descripcion de la nueva raza">
 
        <span>
            @error('desc'){{$message}}
            @enderror
        </span>
        
       <input type="submit" value="crear" class="boton verde" onclick="event.preventDefault();
       if(confirm('Realmente quiere registrar la raza '+document.querySelector('input[name=desc]').value))
       {this.form.submit();}">
    </form>
    @endsection
