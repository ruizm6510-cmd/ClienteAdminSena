@extends('layouts.app')

@section('content')

<h1>LISTAR APRENDICES</h1>

<div class="container">

    <a href="{{ route('aprendice.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i>
        Nuevo Aprendiz
    </a>

    <table id="idAprendice" class="table table-striped table-bordered" style="width:100%">

        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Celular</th>
                <th>Curso</th>
                <th>Computador</th>
                <th>Foto</th>
                <th>Detalle</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>
            @if(!empty($aprendices) && is_iterable($aprendices))
                @foreach ($aprendices as $aprendice)
                    <tr>
                        <td>{{ $aprendice['id'] ?? '' }}</td>
                        <td>{{ $aprendice['name'] ?? ($aprendice['nombre'] ?? '') }}</td>
                        <td>{{ $aprendice['email'] ?? '' }}</td>
                        <td>{{ $aprendice['cell_number'] ?? ($aprendice['celular'] ?? '') }}</td>
                        <td>{{ $aprendice['course_id'] ?? ($aprendice['curso_id'] ?? '') }}</td>
                        <td>{{ $aprendice['computer_id'] ?? ($aprendice['computador_id'] ?? '') }}</td>
                        <td>
                            <img src="{{ $aprendice['photo'] ?? ($aprendice['foto'] ?? '') }}" alt="Imagen del aprendiz" width="60">
                        </td>
                        <td>
                            <a href="{{ route('aprendice.show', $aprendice['id']) }}">
                                Mostrar
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('aprendice.edit', $aprendice['id']) }}">
                                Editar
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('aprendice.destroy', $aprendice['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-success btn-sm">
                                    Eliminar Aprendiz
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10" class="text-center">No hay aprendices disponibles o la API no respondió correctamente.</td>
                </tr>
            @endif
        </tbody>

    </table>

</div>

@endsection