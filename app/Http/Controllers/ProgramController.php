<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /*Muestra un listado de programas.*/
    public function index()
    {
        $programs = Program::with(['faculty', 'aspirants', 'aspirantPrograms'])->get();
        return response()->json($programs);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('programs.create');
    }

    /*Guarda un nuevo programa.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'        => 'required|string|max:20|unique:programs,code',
            'description' => 'required|string|max:255',
            'faculty_id'  => 'required|exists:faculty,id',
        ]);

        $program = Program::create($validated);

        return response()->json([
            'message' => 'Programa creado con éxito',
            'data'    => $program,
        ], 201);
    }

    /*Muestra un programa específico.*/
    public function show(Program $program)
    {
        $program->load(['faculty', 'aspirants', 'aspirantPrograms']);
        return response()->json($program);
    }

    /*Muestra el formulario de edición.*/
    public function edit(Program $program)
    {
        return view('programs.edit', compact('program'));
    }

    /*Actualiza un programa existente.*/
    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'code'        => 'required|string|max:20|unique:programs,code,' . $program->id,
            'description' => 'required|string|max:255',
            'faculty_id'  => 'required|exists:faculty,id',
        ]);

        $program->update($validated);

        return response()->json([
            'message' => 'Programa actualizado con éxito',
            'data'    => $program,
        ]);
    }

    /*Elimina un programa.*/
    public function destroy(Program $program)
    {
        $program->delete();

        return response()->json([
            'message' => 'Programa eliminado con éxito',
        ]);
    }
}
