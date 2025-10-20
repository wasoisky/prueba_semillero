<?php

namespace App\Http\Controllers;

use App\Models\StudentDetails;
use Illuminate\Http\Request;

class StudentDetailsController extends Controller
{
    /*Muestra un listado de detalles de estudiantes.*/
    public function index()
    {
        $students = StudentDetails::with(['user', 'program'])->get();
        return response()->json($students);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('student_details.create');
    }

    /*Guarda un nuevo detalle de estudiante.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'          => 'required|exists:users,id|unique:student_details,user_id',
            'program_id'       => 'required|exists:programs,id',
            'current_semester' => 'required|integer|min:1',
        ]);

        $studentDetails = StudentDetails::create($validated);

        return response()->json([
            'message' => 'Detalle de estudiante creado con éxito',
            'data'    => $studentDetails,
        ], 201);
    }

    /*Muestra un detalle de estudiante específico.*/
    public function show(StudentDetails $studentDetails)
    {
        $studentDetails->load(['user', 'program']);
        return response()->json($studentDetails);
    }

    /*Muestra el formulario de edición.*/
    public function edit(StudentDetails $studentDetails)
    {
        return view('student_details.edit', compact('studentDetails'));
    }

    /*Actualiza un detalle de estudiante existente.*/
    public function update(Request $request, StudentDetails $studentDetails)
    {
        $validated = $request->validate([
            'program_id'       => 'required|exists:programs,id',
            'current_semester' => 'required|integer|min:1',
        ]);

        $studentDetails->update($validated);

        return response()->json([
            'message' => 'Detalle de estudiante actualizado con éxito',
            'data'    => $studentDetails,
        ]);
    }

    /*Elimina un detalle de estudiante.*/
    public function destroy(StudentDetails $studentDetails)
    {
        $studentDetails->delete();

        return response()->json([
            'message' => 'Detalle de estudiante eliminado con éxito',
        ]);
    }
}
