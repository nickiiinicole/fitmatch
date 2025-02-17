<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Redirect;

class ClassController extends Controller
{
    public function __construct()
    {
        // Protegemos todas las rutas para usuarios autenticados
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = ClassModel::paginate(10);
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'date' => 'required|date',
            'time' => 'required',
            'duration' => 'required|integer|min:1',
        ]);

        ClassModel::create($request->all());

        return Redirect::route('classes.index')
            ->with('success', 'Clase creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $class = ClassModel::findOrFail($id);
        return view('classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $class = ClassModel::findOrFail($id);
        return view('classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $class = ClassModel::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            // etc...
        ]);

        $class->update($request->all());

        return Redirect::route('classes.index')
            ->with('success', 'Clase actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = ClassModel::findOrFail($id);
        $class->delete();
        return Redirect::route('classes.index')
            ->with('success', 'Clase eliminada correctamente');
    }
}
