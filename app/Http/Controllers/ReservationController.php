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
        if (Auth::user()->is_admin) {
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
    public function create()
    {
        // Listamos las clases disponibles para que el usuario elija
        $classes = ClassModel::all();
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

        // Contamos las reservas que ya existen para esa clase
        $reservasCount = Reservation::where('class_id', $class->id)->count();

        if ($reservasCount >= $class->capacity) {
            return back()->withErrors('La clase ya está llena.');
        }

        // Creamos la reserva
        Reservation::create([
            'user_id' => Auth::id(),
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
        $reservation->delete();
        return redirect()->route('reservations.index')
            ->with('success', 'Reserva eliminada correctamente');
    }
}
