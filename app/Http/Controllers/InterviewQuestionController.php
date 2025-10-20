<?php

namespace App\Http\Controllers;

use App\Models\InterviewQuestion;
use Illuminate\Http\Request;

class InterviewQuestionController extends Controller
{
    /*Muestra un listado de preguntas de entrevista registradas.*/
    public function index()
    {
        $questions = InterviewQuestion::with(['interview', 'question', 'option'])->get();
        return response()->json($questions);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('interview_questions.create');
    }

    /*Guarda una nueva pregunta de entrevista.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'interview_id' => 'required|exists:interviews,id',
            'question_id'  => 'required|exists:interview_question_bank,id',
            'option_id'    => 'nullable|exists:interview_options,id',
            'answer_text'  => 'nullable|string',
        ]);

        $question = InterviewQuestion::create($validated);

        return response()->json([
            'message' => 'Pregunta de entrevista creada con éxito',
            'data'    => $question,
        ], 201);
    }

    /*Muestra una pregunta de entrevista específica.*/
    public function show(InterviewQuestion $interviewQuestion)
    {
        $interviewQuestion->load(['interview', 'question', 'option']);
        return response()->json($interviewQuestion);
    }

    /*Muestra el formulario de edición.*/
    public function edit(InterviewQuestion $interviewQuestion)
    {
        return view('interview_questions.edit', compact('interviewQuestion'));
    }

    /*Actualiza una pregunta de entrevista existente.*/
    public function update(Request $request, InterviewQuestion $interviewQuestion)
    {
        $validated = $request->validate([
            'interview_id' => 'required|exists:interviews,id',
            'question_id'  => 'required|exists:interview_question_bank,id',
            'option_id'    => 'nullable|exists:interview_options,id',
            'answer_text'  => 'nullable|string',
        ]);

        $interviewQuestion->update($validated);

        return response()->json([
            'message' => 'Pregunta de entrevista actualizada con éxito',
            'data'    => $interviewQuestion,
        ]);
    }

    /*Elimina una pregunta de entrevista.*/
    public function destroy(InterviewQuestion $interviewQuestion)
    {
        $interviewQuestion->delete();

        return response()->json([
            'message' => 'Pregunta de entrevista eliminada con éxito',
        ]);
    }
}
