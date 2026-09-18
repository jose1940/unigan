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
            'especie'          => 'required|string',
            'numero_arete'     => 'nullable|string|max:50|unique:animals,numero_arete',
            'nombre'           => 'nullable|string|max:100',
            'peso'             => 'nullable|numeric|min:0',
            'fecha_nacimiento' => 'nullable|date|before_or_equal:today',
            'fecha_compra'     => 'nullable|date',
        ], [
            'especie.required'                 => 'Debes seleccionar la especie del animal.',
            'numero_arete.unique'              => 'El número de arete ya está registrado en otro animal. Por favor utiliza uno diferente.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser posterior a hoy.',
            'peso.min'                         => 'El peso no puede ser negativo.',
        ]);

        try {
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
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Ocurrió un error al guardar el registro: ' . $e->getMessage()]);
        }
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
            'especie'          => 'required|string',
            'numero_arete'     => 'nullable|string|max:50|unique:animals,numero_arete,' . $id,
            'nombre'           => 'nullable|string|max:100',
            'peso'             => 'nullable|numeric|min:0',
            'fecha_nacimiento' => 'nullable|date|before_or_equal:today',
            'fecha_compra'     => 'nullable|date',
        ], [
            'especie.required'                 => 'Debes seleccionar la especie del animal.',
            'numero_arete.unique'              => 'El número de arete ya está registrado en otro animal. Por favor utiliza uno diferente.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser posterior a hoy.',
            'peso.min'                         => 'El peso no puede ser negativo.',
        ]);

        try {
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
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Ocurrió un error al actualizar el registro: ' . $e->getMessage()]);
        }
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