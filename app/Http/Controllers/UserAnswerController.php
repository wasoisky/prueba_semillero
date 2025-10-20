<?php

namespace App\Http\Controllers;

use App\Models\UserAnswer;
use Illuminate\Http\Request;

class UserAnswerController extends Controller
{
    /*Muestra un listado de respuestas de usuario.*/
    public function index()
    {
        $answers = UserAnswer::with(['user', 'question', 'option'])->get();
        return response()->json($answers);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('user_answer.create');
    }

    /*Guarda una nueva respuesta de usuario.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_id'     => 'required|exists:question,id',
            'option_id'       => 'nullable|exists:option,id',
            'user_id'         => 'required|exists:users,id',
            'answer_text'     => 'nullable|string',
            'submission_date' => 'required|date',
        ]);

        $answer = UserAnswer::create($validated);

        return response()->json([
            'message' => 'Respuesta de usuario creada con éxito',
            'data'    => $answer,
        ], 201);
    }

    /*Muestra una respuesta específica.*/
    public function show(UserAnswer $userAnswer)
    {
        $userAnswer->load(['user', 'question', 'option']);
        return response()->json($userAnswer);
    }

    /*Muestra el formulario de edición.*/
    public function edit(UserAnswer $userAnswer)
    {
        return view('user_answer.edit', compact('userAnswer'));
    }

    /*Actualiza una respuesta de usuario existente.*/
    public function update(Request $request, UserAnswer $userAnswer)
    {
        $validated = $request->validate([
            'question_id'     => 'required|exists:question,id',
            'option_id'       => 'nullable|exists:option,id',
            'user_id'         => 'required|exists:users,id',
            'answer_text'     => 'nullable|string',
            'submission_date' => 'required|date',
        ]);

        $userAnswer->update($validated);

        return response()->json([
            'message' => 'Respuesta de usuario actualizada con éxito',
            'data'    => $userAnswer,
        ]);
    }

    /*Elimina una respuesta de usuario.*/
    public function destroy(UserAnswer $userAnswer)
    {
        $userAnswer->delete();

        return response()->json([
            'message' => 'Respuesta de usuario eliminada con éxito',
        ]);
    }
}
