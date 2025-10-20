<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /*Muestra un listado de permisos.*/
    public function index()
    {
        $permissions = Permission::with('roles')->get();
        return response()->json($permissions);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('permissions.create');
    }

    /*Guarda un nuevo permiso.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $permission = Permission::create($validated);

        return response()->json([
            'message' => 'Permiso creado con éxito',
            'data'    => $permission,
        ], 201);
    }

    /*Muestra un permiso específico.*/
    public function show(Permission $permission)
    {
        $permission->load('roles');
        return response()->json($permission);
    }

    /*Muestra el formulario de edición.*/
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    /*Actualiza un permiso existente.*/
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $permission->update($validated);

        return response()->json([
            'message' => 'Permiso actualizado con éxito',
            'data'    => $permission,
        ]);
    }

    /*Elimina un permiso.*/
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return response()->json([
            'message' => 'Permiso eliminado con éxito',
        ]);
    }
}
