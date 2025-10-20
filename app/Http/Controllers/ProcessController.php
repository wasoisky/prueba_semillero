<?php

namespace App\Http\Controllers;

use App\Models\Process;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /*Muestra un listado de procesos.*/
    public function index()
    {
        $processes = Process::with(['aspirant', 'interview', 'call', 'visit'])->get();
        return response()->json($processes);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('processes.create');
    }

    /*Guarda un nuevo proceso.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'aspirant_id'  => 'nullable|exists:aspirants,id',
            'interview_id' => 'nullable|exists:interviews,id',
            'call_id'      => 'nullable|exists:calls,id',
            'visit_id'     => 'nullable|exists:visits,id',
            'description'  => 'nullable|string',
            'status'       => 'required|string|max:50',
            'update_date'  => 'required|date',
        ]);

        $process = Process::create($validated);

        return response()->json([
            'message' => 'Proceso creado con éxito',
            'data'    => $process,
        ], 201);
    }

    /*Muestra un proceso específico.*/
    public function show(Process $process)
    {
        $process->load(['aspirant', 'interview', 'call', 'visit']);
        return response()->json($process);
    }

    /*Muestra el formulario de edición.*/
    public function edit(Process $process)
    {
        return view('processes.edit', compact('process'));
    }

    /*Actualiza un proceso existente.*/
    public function update(Request $request, Process $process)
    {
        $validated = $request->validate([
            'aspirant_id'  => 'nullable|exists:aspirants,id',
            'interview_id' => 'nullable|exists:interviews,id',
            'call_id'      => 'nullable|exists:calls,id',
            'visit_id'     => 'nullable|exists:visits,id',
            'description'  => 'nullable|string',
            'status'       => 'required|string|max:50',
            'update_date'  => 'required|date',
        ]);

        $process->update($validated);

        return response()->json([
            'message' => 'Proceso actualizado con éxito',
            'data'    => $process,
        ]);
    }

    /*Elimina un proceso.*/
    public function destroy(Process $process)
    {
        $process->delete();

        return response()->json([
            'message' => 'Proceso eliminado con éxito',
        ]);
    }
}
