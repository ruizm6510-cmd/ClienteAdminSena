@extends('layouts.app')

@section('content')

<h1>LISTAR CURSOS</h1>

<div class="container">

    <a href="{{ route('course.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i>
        Nuevo curso
    </a>

    <table id="idCourse" class="table table-striped table-bordered" style="width:100%">

        <thead>
            <tr>
                <th>Id</th>
                <th>Numero curso</th>
                <th>Dia</th>
                <th>Id Area</th>
                <th>Id CentroFormacion</th>
                <th>Detalle</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>
            @if(!empty($cursos) && is_iterable($cursos))
                @foreach ($cursos as $curso)
                    <tr>
                        <td>{{ $curso['id'] ?? '' }}</td>
                        <td>{{ $curso['course_number'] ?? '' }}</td>
                        <td>{{ $curso['day'] ?? '' }}</td>
                        <td>{{ $curso['area_id'] ?? '' }}</td>
                        <td>{{ $curso['training_center_id'] ?? '' }}</td>
                        <td>
                            <a href="{{ route('course.show', $curso['id']) }}">
                                Mostrar
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('course.edit', $curso['id']) }}">
                                Editar
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('course.destroy', $curso['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-success">
                                    Eliminar Curso
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center">No hay cursos disponibles o la API no respondió correctamente.</td>
                </tr>
            @endif
        </tbody>

    </table>

</div>

@endsection