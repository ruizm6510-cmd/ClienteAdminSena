@extends('layouts.app')

@section('content')

<h1>formulario aprendice</h1>

<form action="{{route('aprendice.store')}}" method="POST" enctype="multipart/form-data">

@csrf

<label>
    Nombre
    <br>
    <input type="text" name="name">
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
<label>
    Numero celular:
    <br>
    <input type="number" name="cell_number">
</label>
<br>
<br>

{{-- {{$courses}} --}}

<label for="course_id">Curso</label>

    <select name="course_id" id="user_id" class="form-control">
        <option value="">Seleccione un curso</option>

        @foreach($courses as $course)
            <option value="{{ $course['id'] }}">
                {{ $course['course_number'] }}
            </option>
        @endforeach
    </select>
    <br>
    <br>


    {{-- {{$computers}} --}}

<label for="computer_id">Computer</label>

    <select name="computer_id" id="computer_id" class="form-control">
        <option value="">Seleccione un computador</option>

        @foreach($computers as $computer)
            <option value="{{ $computer['id'] }}">
                {{ $computer['number'] }}
            </option>
        @endforeach
    </select>
    <br> 
    <br> 



<button type="submit">Enviar Formulario:</button>
</form>

@endsection