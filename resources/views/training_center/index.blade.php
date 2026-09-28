@extends('layouts.app')

@section('content')

    <h1>LISTAR CENTROS DE FORMACION</h1>

    <div class="container">

        <a href="{{ route('training_center.create') }}" class="btn btn-success mb-3">
            <i class="bi bi-plus-circle"></i> Nuevo centro de formacion
        </a>

        <br>

        <table id="idTraining_center" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Ubicacion</th>
                    <th>Detalle</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                {{-- Validamos que $centers exista y no sea null para evitar el error --}}
                @if(!empty($centers) && (is_array($centers) || is_object($centers)))
                    @foreach ($centers as $center)
                        <tr>
                            <td>{{ $center['id'] ?? '' }}</td>
                            <td>{{ $center['name'] ?? '' }}</td>
                            <td>{{ $center['location'] ?? '' }}</td>
                            
                            <td>
                                <a href="{{ route('training_center.show', $center['id'] ?? 0) }}">Mostrar</a>
                            </td>
                            
                            <td>
                                <a href="{{ route('training_center.edit', $center['id'] ?? 0) }}">Editar</a>
                            </td>
                            
                            <td>
                                <form action="{{ route('training_center.destroy', $center['id'] ?? 0) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-success">Eliminar centro</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay centros de formación disponibles o la API no respondió correctamente.</td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>

@endsection