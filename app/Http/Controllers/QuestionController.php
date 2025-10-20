<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /*Muestra un listado de preguntas.*/
    public function index()
    {
        $questions = Question::with(['test', 'questionType', 'criterion', 'options', 'userAnswers'])->get();
        return response()->json($questions);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('question.create');
    }

    /*Guarda una nueva pregunta.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'test_id'           => 'required|exists:tests,id',
            'question_type_id'  => 'required|exists:question_types,id',
            'criterion_id'      => 'required|exists:criterion,id',
            'description'       => 'required|string|max:500',
            'is_mandatory'      => 'required|boolean',
        ]);

        $question = Question::create($validated);

        return response()->json([
            'message' => 'Pregunta creada con éxito',
            'data'    => $question,
        ], 201);
    }

    /*Muestra una pregunta específica.*/
    public function show(Question $question)
    {
        $question->load(['test', 'questionType', 'criterion', 'options', 'userAnswers']);
        return response()->json($question);
    }

    /*Muestra el formulario de edición.*/
    public function edit(Question $question)
    {
        return view('question.edit', compact('question'));
    }

    /*Actualiza una pregunta existente.*/
    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'test_id'           => 'required|exists:tests,id',
            'question_type_id'  => 'required|exists:question_types,id',
            'criterion_id'      => 'required|exists:criterion,id',
            'description'       => 'required|string|max:500',
            'is_mandatory'      => 'required|boolean',
        ]);

        $question->update($validated);

        return response()->json([
            'message' => 'Pregunta actualizada con éxito',
            'data'    => $question,
        ]);
    }

    /*Elimina una pregunta.*/
    public function destroy(Question $question)
    {
        $question->delete();

        return response()->json([
            'message' => 'Pregunta eliminada con éxito',
        ]);
    }
}
