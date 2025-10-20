<?php

namespace App\Http\Controllers;

use App\Models\AspirantAdvertising;
use Illuminate\Http\Request;

class AspirantAdvertisingController extends Controller
{
    /*Muestra un listado de registros Aspirant-Advertising.*/
    public function index()
    {
        $records = AspirantAdvertising::with(['aspirant', 'advertising'])->get();
        return response()->json($records);
    }

    /*Muestra el formulario de creación*/
    public function create()
    {
        return view('aspirant_advertising.create');
    }

    /*Guarda un nuevo registro Aspirant-Advertising.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_aspirant'    => 'required|exists:aspirants,id',
            'id_advertising' => 'required|exists:advertising,id',
        ]);

        $record = AspirantAdvertising::create($validated);

        return response()->json([
            'message' => 'Relación Aspirant-Advertising creada con éxito',
            'data'    => $record,
        ], 201);
    }

    /*Muestra un registro específico.*/
    public function show(AspirantAdvertising $aspirantAdvertising)
    {
        $aspirantAdvertising->load(['aspirant', 'advertising']);
        return response()->json($aspirantAdvertising);
    }

    /*Muestra el formulario de edición*/
    public function edit(AspirantAdvertising $aspirantAdvertising)
    {
        return view('aspirant_advertising.edit', compact('aspirantAdvertising'));
    }

    /*Actualiza un registro existente.*/
    public function update(Request $request, AspirantAdvertising $aspirantAdvertising)
    {
        $validated = $request->validate([
            'id_aspirant'    => 'required|exists:aspirants,id',
            'id_advertising' => 'required|exists:advertising,id',
        ]);

        $aspirantAdvertising->update($validated);

        return response()->json([
            'message' => 'Relación Aspirant-Advertising actualizada con éxito',
            'data'    => $aspirantAdvertising,
        ]);
    }

    /*Elimina un registro.*/
    public function destroy(AspirantAdvertising $aspirantAdvertising)
    {
        $aspirantAdvertising->delete();

        return response()->json([
            'message' => 'Relación Aspirant-Advertising eliminada con éxito',
        ]);
    }
}
