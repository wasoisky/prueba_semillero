<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use Illuminate\Http\Request;

class CriterionController extends Controller
{
    /*Muestra un listado de criterios.*/
    public function index()
    {
        $criteria = Criterion::with('questions')->get();
        return response()->json($criteria);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('criterion.create');
    }

    /*Guarda un nuevo criterio.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $criterion = Criterion::create($validated);

        return response()->json([
            'message' => 'Criterio creado con éxito',
            'data'    => $criterion,
        ], 201);
    }

    /*Muestra un criterio específico.*/
    public function show(Criterion $criterion)
    {
        $criterion->load('questions');
        return response()->json($criterion);
    }

    /*Muestra el formulario de edición.*/
    public function edit(Criterion $criterion)
    {
        return view('criterion.edit', compact('criterion'));
    }

    /*Actualiza un criterio existente.*/
    public function update(Request $request, Criterion $criterion)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $criterion->update($validated);

        return response()->json([
            'message' => 'Criterio actualizado con éxito',
            'data'    => $criterion,
        ]);
    }

    /*Elimina un criterio.*/
    public function destroy(Criterion $criterion)
    {
        $criterion->delete();

        return response()->json([
            'message' => 'Criterio eliminado con éxito',
        ]);
    }
}
