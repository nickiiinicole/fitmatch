@extends('layouts.app')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Monomakh&family=Oswald:wght@700&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/show.css') }}">

<h1>{{ $class->name }}</h1>
<p>{{ $class->description }}</p>

<!-- Concatenar fecha y hora -->
<p>Fecha y Hora: {{ \Carbon\Carbon::parse($class->date.' '.$class->time)->format('d/m/Y H:i') }}</p>

<p>Instructor: {{ $class->coach ? $class->coach->name : 'No asignado' }}</p>
<p>Capacidad: {{ $class->capacity }}</p>

@if($class->reservations->count() < $class->capacity)
    <a href="{{ route('reservations.create', $class->id) }}" class="btn btn-primary">Reservar Clase</a>
@else
    <p class="text-danger">Clase llena</p>
@endif

<a href="{{ route('classes.index') }}">Volver</a>
@endsection
