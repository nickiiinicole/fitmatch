@extends('layouts.app')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Monomakh&family=Oswald:wght@700&family=Playfair+Display:ital,wght@0,700;1,700&display=swap"
rel="stylesheet">
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <h1>Selecciona una Clase para Reservar</h1>

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <!-- Selección de clase -->
        <div class="form-group">
            <label for="class_id">Selecciona una Clase</label>
            <select name="class_id" id="class_id" class="form-control" required>
                <option value="">-- Selecciona una clase --</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">
                        {{ $class->name }} ({{ \Carbon\Carbon::parse($class->date)->format('d/m/Y') }}, {{ $class->time }})
                    </option>
                @endforeach
            </select>
        </div>

        @if(Auth::user()->role === 'admin')
            <div class="form-group">
                <label for="user_id">Selecciona el Usuario</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">-- Selecciona un usuario --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>
        @endif

        <button type="submit" class="btn btn-success">Confirmar Reserva</button>
    </form>

    <a href="{{ route('home') }}" class="btn btn btn-primary">Volver</a>
@endsection
