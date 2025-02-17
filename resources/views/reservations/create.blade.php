@extends('layouts.app')

@section('content')
<h1>Reservar Clase: {{ $class->name }}</h1>
<p>Fecha: {{ $class->date_time }}</p>
<p>Instructor: {{ $class->instructor }}</p>

<form action="{{ route('reservations.store') }}" method="POST">
    @csrf
    <input type="hidden" name="class_id" value="{{ $class->id }}">
    <button type="submit" class="btn btn-success">Confirmar Reserva</button>
</form>

<a href="{{ route('classes.index') }}">Volver</a>
@endsection
