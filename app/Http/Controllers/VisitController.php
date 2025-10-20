<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /*Muestra un listado de visitas.*/
    public function index()
    {
        $visits = Visit::with(['aspirant', 'user'])->get();
        return response()->json($visits);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('visits.create');
    }

    /*Guarda una nueva visita.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'aspirant_id' => 'required|exists:aspirants,id',
            'who_went'    => 'required|string|max:150',
            'date'        => 'required|date',
            'place'       => 'required|string|max:255',
            'purpose'     => 'nullable|string|max:255',
            'user_id'     => 'required|exists:users,id',
        ]);

        $visit = Visit::create($validated);

        return response()->json([
            'message' => 'Visita creada con éxito',
            'data'    => $visit,
        ], 201);
    }

    /*Muestra una visita específica.*/
    public function show(Visit $visit)
    {
        $visit->load(['aspirant', 'user']);
        return response()->json($visit);
    }

    /*Muestra el formulario de edición.*/
    public function edit(Visit $visit)
    {
        return view('visits.edit', compact('visit'));
    }

    /*Actualiza una visita existente.*/
    public function update(Request $request, Visit $visit)
    {
        $validated = $request->validate([
            'aspirant_id' => 'required|exists:aspirants,id',
            'who_went'    => 'required|string|max:150',
            'date'        => 'required|date',
            'place'       => 'required|string|max:255',
            'purpose'     => 'nullable|string|max:255',
            'user_id'     => 'required|exists:users,id',
        ]);

        $visit->update($validated);

        return response()->json([
            'message' => 'Visita actualizada con éxito',
            'data'    => $visit,
        ]);
    }

    /*Elimina una visita.*/
    public function destroy(Visit $visit)
    {
        $visit->delete();

        return response()->json([
            'message' => 'Visita eliminada con éxito',
        ]);
    }
}
