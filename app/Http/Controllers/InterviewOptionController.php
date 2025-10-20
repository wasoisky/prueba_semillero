<?php

namespace App\Http\Controllers;

use App\Models\InterviewOption;
use Illuminate\Http\Request;

class InterviewOptionController extends Controller
{
    /*Muestra un listado de opciones de entrevista.*/
    public function index()
    {
        $options = InterviewOption::with('question')->get();
        return response()->json($options);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('interview_options.create');
    }

    /*Guarda una nueva opción de entrevista.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_id'  => 'required|exists:interview_question_bank,id',
            'description'  => 'required|string|max:255',
        ]);

        $option = InterviewOption::create($validated);

        return response()->json([
            'message' => 'Opción de entrevista creada con éxito',
            'data'    => $option,
        ], 201);
    }

    /*Muestra una opción específica.*/
    public function show(InterviewOption $interviewOption)
    {
        $interviewOption->load('question');
        return response()->json($interviewOption);
    }

    /*Muestra el formulario de edición.*/
    public function edit(InterviewOption $interviewOption)
    {
        return view('interview_options.edit', compact('interviewOption'));
    }

    /*Actualiza una opción de entrevista existente.*/
    public function update(Request $request, InterviewOption $interviewOption)
    {
        $validated = $request->validate([
            'question_id'  => 'required|exists:interview_question_bank,id',
            'description'  => 'required|string|max:255',
        ]);

        $interviewOption->update($validated);

        return response()->json([
            'message' => 'Opción de entrevista actualizada con éxito',
            'data'    => $interviewOption,
        ]);
    }

    /*Elimina una opción de entrevista.*/
    public function destroy(InterviewOption $interviewOption)
    {
        $interviewOption->delete();

        return response()->json([
            'message' => 'Opción de entrevista eliminada con éxito',
        ]);
    }
}
