@extends('layouts.app')

@section('content')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Monomakh&family=Oswald:wght@700&family=Playfair+Display:ital,wght@0,700;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/classesIndex.css') }}">

    <div class="container">
        <h1>Editar Clase</h1>

        {{-- Mensajes de éxito o error --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Mostrar errores de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('classes.update', $class->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nombre de la clase --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nombre de la clase</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $class->name) }}" placeholder="Ej: Zumba, Yoga, etc.">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Descripción --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea name="description" id="description" rows="3"
                    class="form-control @error('description') is-invalid @enderror" placeholder="Breve descripción de la clase">{{ old('description', $class->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Fecha y Hora --}}
            <div class="mb-3">
                <label for="date_time" class="form-label">Fecha y Hora</label>
                <input type="datetime-local" name="date_time" id="date_time"
                    class="form-control @error('date_time') is-invalid @enderror"
                    value="{{ old('date_time', \Carbon\Carbon::parse($class->date_time)->format('Y-m-d\TH:i')) }}">
                @error('date_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Duración (minutos) --}}
            <div class="mb-3">
                <label for="duration" class="form-label">Duración (minutos)</label>
                <input type="number" name="duration" id="duration"
                    class="form-control @error('duration') is-invalid @enderror"
                    value="{{ old('duration', $class->duration) }}">
                @error('duration')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Capacidad --}}
            <div class="mb-3">
                <label for="capacity" class="form-label">Capacidad</label>
                <input type="number" name="capacity" id="capacity"
                    class="form-control @error('capacity') is-invalid @enderror"
                    value="{{ old('capacity', $class->capacity) }}" placeholder="Ej: 20">
                @error('capacity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Entrenador --}}
            <div class="mb-3">
                <label for="coach_id" class="form-label">Entrenador</label>
                <select name="coach_id" id="coach_id" class="form-control">
                    <option value="">Selecciona un entrenador</option>
                    @foreach ($coaches as $coach)
                        <option value="{{ $coach->id }}"
                            {{ old('coach_id', $class->coach_id) == $coach->id ? 'selected' : '' }}>
                            {{ $coach->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Botón de enviar --}}
            <button type="submit" class="btn btn-primary">Actualizar Clase</button>
            {{-- Botón de regresar al listado --}}
            <a href="{{ route('classes.index') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
@endsection
