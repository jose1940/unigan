<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('ver usuarios')) {
            abort(403, 'No tienes permiso para ver usuarios.');
        }
        $usuarios = User::with('roles')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        if (!auth()->user()->can('gestionar usuarios')) {
            abort(403, 'No tienes permiso para crear usuarios.');
        }
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('gestionar usuarios')) {
            abort(403, 'No tienes permiso para guardar usuarios.');
        }
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'rol'      => 'required|exists:roles,name',
        ]);

        $usuario = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $usuario->assignRole($request->rol);

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario creado correctamente.');
    }

    public function show(string $id)
    {
        if (!auth()->user()->can('ver usuarios')) {
            abort(403, 'No tienes permiso para ver este usuario.');
        }
        $usuario = User::with('roles')->findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(string $id)
    {
        if (!auth()->user()->can('gestionar usuarios')) {
            abort(403, 'No tienes permiso para editar usuarios.');
        }
        $usuario = User::findOrFail($id);
        $roles = Role::all();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('gestionar usuarios')) {
            abort(403, 'No tienes permiso para actualizar usuarios.');
        }
        $usuario = User::findOrFail($id);
        $usuario->syncRoles($request->rol);

        return redirect()->route('usuarios.index')
                         ->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        if (!auth()->user()->hasRole('super_admin')) {
            abort(403, 'Solo el super_admin puede eliminar usuarios.');
        }
        User::findOrFail($id)->delete();

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario eliminado correctamente.');
    }
}