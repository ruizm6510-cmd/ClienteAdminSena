@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <div class="card shadow-sm">
            <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: #006837; border-color: #006837;">
            <h5 class="mb-0">Detalle del Computador #{{ $computer['id'] }}</h5>
            <a href="{{ route('computer.list') }}" class="btn btn-sm btn-light">Volver</a>
        </div>
        
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label text-muted fw-bold">Id:</label>
                <p class="fs-5">{{ $computer['id'] }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label text-muted fw-bold">Numero del Computador:</label>
                <p class="fs-5">{{ $computer['number'] }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label text-muted fw-bold">Marca:</label>
                <p class="fs-5">{{ $computer['brand'] }}</p>
            </div>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('computer.list') }}" class="btn btn-secondary">Regresar a la lista</a>
        </div>
    </div>
</div>
@endsection