@extends('layouts.app')

@section('content')
    <h1>Actualizar curso</h1>

    <form action="{{ route('course.update', $curso['id']) }}" method="POST">

        @csrf
        @method('PUT')



        <label>
            Numero de curso:
            <br>
                <input type="number" name="course_number" value="{{ old('course_number', $curso['course_number']) }}">
        </label>
        <br>
        <label>
            Dia:
            <br>
                <input type="text" name="day" value="{{ old('day', $curso['day']) }}">
        </label>

        <br><br>
        <label class="form-label">Area</label>

        <select name="area_id" class="form-select">
            @foreach ($areas as $area)
                <option value="{{ $area['id'] }}" {{ $curso['area_id'] == $area['id'] ? 'selected' : '' }}>
                    {{ $area['id'] }} - {{ $area['name'] }}
                </option>
            @endforeach
        </select>
        <br><br>

        <label class="form-label">Centro de formacion</label>

        <select name="training_center_id" class="form-select">
            @foreach ($training_centers as $center)
                <option value="{{ $center['id'] }}" {{ $curso['training_center_id'] == $center['id'] ? 'selected' : '' }}>
                    {{ $center['id'] }} - {{ $center['name'] }}
                </option>
            @endforeach
        </select>

        <br><br>
        <button type="submit" class="btn btn-success">Actualizar Curso</button>


    </form>
@endsection