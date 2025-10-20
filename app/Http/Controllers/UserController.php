<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /*Muestra un listado de usuarios.*/
    public function index()
    {
        $users = User::with([
            'person',
            'role',
            'aspirant',
            'studentDetails',
            'visits',
            'calls',
            'userAnswers'
        ])->get();

        return response()->json($users);
    }

    /*Muestra el formulario de creación.*/
    public function create()
    {
        return view('users.create');
    }

    /*Guarda un nuevo usuario.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'login'      => 'required|string|max:50|unique:users,login',
            'password'   => 'required|string|min:6',
            'person_id'  => 'required|exists:person,id',
            'role_id'    => 'required|exists:roles,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'message' => 'Usuario creado con éxito',
            'data'    => $user,
        ], 201);
    }

    /*Muestra un usuario específico.*/
    public function show(User $user)
    {
        $user->load(['person', 'role', 'aspirant', 'studentDetails', 'visits', 'calls', 'userAnswers']);
        return response()->json($user);
    }

    /*Muestra el formulario de edición.*/
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /*Actualiza un usuario existente.*/
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'login'      => 'required|string|max:50|unique:users,login,' . $user->id,
            'password'   => 'nullable|string|min:6',
            'person_id'  => 'required|exists:person,id',
            'role_id'    => 'required|exists:roles,id',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'message' => 'Usuario actualizado con éxito',
            'data'    => $user,
        ]);
    }

    /*Elimina un usuario.*/
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'Usuario eliminado con éxito',
        ]);
    }
}
