<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /*Muestra un listado de ciudades.*/
    public function index()
    {
        $cities = City::with(['state', 'persons'])->get();
        return response()->json($cities);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('cities.create');
    }

    /*Guarda una nueva ciudad.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'        => 'required|string|max:20|unique:cities,code',
            'description' => 'required|string|max:255',
            'state_id'    => 'required|exists:states,id',
        ]);

        $city = City::create($validated);

        return response()->json([
            'message' => 'Ciudad creada con éxito',
            'data'    => $city,
        ], 201);
    }

    /*Muestra una ciudad específica.*/
    public function show(City $city)
    {
        $city->load(['state', 'persons']);
        return response()->json($city);
    }

    /*Muestra el formulario de edición.*/
    public function edit(City $city)
    {
        return view('cities.edit', compact('city'));
    }

    /*Actualiza una ciudad existente.*/
    public function update(Request $request, City $city)
    {
        $validated = $request->validate([
            'code'        => 'required|string|max:20|unique:cities,code,' . $city->id,
            'description' => 'required|string|max:255',
            'state_id'    => 'required|exists:states,id',
        ]);

        $city->update($validated);

        return response()->json([
            'message' => 'Ciudad actualizada con éxito',
            'data'    => $city,
        ]);
    }

    /*Elimina una ciudad.*/
    public function destroy(City $city)
    {
        $city->delete();

        return response()->json([
            'message' => 'Ciudad eliminada con éxito',
        ]);
    }
}
