<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use Illuminate\Http\Request;

class MetricController extends Controller
{
    /*Muestra un listado de métricas.*/
    public function index()
    {
        $metrics = Metric::with('advertising')->get();
        return response()->json($metrics);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('metric.create');
    }

    /*Guarda una nueva métrica.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_advertising'       => 'required|exists:advertising,id',
            'visits'               => 'nullable|integer|min:0',
            'coments'              => 'nullable|integer|min:0',
            'measured_at_datetime' => 'required|date',
        ]);

        $metric = Metric::create($validated);

        return response()->json([
            'message' => 'Métrica creada con éxito',
            'data'    => $metric,
        ], 201);
    }

    /*Muestra una métrica específica.*/
    public function show(Metric $metric)
    {
        $metric->load('advertising');
        return response()->json($metric);
    }

    /*Muestra el formulario de edición.*/
    public function edit(Metric $metric)
    {
        return view('metric.edit', compact('metric'));
    }

    /*Actualiza una métrica existente.*/
    public function update(Request $request, Metric $metric)
    {
        $validated = $request->validate([
            'id_advertising'       => 'required|exists:advertising,id',
            'visits'               => 'nullable|integer|min:0',
            'coments'              => 'nullable|integer|min:0',
            'measured_at_datetime' => 'required|date',
        ]);

        $metric->update($validated);

        return response()->json([
            'message' => 'Métrica actualizada con éxito',
            'data'    => $metric,
        ]);
    }

    /*Elimina una métrica.*/
    public function destroy(Metric $metric)
    {
        $metric->delete();

        return response()->json([
            'message' => 'Métrica eliminada con éxito',
        ]);
    }
}
