
{{-- resources/views/coaches/show.blade.php --}}
{{-- falta hacer el css --}}
@extends('layouts.app')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Monomakh&family=Oswald:wght@700&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/showCoach.css') }}">
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
