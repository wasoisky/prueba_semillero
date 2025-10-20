<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    /*Muestra un listado de entrevistas.*/
    public function index()
    {
        $interviews = Interview::with(['aspirant', 'user', 'interviewQuestions'])->get();
        return response()->json($interviews);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('interviews.create');
    }

    /*Guarda una nueva entrevista.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'aspirant_id' => 'required|exists:aspirants,id',
            'user_id'     => 'required|exists:users,id',
            'date'        => 'required|date',
            'description' => 'nullable|string',
            'status'      => 'required|string|max:50',
        ]);

        $interview = Interview::create($validated);

        return response()->json([
            'message' => 'Entrevista creada con éxito',
            'data'    => $interview,
        ], 201);
    }

    /*Muestra una entrevista específica.*/
    public function show(Interview $interview)
    {
        $interview->load(['aspirant', 'user', 'interviewQuestions']);
        return response()->json($interview);
    }

    /*Muestra el formulario de edición.*/
    public function edit(Interview $interview)
    {
        return view('interviews.edit', compact('interview'));
    }

    /*Actualiza una entrevista existente.*/
    public function update(Request $request, Interview $interview)
    {
        $validated = $request->validate([
            'aspirant_id' => 'required|exists:aspirants,id',
            'user_id'     => 'required|exists:users,id',
            'date'        => 'required|date',
            'description' => 'nullable|string',
            'status'      => 'required|string|max:50',
        ]);

        $interview->update($validated);

        return response()->json([
            'message' => 'Entrevista actualizada con éxito',
            'data'    => $interview,
        ]);
    }

    /*Elimina una entrevista.*/
    public function destroy(Interview $interview)
    {
        $interview->delete();

        return response()->json([
            'message' => 'Entrevista eliminada con éxito',
        ]);
    }
}
