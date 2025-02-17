@extends('layouts.app')

@section('content')
<h1>Mis Reservas</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<ul>
    @foreach($reservations as $reservation)
        <li>
            {{ $reservation->class->name }} - Estado: {{ $reservation->status }} <br>
            <small>Reservado el: {{ $reservation->reserved_at }}</small>

            @if($reservation->status == 'pendiente')
                <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST">
                    @csrf
                    <button type="submit">Cancelar</button>
                </form>
            @endif
        </li>
    @endforeach
</ul>
@endsection
