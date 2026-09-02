<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    // 👁️ VER inventario — Todos los roles pueden ver
    public function index()
    {
        if (!auth()->user()->can('ver inventario')) {
            abort(403, 'No tienes permiso para ver el inventario.');
        }

        $inventarios = Inventario::all();

        return view('inventario.index', compact('inventarios'));
    }

    // ➕ MOSTRAR formulario de creación
    public function create()
    {
        if (!auth()->user()->can('gestionar inventario')) {
            abort(403, 'No tienes permiso para agregar al inventario.');
        }

        return view('inventario.create');
    }

    // 💾 GUARDAR nuevo item
    public function store(Request $request)
    {
        if (!auth()->user()->can('gestionar inventario')) {
            abort(403, 'No tienes permiso para guardar en el inventario.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:0',
        ]);

        Inventario::create([
            'nombre' => $request->nombre,
            'cantidad' => $request->cantidad,
        ]);

        return redirect()->route('inventario.index')
                         ->with('success', 'Ítem agregado correctamente.');
    }

    // 👁️ VER un item específico
    public function show(string $id)
    {
        if (!auth()->user()->can('ver inventario')) {
            abort(403, 'No tienes permiso para ver este ítem.');
        }

        $inventario = Inventario::findOrFail($id);

        return view('inventario.show', compact('inventario'));
    }

    // ✏️ MOSTRAR formulario de edición
    public function edit(string $id)
    {
        if (!auth()->user()->can('gestionar inventario')) {
            abort(403, 'No tienes permiso para editar el inventario.');
        }

        $inventario = Inventario::findOrFail($id);

        return view('inventario.edit', compact('inventario'));
    }

    // 💾 ACTUALIZAR item
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('gestionar inventario')) {
            abort(403, 'No tienes permiso para actualizar el inventario.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:0',
        ]);

        $item = Inventario::findOrFail($id);
        $item->update([
            'nombre' => $request->nombre,
            'cantidad' => $request->cantidad,
        ]);

        return redirect()->route('inventario.index')
                         ->with('success', 'Ítem actualizado correctamente.');
    }

    // 🗑️ ELIMINAR item — Solo propietario
    public function destroy(string $id)
    {
        if (!auth()->user()->hasRole('propietario')) {
            abort(403, 'Solo el propietario puede eliminar ítems del inventario.');
        }

        $item = Inventario::findOrFail($id);
        $item->delete();

        return redirect()->route('inventario.index')
                         ->with('success', 'Ítem eliminado correctamente.');
    }
}