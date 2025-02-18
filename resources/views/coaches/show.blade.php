
{{-- resources/views/coaches/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Entrenador</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            {{ $coach->name }}
        </div>
        <div class="card-body">
            <p><strong>Correo:</strong> {{ $coach->email }}</p>
            <p><strong>Teléfono:</strong> {{ $coach->phone }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('coaches.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
