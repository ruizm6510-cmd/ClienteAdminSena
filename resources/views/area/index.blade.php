@extends('layouts.app')

@section('content')

<h1>LISTAR ÁREAS</h1>

<div class="container">

    <a href="{{ route('area.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i>
        Nueva Área
    </a>

    <table id="idArea" class="table table-striped table-bordered" style="width:100%">

        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Detalle</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>
            @if(!empty($areas) && is_iterable($areas))
                @foreach ($areas as $area)
                    <tr>
                        <td>{{ $area['id'] ?? '' }}</td>
                        <td>{{ $area['name'] ?? '' }}</td>
                        <td>
                            <a href="{{ route('area.show', $area['id']) }}">
                                Mostrar
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('area.edit', $area['id']) }}">
                                Editar
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('area.destroy', $area['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-success btn-sm">
                                    Eliminar Área
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">No hay áreas disponibles o la API no respondió correctamente.</td>
                </tr>
            @endif
        </tbody>

    </table>

</div>

@endsection