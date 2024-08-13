@extends('layout.plantilla')

@section('titulo', 'gastos')

@section('content')
    <h1 class="titulo">registrando un nuevo gasto</h1>
    <form class="form" action="{{ route('expenses.store') }}" method="POST">
        @csrf
        <label for="desc">Descripción del gasto</label>
        <input type="text" name="desc" placeholder="ingrese la descripción del gasto">

        <span>
            @error('desc')
                {{ $message }}
            @enderror
        </span>

        <label for="price">importe del gasto</label>
        <input type="text" name="price" placeholder="ingrese el importe del gasto">

        <span>
            @error('desc')
                {{ $message }}
            @enderror
        </span>
       <input type="submit" value="guardar" class="boton verde" onclick="event.preventDefault();
       if(confirm('Realmente desea registrar el siguiente gasto:\n'
       + document.querySelector('input[name=desc]').value + ' por '
       + document.querySelector('input[name=price]').value))
       {this.form.submit();}">
    </form>
@endsection
