<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /*Muestra un listado de facultades.*/
    public function index()
    {
        $faculties = Faculty::with('programs')->get();
        return response()->json($faculties);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('faculty.create');
    }

    /*Guarda una nueva facultad.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'        => 'required|string|max:20|unique:faculty,code',
            'description' => 'required|string|max:255',
        ]);

        $faculty = Faculty::create($validated);

        return response()->json([
            'message' => 'Facultad creada con éxito',
            'data'    => $faculty,
        ], 201);
    }

    /*Muestra una facultad específica.*/
    public function show(Faculty $faculty)
    {
        $faculty->load('programs');
        return response()->json($faculty);
    }

    /*Muestra el formulario de edición.*/
    public function edit(Faculty $faculty)
    {
        return view('faculty.edit', compact('faculty'));
    }

    /*Actualiza una facultad existente.*/
    public function update(Request $request, Faculty $faculty)
    {
        $validated = $request->validate([
            'code'        => 'required|string|max:20|unique:faculty,code,' . $faculty->id,
            'description' => 'required|string|max:255',
        ]);

        $faculty->update($validated);

        return response()->json([
            'message' => 'Facultad actualizada con éxito',
            'data'    => $faculty,
        ]);
    }

    /*Elimina una facultad.*/
    public function destroy(Faculty $faculty)
    {
        $faculty->delete();

        return response()->json([
            'message' => 'Facultad eliminada con éxito',
        ]);
    }
}
