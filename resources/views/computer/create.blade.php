@extends('layouts.app')

@section('content')

<h1>formulario computer</h1>

<form action="{{route('computer.store')}}" method="POST" enctype="multipart/form-data">

@csrf

<label>
    Numero:
    <br>
    <input type="number" name="number">
</label>
<br>
<br>
<label>
    Marca:
    <br>
    <input type="text" name="brand">
</label>
<br>
<br>

 <input type="file" name="urlFoto" class="form-control-file" accept="image/*">


<button type="submit">Enviar Formulario:</button>
</form>

@endsection