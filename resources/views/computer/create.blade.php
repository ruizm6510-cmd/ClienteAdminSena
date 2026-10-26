@extends('layouts.app')

@section('content')

<h1>Crear Computadora</h1>

<form action="{{ route('computer.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>
        Número:
        <br>
        <input type="number" name="number" class="form-control" required>
    </label>
    <br><br>

    <label>
        Marca:
        <br>
        <input type="text" name="brand" class="form-control" required>
    </label>
    <br><br>

    <div class="mb-3">
        <label class="form-label">Foto de la Computadora:</label>
        <br>
        <input type="file" name="urlFoto" class="form-control-file" accept="image/*">
    </div>
    <br>

    <button type="submit" class="btn btn-outline-success btn-sm">Enviar Formulario</button>
</form>

@endsection