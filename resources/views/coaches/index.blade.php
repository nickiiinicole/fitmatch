@extends('layouts.app')

@section('content')
    <h1>Listado de Entrenadores</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('coaches.create') }}" class="btn btn-primary mb-3">Crear Entrenador</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($coaches as $coach)
                <tr>
                    <td>{{ $coach->name }}</td>
                    <td>{{ $coach->email }}</td>
                    <td>{{ $coach->phone }}</td>
                    <td>
                        <a href="{{ route('coaches.show', $coach->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('coaches.edit', $coach->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('coaches.destroy', $coach->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Seguro que deseas eliminar este entrenador?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $coaches->links() }}
@endsection
