@extends('layouts.app')

@section('content')
<h1>{{ $class->name }}</h1>
<p>{{ $class->description }}</p>
<p>Fecha y Hora: {{ $class->date_time }}</p>
<p>Instructor: {{ $class->instructor }}</p>
<p>Capacidad: {{ $class->capacity }}</p>

@if($class->reservations->count() < $class->capacity)
    <a href="{{ route('reservations.create', $class->id) }}" class="btn btn-primary">Reservar Clase</a>
@else
    <p class="text-danger">Clase llena</p>
@endif

<a href="{{ route('classes.index') }}">Volver</a>
@endsection
