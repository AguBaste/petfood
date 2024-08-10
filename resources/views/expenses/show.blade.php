@extends('layout.plantilla')

@section('titulo', 'gastos')

@section('content')
<ul>
    <li>{{$expenses->price}}</li>
</ul>
@endsection