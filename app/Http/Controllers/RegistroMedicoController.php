<?php
namespace App\Http\Controllers;
use App\Models\Animal;
use App\Models\RegistroMedico;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RegistroMedicoController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('ver registros medicos')) {
            abort(403, 'No tienes permiso para ver registros médicos.');
        }
        $animales = Animal::all();
        $registros = RegistroMedico::with('animal')->latest()->get();
        return view('registros-medicos.index', compact('animales', 'registros'));
    }

    public function create()
    {
        return redirect()->route('registros-medicos.index');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('crear registros medicos')) {
            abort(403, 'No tienes permiso para guardar registros médicos.');
        }
        $request->validate([
            'animal_id'     => 'required|exists:animals,id',
            'tipo_atencion' => 'required|string',
            'fecha'         => 'required|date',
            'diagnostico'   => 'nullable|string',
        ]);
        RegistroMedico::create([
            'animal_id'      => $request->animal_id,
            'tipo_atencion'  => $request->tipo_atencion,
            'fecha'          => $request->fecha,
            'fecha_proxima'  => Carbon::parse($request->fecha)->addMonth(),
            'diagnostico'    => $request->diagnostico,
            'atendido_por'   => auth()->user()->name,
        ]);
        return redirect()->route('registros-medicos.index')
                         ->with('success', 'Registro médico creado correctamente.');
    }

    public function show(string $id)
    {
        return redirect()->route('registros-medicos.index');
    }

    public function edit(string $id)
    {
        return redirect()->route('registros-medicos.index');
    }

    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('editar registros medicos')) {
            abort(403, 'No tienes permiso para actualizar este registro.');
        }
        $request->validate([
            'animal_id'     => 'required|exists:animals,id',
            'tipo_atencion' => 'required|string',
            'fecha'         => 'required|date',
            'diagnostico'   => 'nullable|string',
        ]);
        $registro = RegistroMedico::findOrFail($id);
        $registro->update([
            'animal_id'      => $request->animal_id,
            'tipo_atencion'  => $request->tipo_atencion,
            'fecha'          => $request->fecha,
            'fecha_proxima'  => Carbon::parse($request->fecha)->addMonth(),
            'diagnostico'    => $request->diagnostico,
        ]);
        return redirect()->route('registros-medicos.index')
                         ->with('success', 'Registro médico actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        if (!auth()->user()->hasRole('propietario|administrador|veterinario')) {
            abort(403, 'No tienes permiso para eliminar registros médicos.');
        }
        $registro = RegistroMedico::findOrFail($id);
        $registro->delete();
        return redirect()->route('registros-medicos.index')
                         ->with('success', 'Registro médico eliminado correctamente.');
    }
}