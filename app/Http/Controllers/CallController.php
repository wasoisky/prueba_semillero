<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    /*Muestra un listado de llamadas.*/
    public function index()
    {
        $calls = Call::with(['aspirant', 'user'])->get();
        return response()->json($calls);
    }

    /*Muestra el formulario para crear*/
    public function create()
    {
        return view('calls.create');
    }

    /*Guarda una nueva llamada.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'aspirant_id'    => 'required|exists:aspirants,id',
            'user_id'        => 'required|exists:users,id',
            'date'           => 'required|date',
            'contact_person' => 'nullable|string|max:150',
            'response'       => 'nullable|string',
        ]);

        $call = Call::create($validated);

        return response()->json([
            'message' => 'Llamada registrada con éxito',
            'data'    => $call,
        ], 201);
    }

    /*Muestra una llamada específica.*/
    public function show(Call $call)
    {
        $call->load(['aspirant', 'user']);
        return response()->json($call);
    }

    /*Muestra el formulario de edición*/
    public function edit(Call $call)
    {
        return view('calls.edit', compact('call'));
    }

    /*Actualiza una llamada.*/
    public function update(Request $request, Call $call)
    {
        $validated = $request->validate([
            'aspirant_id'    => 'required|exists:aspirants,id',
            'user_id'        => 'required|exists:users,id',
            'date'           => 'required|date',
            'contact_person' => 'nullable|string|max:150',
            'response'       => 'nullable|string',
        ]);

        $call->update($validated);

        return response()->json([
            'message' => 'Llamada actualizada con éxito',
            'data'    => $call,
        ]);
    }

    /*Elimina una llamada.*/
    public function destroy(Call $call)
    {
        $call->delete();

        return response()->json([
            'message' => 'Llamada eliminada con éxito',
        ]);
    }
}
