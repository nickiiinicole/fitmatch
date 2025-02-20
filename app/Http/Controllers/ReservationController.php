<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reservation;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Muestra solo las reservas del usuario logueado (o todas si es admin)
        if (Auth::user()->role === 'admin') {
            $reservations = Reservation::with('classModel', 'user')->paginate(10);
        } else {
            $reservations = Reservation::where('user_id', Auth::id())
                ->with('classModel')
                ->paginate(10);
        }

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // Recuperamos todas las clases disponibles
        $classes = ClassModel::all();

        // Verificamos si el usuario es un admin y pasamos los usuarios
        if (Auth::user()->role === 'admin') {
            $users = \App\Models\User::all();
            return view('reservations.create', compact('classes', 'users'));
        }
        return view('reservations.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
        ]);

        // Verifica si la clase tiene cupo
        $class = ClassModel::findOrFail($request->class_id);

        // Verificar si la clase tiene cupo
        $reservasCount = Reservation::where('class_id', $class->id)->count();
        if ($reservasCount >= $class->capacity) {
            return back()->withErrors('La clase ya está llena.');
        }

        // Si es admin, debe haber enviado un user_id válido; si no, se asigna el usuario autenticado
        if (Auth::user()->role === 'admin') {
            $request->validate([
                'user_id' => 'required|exists:users,id',
            ]);
            $userId = $request->user_id;
        } else {
            $userId = Auth::id();
        }

        // Crear la reserva
        Reservation::create([
            'user_id' => $userId,
            'class_id' => $class->id,
        ]);


        return redirect()->route('reservations.index')
            ->with('success', 'Reserva creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = Reservation::with('classModel')->findOrFail($id);
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $classes = ClassModel::all();
        return view('reservations.edit', compact('reservation', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservation = Reservation::findOrFail($id);

        $request->validate([
            'class_id' => 'required|exists:classes,id',
        ]);

        $reservation->update([
            'class_id' => $request->class_id,
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Reserva actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        // Verifica si la reserva pertenece al usuario logueado o si es admin
        $reservation->delete();
        if ($reservation->user_id !== Auth::id() && !Auth::user()->role === 'admin') {
            return back()->withErrors('No puedes eliminar esta reserva.');
        }
        return redirect()->route('reservations.index')
            ->with('success', 'Reserva eliminada correctamente');
    }
}
