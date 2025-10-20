<?php

namespace App\Http\Controllers;

use App\Models\Characterization;
use Illuminate\Http\Request;

class CharacterizationController extends Controller
{
    /*Muestra un listado de caracterizaciones.*/
    public function index()
    {
        $characterizations = Characterization::with('tests')->get();
        return response()->json($characterizations);
    }

    /*Muestra el formulario de creación*/
    public function create()
    {
        return view('characterization.create');
    }

    /*Guarda una nueva caracterización.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'date_start'  => 'required|date',
            'date_end'    => 'required|date|after_or_equal:date_start',
            'semester'    => 'required|string|max:50',
        ]);

        $characterization = Characterization::create($validated);

        return response()->json([
            'message' => 'Caracterización creada con éxito',
            'data'    => $characterization,
        ], 201);
    }

    /*Muestra una caracterización específica.*/
    public function show(Characterization $characterization)
    {
        $characterization->load('tests');
        return response()->json($characterization);
    }

    /*Muestra el formulario de edición*/
    public function edit(Characterization $characterization)
    {
        return view('characterization.edit', compact('characterization'));
    }

    /*Actualiza una caracterización existente.*/
    public function update(Request $request, Characterization $characterization)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'date_start'  => 'required|date',
            'date_end'    => 'required|date|after_or_equal:date_start',
            'semester'    => 'required|string|max:50',
        ]);

        $characterization->update($validated);

        return response()->json([
            'message' => 'Caracterización actualizada con éxito',
            'data'    => $characterization,
        ]);
    }

    /*Elimina una caracterización.*/
    public function destroy(Characterization $characterization)
    {
        $characterization->delete();

        return response()->json([
            'message' => 'Caracterización eliminada con éxito',
        ]);
    }
}
