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

        $animales = Animal::all();
        return view('animales.index', compact('animales'));
    }

    public function create()
    {
        if (!auth()->user()->can('crear animales')) {
            abort(403);
        }
        return view('animales.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('crear animales')) {
            abort(403);
        }

        $request->validate([
            'numero_arete'     => 'nullable|string',
            'peso'             => 'nullable|numeric|min:0',
            'fecha_nacimiento' => 'nullable|date|before_or_equal:today',
            'fecha_compra'     => 'nullable|date',
        ]);

        Animal::create([
            'numero_arete'     => $request->numero_arete,
            'nombre'           => $request->nombre,
            'especie'          => $request->especie,
            'peso'             => $request->peso,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'fecha_compra'     => $request->fecha_compra,
        ]);

        return redirect()->route('animales.index')
            ->with('success', 'Animal registrado correctamente.');
    }

    public function show(string $id)
    {
        if (!auth()->user()->can('ver animales')) abort(403);
        return view('animales.show');
    }

    public function edit(string $id)
    {
        if (!auth()->user()->can('editar animales')) abort(403);
        return view('animales.edit');
    }

    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('editar animales')) {
            abort(403);
        }

        $request->validate([
            'numero_arete'     => 'nullable|string',
            'peso'             => 'nullable|numeric|min:0',
            'fecha_nacimiento' => 'nullable|date|before_or_equal:today',
            'fecha_compra'     => 'nullable|date',
        ]);

        $animal = Animal::findOrFail($id);
        $animal->update([
            'numero_arete'     => $request->numero_arete,
            'nombre'           => $request->nombre,
            'especie'          => $request->especie,
            'peso'             => $request->peso,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'fecha_compra'     => $request->fecha_compra,
        ]);

        return redirect()->route('animales.index')
            ->with('success', 'Animal actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        if (!auth()->user()->can('eliminar animales')) abort(403);

        $animal = Animal::findOrFail($id);
        $animal->delete();

        return redirect()->route('animales.index')
            ->with('success', 'Animal eliminado correctamente.');
    }
}