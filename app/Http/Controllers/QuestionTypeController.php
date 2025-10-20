<?php

namespace App\Http\Controllers;

use App\Models\QuestionType;
use Illuminate\Http\Request;

class QuestionTypeController extends Controller
{
    /*Muestra un listado de tipos de pregunta.*/
    public function index()
    {
        $types = QuestionType::with('questions')->get();
        return response()->json($types);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('question_type.create');
    }

    /*Guarda un nuevo tipo de pregunta.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $type = QuestionType::create($validated);

        return response()->json([
            'message' => 'Tipo de pregunta creado con éxito',
            'data'    => $type,
        ], 201);
    }

    /*Muestra un tipo de pregunta específico.*/
    public function show(QuestionType $questionType)
    {
        $questionType->load('questions');
        return response()->json($questionType);
    }

    /*Muestra el formulario de edición.*/
    public function edit(QuestionType $questionType)
    {
        return view('question_type.edit', compact('questionType'));
    }

    /*Actualiza un tipo de pregunta existente.*/
    public function update(Request $request, QuestionType $questionType)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $questionType->update($validated);

        return response()->json([
            'message' => 'Tipo de pregunta actualizado con éxito',
            'data'    => $questionType,
        ]);
    }

    /*Elimina un tipo de pregunta.*/
    public function destroy(QuestionType $questionType)
    {
        $questionType->delete();

        return response()->json([
            'message' => 'Tipo de pregunta eliminado con éxito',
        ]);
    }
}
