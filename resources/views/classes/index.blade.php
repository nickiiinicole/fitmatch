{{-- resources/views/classes/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Clases</h1>
    <a href="{{ route('classes.create') }}" class="btn btn-primary mb-3">Crear Clase</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Capacidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($classes as $class)
            <tr>
                <td>{{ $class->name }}</td>
                <td>{{ $class->date }}</td>
                <td>{{ $class->time }}</td>
                <td>{{ $class->capacity }}</td>
                <td>
                    <a href="{{ route('classes.show', $class->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Seguro que deseas eliminar esta clase?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $classes->links() }}
    {{-- //codigo nuevo --}}
    @if(Auth::user()->is_admin)
    <a href="{{ route('classes.create') }}" class="btn btn-primary">Crear Clase</a>
@endif

</div>
@endsection
