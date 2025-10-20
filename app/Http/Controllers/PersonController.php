<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /*Muestra un listado de personas.*/
    public function index()
    {
        $people = Person::with(['dni', 'city', 'user'])->get();
        return response()->json($people);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('person.create');
    }

    /*Guarda una nueva persona.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dni_id'           => 'required|exists:dni,id',
            'name'             => 'required|string|max:100',
            'lastname'         => 'required|string|max:100',
            'phone'            => 'nullable|string|max:20',
            'address'          => 'nullable|string|max:255',
            'email'            => 'nullable|email|max:150|unique:person,email',
            'city_id'          => 'required|exists:cities,id',
            'birthday'         => 'nullable|date',
            'biological_gender'=> 'nullable|string|max:20',
            'latitude'         => 'nullable|numeric',
            'longitude'        => 'nullable|numeric',
        ]);

        $person = Person::create($validated);

        return response()->json([
            'message' => 'Persona creada con éxito',
            'data'    => $person,
        ], 201);
    }

    /*Muestra una persona específica.*/
    public function show(Person $person)
    {
        $person->load(['dni', 'city', 'user']);
        return response()->json($person);
    }

    /*Muestra el formulario de edición.*/
    public function edit(Person $person)
    {
        return view('person.edit', compact('person'));
    }

    /*Actualiza una persona existente.*/
    public function update(Request $request, Person $person)
    {
        $validated = $request->validate([
            'dni_id'           => 'required|exists:dni,id',
            'name'             => 'required|string|max:100',
            'lastname'         => 'required|string|max:100',
            'phone'            => 'nullable|string|max:20',
            'address'          => 'nullable|string|max:255',
            'email'            => 'nullable|email|max:150|unique:person,email,' . $person->id,
            'city_id'          => 'required|exists:cities,id',
            'birthday'         => 'nullable|date',
            'biological_gender'=> 'nullable|string|max:20',
            'latitude'         => 'nullable|numeric',
            'longitude'        => 'nullable|numeric',
        ]);

        $person->update($validated);

        return response()->json([
            'message' => 'Persona actualizada con éxito',
            'data'    => $person,
        ]);
    }

    /*Elimina una persona.*/
    public function destroy(Person $person)
    {
        $person->delete();

        return response()->json([
            'message' => 'Persona eliminada con éxito',
        ]);
    }
}
