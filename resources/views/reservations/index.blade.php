@extends('layouts.app')

@section('content')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Monomakh&family=Oswald:wght@700&family=Playfair+Display:ital,wght@0,700;1,700&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <div class="container">
        <h1>Reservas</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Botón para crear una nueva reserva -->
        <div class="mb-3">
            <a href="{{ route('reservations.create', Auth::user()->id) }}" class="btn btn-primary">Crear Nueva Reserva</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Clase</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Usuario</th> <!-- Nueva columna para mostrar el nombre del usuario -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->classModel->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->classModel->date)->format('d/m/Y') }}</td>
                        <td>{{ $reservation->classModel->time }}</td>
                        <td>{{ $reservation->user->name }}</td> <!-- Mostrar el nombre del usuario que hizo la reserva -->

                        <td>
                            @if (Auth::user()->role === 'admin' || $reservation->user_id == Auth::id())
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('¿Seguro que deseas cancelar esta reserva?')">
                                        Cancelar
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
