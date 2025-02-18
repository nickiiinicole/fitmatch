<?php

namespace App\Http\Controllers;
use App\Models\Coach;

use Illuminate\Http\Request;

class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coaches = Coach::paginate(10);
        return view('coaches.index', compact('coaches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coaches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:coaches,email',
            'phone' => 'nullable|string|max:20',
        ]);

        Coach::create($request->all());

        return redirect()->route('coaches.index')
            ->with('success', 'Entrenador creado correctamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $coach = Coach::findOrFail($id);
        return view('coaches.show', compact('coach'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coach = Coach::findOrFail($id);
        return view('coaches.edit', compact('coach'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $coach = Coach::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:coaches,email,' . $coach->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $coach->update($request->all());

        return redirect()->route('coaches.index')
            ->with('success', 'Entrenador actualizado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coach = Coach::findOrFail($id);
        $coach->delete();

        return redirect()->route('coaches.index')
            ->with('success', 'Entrenador elimando   correctamente.');

    }
}
