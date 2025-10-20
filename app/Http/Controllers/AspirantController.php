<?php

namespace App\Http\Controllers;

use App\Models\Aspirant;
use Illuminate\Http\Request;

class AspirantController extends Controller
{
    /*Muestra un listado de aspirantes.*/
    public function index()
    {
        $aspirants = Aspirant::with(['user', 'programs', 'calls', 'interviews', 'visits'])->get();
        return response()->json($aspirants);
    }

    /*Muestra el formulario de creación*/
    public function create()
    {
        return view('aspirants.create');
    }

    /*Guarda un nuevo aspirante.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $aspirant = Aspirant::create($validated);

        return response()->json([
            'message' => 'Aspirante creado con éxito',
            'data'    => $aspirant,
        ], 201);
    }

    /*Muestra un aspirante específico.*/
    public function show(Aspirant $aspirant)
    {
        $aspirant->load(['user', 'programs', 'calls', 'interviews', 'visits']);
        return response()->json($aspirant);
    }

    /*Muestra el formulario de edición*/
    public function edit(Aspirant $aspirant)
    {
        return view('aspirants.edit', compact('aspirant'));
    }

    /* Actualiza un aspirante.*/
    public function update(Request $request, Aspirant $aspirant)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $aspirant->update($validated);

        return response()->json([
            'message' => 'Aspirante actualizado con éxito',
            'data'    => $aspirant,
        ]);
    }

    /*Elimina un aspirante.*/
    public function destroy(Aspirant $aspirant)
    {
        $aspirant->delete();

        return response()->json([
            'message' => 'Aspirante eliminado con éxito',
        ]);
    }
}
