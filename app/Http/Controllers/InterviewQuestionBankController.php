<?php

namespace App\Http\Controllers;

use App\Models\InterviewQuestionBank;
use Illuminate\Http\Request;

class InterviewQuestionBankController extends Controller
{
    /*Muestra un listado del banco de preguntas de entrevistas.*/
    public function index()
    {
        $banks = InterviewQuestionBank::with('options')->get();
        return response()->json($banks);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('interview_questions_bank.create');
    }

    /*Guarda una nueva pregunta en el banco.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'type'        => 'required|in:open,close',
        ]);

        $bank = InterviewQuestionBank::create($validated);

        return response()->json([
            'message' => 'Pregunta del banco creada con éxito',
            'data'    => $bank,
        ], 201);
    }

    /*Muestra una pregunta específica del banco.*/
    public function show(InterviewQuestionBank $interviewQuestionBank)
    {
        $interviewQuestionBank->load('options');
        return response()->json($interviewQuestionBank);
    }

    /*Muestra el formulario de edición.*/
    public function edit(InterviewQuestionBank $interviewQuestionBank)
    {
        return view('interview_questions_bank.edit', compact('interviewQuestionBank'));
    }

    /*Actualiza una pregunta del banco existente.*/
    public function update(Request $request, InterviewQuestionBank $interviewQuestionBank)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'type'        => 'required|in:open,close',
        ]);

        $interviewQuestionBank->update($validated);

        return response()->json([
            'message' => 'Pregunta del banco actualizada con éxito',
            'data'    => $interviewQuestionBank,
        ]);
    }

    /*Elimina una pregunta del banco.*/
    public function destroy(InterviewQuestionBank $interviewQuestionBank)
    {
        $interviewQuestionBank->delete();

        return response()->json([
            'message' => 'Pregunta del banco eliminada con éxito',
        ]);
    }
}
