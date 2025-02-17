@extends('layouts.app')

@section('content')
<h1>¡Reserva Exitosa!</h1>
<p>Has reservado la clase con éxito.</p>
<a href="{{ route('reservations.index') }}">Ver mis Reservas</a>
@endsection
