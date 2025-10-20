<?php

namespace App\Http\Controllers;

use App\Models\AspirantProgram;
use Illuminate\Http\Request;

class AspirantProgramController extends Controller
{
    /*Muestra un listado de registros Aspirant-Program.*/
    public function index()
    {
        $records = AspirantProgram::with(['aspirant', 'program'])->get();
        return response()->json($records);
    }

    /*Muestra el formulario de creación*/
    public function create()
    {
        return view('aspirant_programs.create');
    }

    /*Guarda un nuevo registro Aspirant-Program.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'aspirant_id'      => 'required|exists:aspirants,id',
            'program_id'       => 'required|exists:programs,id',
            'enrollment_date'  => 'nullable|date',
            'status'           => 'nullable|string|max:50',
        ]);

        $record = AspirantProgram::create($validated);

        return response()->json([
            'message' => 'Relación Aspirant-Program creada con éxito',
            'data'    => $record,
        ], 201);
    }

    /*Muestra un registro específico.*/
    public function show(AspirantProgram $aspirantProgram)
    {
        $aspirantProgram->load(['aspirant', 'program']);
        return response()->json($aspirantProgram);
    }

    /*Muestra el formulario de edición*/
    public function edit(AspirantProgram $aspirantProgram)
    {
        return view('aspirant_programs.edit', compact('aspirantProgram'));
    }

    /*Actualiza un registro existente.*/
    public function update(Request $request, AspirantProgram $aspirantProgram)
    {
        $validated = $request->validate([
            'aspirant_id'      => 'required|exists:aspirants,id',
            'program_id'       => 'required|exists:programs,id',
            'enrollment_date'  => 'nullable|date',
            'status'           => 'nullable|string|max:50',
        ]);

        $aspirantProgram->update($validated);

        return response()->json([
            'message' => 'Relación Aspirant-Program actualizada con éxito',
            'data'    => $aspirantProgram,
        ]);
    }

    /*Elimina un registro.*/
    public function destroy(AspirantProgram $aspirantProgram)
    {
        $aspirantProgram->delete();

        return response()->json([
            'message' => 'Relación Aspirant-Program eliminada con éxito',
        ]);
    }
}
