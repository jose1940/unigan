<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('ver inventario')) {
            abort(403, 'No tienes permiso para ver el inventario.');
        }

        $buscar = $request->get('buscar');

        $inventarios = Inventario::when($buscar, function ($query, $buscar) {
            return $query->where('nombre', 'LIKE', '%' . $buscar . '%');
        })->get();

        return view('inventario.index', compact('inventarios'));
    }

    public function create()
    {
        if (!auth()->user()->can('gestionar inventario')) {
            abort(403);
        }
        return view('inventario.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('gestionar inventario')) {
            abort(403, 'No tienes permiso para guardar en el inventario.');
        }

        $request->validate([
            'nombre'            => 'required|string|max:255',
            'cantidad'          => 'required|integer|min:0',
            'fecha_compra'      => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date',
        ]);

        Inventario::create([
            'nombre'            => $request->nombre,
            'cantidad'          => $request->cantidad,
            'fecha_compra'      => $request->fecha_compra,
            'fecha_vencimiento' => $request->fecha_vencimiento,
        ]);

        return redirect()->route('inventario.index')
                         ->with('success', 'Ítem agregado correctamente.');
    }

    public function show(string $id)
    {
        if (!auth()->user()->can('ver inventario')) {
            abort(403);
        }
        $inventario = Inventario::findOrFail($id);
        return view('inventario.show', compact('inventario'));
    }

    public function edit(string $id)
    {
        if (!auth()->user()->can('gestionar inventario')) {
            abort(403);
        }
        $inventario = Inventario::findOrFail($id);
        return view('inventario.edit', compact('inventario'));
    }

    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('gestionar inventario')) {
            abort(403, 'No tienes permiso para actualizar el inventario.');
        }

        $request->validate([
            'nombre'            => 'required|string|max:255',
            'cantidad'          => 'required|integer|min:0',
            'fecha_compra'      => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date',
        ]);

        $item = Inventario::findOrFail($id);
        $item->update([
            'nombre'            => $request->nombre,
            'cantidad'          => $request->cantidad,
            'fecha_compra'      => $request->fecha_compra,
            'fecha_vencimiento' => $request->fecha_vencimiento,
        ]);

        return redirect()->route('inventario.index')
                         ->with('success', 'Ítem actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        if (!auth()->user()->hasRole('super admin')) {
            abort(403, 'Solo el super admin puede eliminar ítems del inventario.');
        }

        $item = Inventario::findOrFail($id);
        $item->delete();

        return redirect()->route('inventario.index')
                         ->with('success', 'Ítem eliminado correctamente.');
    }
}