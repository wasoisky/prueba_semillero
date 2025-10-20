<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /*Muestra un listado de opciones.*/
    public function index()
    {
        $options = Option::with(['question', 'userAnswers'])->get();
        return response()->json($options);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('option.create');
    }

    /*Guarda una nueva opción.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order'       => 'required|integer|min:1',
            'question_id' => 'required|exists:questions,id',
            'description' => 'required|string|max:255',
        ]);

        $option = Option::create($validated);

        return response()->json([
            'message' => 'Opción creada con éxito',
            'data'    => $option,
        ], 201);
    }

    /*Muestra una opción específica.*/
    public function show(Option $option)
    {
        $option->load(['question', 'userAnswers']);
        return response()->json($option);
    }

    /*Muestra el formulario de edición.*/
    public function edit(Option $option)
    {
        return view('option.edit', compact('option'));
    }

    /*Actualiza una opción existente.*/
    public function update(Request $request, Option $option)
    {
        $validated = $request->validate([
            'order'       => 'required|integer|min:1',
            'question_id' => 'required|exists:questions,id',
            'description' => 'required|string|max:255',
        ]);

        $option->update($validated);

        return response()->json([
            'message' => 'Opción actualizada con éxito',
            'data'    => $option,
        ]);
    }

    /*Elimina una opción.*/
    public function destroy(Option $option)
    {
        $option->delete();

        return response()->json([
            'message' => 'Opción eliminada con éxito',
        ]);
    }
}
