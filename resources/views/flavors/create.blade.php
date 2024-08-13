@extends('layout.plantilla')

@section('titulo', 'crear sabor')

@section('content')
<h1 class="titulo">registrar sabor</h1>
    <form class="form" action="{{ route('flavors.store') }}" method="POST">
        @csrf
        <label for="desc">Descripción del sabor</label>
            <input type="text" name="desc" placeholder="ingrese la descripcion del sabor">
        
        <span>  
            @error('desc'){{$message}}
            @enderror
        </span>
        

       <input type="submit" value="crear" class="boton verde" onclick="event.preventDefault();
       if(confirm('Realmente desea crear el sabor ' + document.querySelector('input[name=desc]').value))
       {this.form.submit();}">
    </form>
    @endsection
