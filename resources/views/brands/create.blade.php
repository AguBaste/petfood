@extends('layout.plantilla')

@section('titulo', 'crear marca')

@section('content') 
<h1 class="titulo">Registrar una marca</h1>
    <form class="form" action="{{ route('brands.store') }}" method="POST">
        @csrf
        <label for="desc">Nombre de la marca</label>
            <input type="text" name="desc" placeholder="ingrese el nombre de la marca ">
        
        <span>
            @error('desc'){{$message}}
            @enderror
        </span>
       
        <input type="submit" value="crear" class="boton verde" onclick="event.preventDefault();if(confirm('Realmente desea crear la marca ' + document.querySelector('input[name=desc]').value)){
        this.form.submit();};">
    </form>
    @endsection
