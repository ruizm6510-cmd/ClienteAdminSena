@extends('layouts.app')

@section('content')
    <h1>Actualizar aprendiz</h1>

    <form action="{{ route('aprendice.update', $aprendice['id']) }}" method="POST">

        @csrf
        @method('PUT')



        <label>
            Nombre:
            <br>
            <input type="text" name="name" value="{{ old('name', $aprendice['name']) }}">
        </label>
        <br>
        <label>
            Email:
            <br>
            <input type="text" name="email" value="{{ old('email', $aprendice['email']) }}">
        </label>
        <br>
        <label>
            Numero de celular:
            <br>
            <input type="number" name="cell_number" value="{{ old('cell_number', $aprendice['cell_number']) }}">
        </label>

        <br><br>
        <label class="form-label">Curso</label>

        <select name="course_id" class="form-select">
            @foreach ($courses as $course)
                <option value="{{ $course['id'] }}" {{ $aprendice['course_id'] == $course['id'] ? 'selected' : '' }}>
                    {{ $course['id'] }} - {{ $course['course_number'] }}
                </option>
            @endforeach
        </select>
        <br><br>

        <label class="form-label">Computadora</label>

        <select name="computer_id" class="form-select">
            @foreach ($computers as $computer)
                <option value="{{ $computer['id'] }}" {{ $aprendice['computer_id'] == $computer['id'] ? 'selected' : '' }}>
                    {{ $computer['id'] }} - {{ $computer['number'] }}
                </option>
            @endforeach
        </select>

        <br><br>
        <button type="submit" class="btn btn-success">Actualizar Aprendiz</button>


    </form>
@endsection