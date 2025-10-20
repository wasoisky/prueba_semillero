<?php

namespace App\Http\Controllers;

use App\Models\Advertising;
use Illuminate\Http\Request;

class AdvertisingController extends Controller
{
    /**
     * Muestra un listado de todas las publicidades.
     */
    public function index()
    {
        $advertisings = Advertising::all();
        return response()->json($advertisings);
    }

    /**
     * Muestra el formulario para crear una publicidad (solo útil con Blade).
     */
    public function create()
    {
        return view('advertising.create');
    }

    /**
     * Almacena una nueva publicidad en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'        => 'required|string|max:100',
            'content'     => 'nullable|string',
            'channel'     => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
        ]);

        $advertising = Advertising::create($validated);

        return response()->json([
            'message' => 'Publicidad creada con éxito',
            'data'    => $advertising,
        ], 201);
    }

    /**
     * Muestra una publicidad específica.
     */
    public function show(Advertising $advertising)
    {
        return response()->json($advertising);
    }

    /**
     * Muestra el formulario de edición (solo útil con Blade).
     */
    public function edit(Advertising $advertising)
    {
        return view('advertising.edit', compact('advertising'));
    }

    /**
     * Actualiza una publicidad existente.
     */
    public function update(Request $request, Advertising $advertising)
    {
        $validated = $request->validate([
            'type'        => 'required|string|max:100',
            'content'     => 'nullable|string',
            'channel'     => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
        ]);

        $advertising->update($validated);

        return response()->json([
            'message' => 'Publicidad actualizada con éxito',
            'data'    => $advertising,
        ]);
    }

    /** Elimina una publicidad.*/
    public function destroy(Advertising $advertising)
    {
        $advertising->delete();

        return response()->json([
            'message' => 'Publicidad eliminada con éxito',
        ]);
    }
}
