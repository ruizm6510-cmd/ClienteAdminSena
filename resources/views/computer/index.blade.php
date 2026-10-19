@extends('layouts.app')

@section('content')

<h1>LISTAR COMPUTADORES</h1>

<div class="container">

    <a href="{{ route('computer.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i>
        Nuevo Computador
    </a>

    <table id="idComputer" class="table table-striped table-bordered" style="width:100%">

        <thead>
            <tr>
                <th>Id</th>
                <th>Numero</th>
                <th>Marca</th>
                <th>Foto</th>
                <th>Detalle</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>
            @if(!empty($computers) && is_iterable($computers))
                @foreach ($computers as $computer)
                    <tr>
                        <td>{{ $computer['id'] ?? '' }}</td>
                        <td>{{ $computer['number'] ?? ($computer['numero'] ?? '') }}</td>
                        <td>{{ $computer['brand'] ?? ($computer['marca'] ?? '') }}</td>
                        <td>
                            <img src="{{ $computer['photo'] ?? ($computer['foto'] ?? '') }}" alt="Imagen del computador" width="60">
                        </td>
                        <td>
                            <a href="{{ route('computer.show', $computer['id']) }}">
                                Mostrar
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('computer.edit', $computer['id']) }}">
                                Editar
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('computer.destroy', $computer['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-success btn-sm">
                                    Eliminar Computador
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center">No hay computadores disponibles o la API no respondió correctamente.</td>
                </tr>
            @endif
        </tbody>

    </table>

</div>

@endsection