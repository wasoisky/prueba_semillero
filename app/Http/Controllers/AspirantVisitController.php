<?php

namespace App\Http\Controllers;

use App\Models\AspirantVisit;
use Illuminate\Http\Request;

class AspirantVisitController extends Controller
{
    /*Muestra un listado de registros Aspirant-Visit.*/
    public function index()
    {
        $records = AspirantVisit::with(['aspirant', 'visit'])->get();
        return response()->json($records);
    }

    /*Muestra el formulario de creación*/
    public function create()
    {
        return view('aspirant_visit.create');
    }

    /*Guarda un nuevo registro Aspirant-Visit.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_aspirant' => 'required|exists:aspirants,id',
            'id_visit'    => 'required|exists:visits,id',
        ]);

        $record = AspirantVisit::create($validated);

        return response()->json([
            'message' => 'Relación Aspirant-Visit creada con éxito',
            'data'    => $record,
        ], 201);
    }

    /*Muestra un registro específico.*/
    public function show(AspirantVisit $aspirantVisit)
    {
        $aspirantVisit->load(['aspirant', 'visit']);
        return response()->json($aspirantVisit);
    }

    /*Muestra el formulario de edición*/
    public function edit(AspirantVisit $aspirantVisit)
    {
        return view('aspirant_visit.edit', compact('aspirantVisit'));
    }

    /*Actualiza un registro existente.*/
    public function update(Request $request, AspirantVisit $aspirantVisit)
    {
        $validated = $request->validate([
            'id_aspirant' => 'required|exists:aspirants,id',
            'id_visit'    => 'required|exists:visits,id',
        ]);

        $aspirantVisit->update($validated);

        return response()->json([
            'message' => 'Relación Aspirant-Visit actualizada con éxito',
            'data'    => $aspirantVisit,
        ]);
    }

    /*Elimina un registro.*/
    public function destroy(AspirantVisit $aspirantVisit)
    {
        $aspirantVisit->delete();

        return response()->json([
            'message' => 'Relación Aspirant-Visit eliminada con éxito',
        ]);
    }
}
