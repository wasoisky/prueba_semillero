<?php

namespace App\Http\Controllers;

use App\Models\DniType;
use Illuminate\Http\Request;

class DniTypeController extends Controller
{
    /*Muestra un listado de tipos de documento de identidad.*/
    public function index()
    {
        $dniTypes = DniType::with('dnis')->get();
        return response()->json($dniTypes);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('dni_type.create');
    }

    /*Guarda un nuevo tipo de documento de identidad.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description'  => 'required|string|max:255',
            'abbreviation' => 'required|string|max:10|unique:dni_type,abbreviation',
        ]);

        $dniType = DniType::create($validated);

        return response()->json([
            'message' => 'Tipo de documento creado con éxito',
            'data'    => $dniType,
        ], 201);
    }

    /*Muestra un tipo de documento específico.*/
    public function show(DniType $dniType)
    {
        $dniType->load('dnis');
        return response()->json($dniType);
    }

    /*Muestra el formulario de edición.*/
    public function edit(DniType $dniType)
    {
        return view('dni_type.edit', compact('dniType'));
    }

    /*Actualiza un tipo de documento existente.*/
    public function update(Request $request, DniType $dniType)
    {
        $validated = $request->validate([
            'description'  => 'required|string|max:255',
            'abbreviation' => 'required|string|max:10|unique:dni_type,abbreviation,' . $dniType->id,
        ]);

        $dniType->update($validated);

        return response()->json([
            'message' => 'Tipo de documento actualizado con éxito',
            'data'    => $dniType,
        ]);
    }

    /*Elimina un tipo de documento.*/
    public function destroy(DniType $dniType)
    {
        $dniType->delete();

        return response()->json([
            'message' => 'Tipo de documento eliminado con éxito',
        ]);
    }
}
