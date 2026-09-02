<?php

namespace App\Http\Controllers;

use App\Models\Animal; 
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('ver animales')) {
            abort(403, 'No tienes permiso para ver los animales.');
        }

        // Obtener los animales registrados para pasar a la vista
        $animales = Animal::all();

        return view('animales.index', compact('animales'));
    }

    public function create()
    {
        if (!auth()->user()->can('crear animales')) {
            abort(403, 'No tienes permiso para agregar animales.');
        }

        return view('animales.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('crear animales')) {
            abort(403, 'No tienes permiso para guardar animales.');
        }

        // 2. Validar que la información requerida llegue desde el formulario
        $request->validate([
            'numero_arete' => 'required',
        ]);

        // 3. Insertar el nuevo registro en la base de datos
        Animal::create([
            'numero_arete' => $request->numero_arete,
            'nombre'       => $request->nombre,
            'especie'      => $request->especie,
        ]);

        return redirect()->route('animales.index')
            ->with('success', 'Animal registrado correctamente.');
    }

    public function show(string $id)
    {
        if (!auth()->user()->can('ver animales')) {
            abort(403, 'No tienes permiso para ver este animal.');
        }

        return view('animales.show');
    }

    public function edit(string $id)
    {
        if (!auth()->user()->can('editar animales')) {
            abort(403, 'No tienes permiso para editar animales.');
        }

        return view('animales.edit');
    }

    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('editar animales')) {
            abort(403, 'No tienes permiso para actualizar animales.');
        }

        $animal = Animal::findOrFail($id);
        $animal->update([
            'numero_arete' => $request->numero_arete,
            'nombre'       => $request->nombre,
            'especie'      => $request->especie,
        ]);

        return redirect()->route('animales.index')
            ->with('success', 'Animal actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        if (!auth()->user()->can('eliminar animales')) {
            abort(403, 'No tienes permiso para eliminar animales.');
        }

        $animal = Animal::findOrFail($id);
        $animal->delete();

        return redirect()->route('animales.index')
            ->with('success', 'Animal eliminado correctamente.');
    }
}