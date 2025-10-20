<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /*Muestra un listado de pruebas.*/
    public function index()
    {
        $tests = Test::with(['characterization', 'questions'])->get();
        return response()->json($tests);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('test.create');
    }

    /*Guarda una nueva prueba.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'characterization_id' => 'required|exists:characterization,id',
            'description'         => 'required|string|max:255',
        ]);

        $test = Test::create($validated);

        return response()->json([
            'message' => 'Prueba creada con éxito',
            'data'    => $test,
        ], 201);
    }

    /*Muestra una prueba específica.*/
    public function show(Test $test)
    {
        $test->load(['characterization', 'questions']);
        return response()->json($test);
    }

    /*Muestra el formulario de edición.*/
    public function edit(Test $test)
    {
        return view('test.edit', compact('test'));
    }

    /*Actualiza una prueba existente.*/
    public function update(Request $request, Test $test)
    {
        $validated = $request->validate([
            'characterization_id' => 'required|exists:characterization,id',
            'description'         => 'required|string|max:255',
        ]);

        $test->update($validated);

        return response()->json([
            'message' => 'Prueba actualizada con éxito',
            'data'    => $test,
        ]);
    }

    /*Elimina una prueba.*/
    public function destroy(Test $test)
    {
        $test->delete();

        return response()->json([
            'message' => 'Prueba eliminada con éxito',
        ]);
    }
}
