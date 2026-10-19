@extends('layouts.app')

@section('content')

<h1>formulario teacher</h1>

<form action="{{route('teacher.store')}}" method="POST" enctype="multipart/form-data">

@csrf

<label>
    Nombre:
    <br>
    <input type="name" name="name">
</label>
<br>
<br>
<label>
    Email:
    <br>
    <input type="text" name="email">
</label>
<br>
<br>

{{-- {{$areas}} --}}

<label for="area_id">Area</label>

    <select name="area_id" id="area_id" class="form-control">
        <option value="">Seleccione un area</option>

        @foreach($areas as $area)
            <option value="{{ $area['id'] }}">
                {{ $area['name'] }}
            </option>
        @endforeach
    </select>
    <br>
    <br>


    {{-- {{$training_centers}} --}}

<label for="training_center_id">Training center</label>

    <select name="training_center_id" id="training_center_id" class="form-control">
        <option value="">Seleccione un centro de formacion</option>

        @foreach($training_centers as $training_center)
            <option value="{{ $training_center['id'] }}">
                {{ $training_center['name'] }}
            </option>
        @endforeach
    </select>
    <br>
    <br>


<button type="submit">Enviar Formulario:</button>
</form>

@endsection