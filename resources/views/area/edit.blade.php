@extends('layouts.app')

@section('content')
    <h1>Actualizar area</h1>

    <form action="{{ route('area.update', $area['id']) }}" method="POST">

        @csrf
        @method('PUT')



        <label>
            Nombre:
            <br>
            <input type="text" name="name" value="{{ old('name', $area['name']) }}">
         </label>     

        <br><br>

        <br><br>
        <button type="submit" class="btn btn-success">Actualizar area</button>


    </form>
@endsection