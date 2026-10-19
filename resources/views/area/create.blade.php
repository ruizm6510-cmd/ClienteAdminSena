@extends('layouts.app')

@section('content')


<h1>formulario area</h1>

<form action="{{route('area.store')}}" method="POST" enctype="multipart/form-data">

@csrf

<label>
    Nombre:
    <br>
    <input type="text" name="name">
</label>
<br>
<br>


<button type="submit">Enviar Formulario:</button>
</form>

@endsection