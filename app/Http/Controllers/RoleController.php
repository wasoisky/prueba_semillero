<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /*Muestra un listado de roles.*/
    public function index()
    {
        $roles = Role::with(['users', 'permissions'])->get();
        return response()->json($roles);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('roles.create');
    }

    /*Guarda un nuevo rol.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $role = Role::create($validated);

        return response()->json([
            'message' => 'Rol creado con éxito',
            'data'    => $role,
        ], 201);
    }

    /*Muestra un rol específico.*/
    public function show(Role $role)
    {
        $role->load(['users', 'permissions']);
        return response()->json($role);
    }

    /*Muestra el formulario de edición.*/
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    /*Actualiza un rol existente.*/
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $role->update($validated);

        return response()->json([
            'message' => 'Rol actualizado con éxito',
            'data'    => $role,
        ]);
    }

    /*Elimina un rol.*/
    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'message' => 'Rol eliminado con éxito',
        ]);
    }
}
