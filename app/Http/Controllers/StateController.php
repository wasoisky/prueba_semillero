<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /*Muestra un listado de estados.*/
    public function index()
    {
        $states = State::with('cities')->get();
        return response()->json($states);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('states.create');
    }

    /*Guarda un nuevo estado.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'        => 'required|string|max:20|unique:states,code',
            'description' => 'required|string|max:255',
        ]);

        $state = State::create($validated);

        return response()->json([
            'message' => 'Estado creado con éxito',
            'data'    => $state,
        ], 201);
    }

    /*Muestra un estado específico.*/
    public function show(State $state)
    {
        $state->load('cities');
        return response()->json($state);
    }

    /*Muestra el formulario de edición.*/
    public function edit(State $state)
    {
        return view('states.edit', compact('state'));
    }

    /*Actualiza un estado existente.*/
    public function update(Request $request, State $state)
    {
        $validated = $request->validate([
            'code'        => 'required|string|max:20|unique:states,code,' . $state->id,
            'description' => 'required|string|max:255',
        ]);

        $state->update($validated);

        return response()->json([
            'message' => 'Estado actualizado con éxito',
            'data'    => $state,
        ]);
    }

    /*Elimina un estado.*/
    public function destroy(State $state)
    {
        $state->delete();

        return response()->json([
            'message' => 'Estado eliminado con éxito',
        ]);
    }
}
