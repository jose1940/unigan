<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <h2 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0;">
                🐄 Gestión de Animales
            </h2>
            
            <button onclick="document.getElementById('modalCrear').style.display='flex'" 
                    style="background-color: #2e7d32; color: #ffffff; font-weight: 600; padding: 10px 18px; border-radius: 12px; font-size: 14px; border: none; cursor: pointer; display: flex; align-items: center; gap: 6px;">
                ➕ Registrar Animal
            </button>
        </div>
    </x-slot>

    <div style="padding: 2rem 0; background-color: #f8fafc; min-height: 100vh;">
        <div style="max-width: 1280px; margin: 0 auto; padding: 0 1.5rem;">

            <div style="background: #ffffff; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden;">
                <div style="padding: 1.25rem; border-bottom: 1px solid #f1f5f9;">
                    <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0;">Listado General del Ganado</h3>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                        <thead>
                            <tr style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">
                                <th style="padding: 14px 16px;">Número / Arete</th>
                                <th style="padding: 14px 16px;">Nombre</th>
                                <th style="padding: 14px 16px;">Especie / Raza</th>
                                <th style="padding: 14px 16px; text-align: center;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($animales as $animal)
                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                    <td style="padding: 14px 16px; font-weight: 700;">#{{ $animal->numero_arete }}</td>
                                    <td style="padding: 14px 16px;">{{ $animal->nombre ?? 'Sin nombre' }}</td>
                                    <td style="padding: 14px 16px;">{{ $animal->especie }}</td>
                                    <td style="padding: 14px 16px; text-align: center; display: flex; justify-content: center; gap: 8px;">
                                        
                                        {{-- Botón Editar --}}
                                        <button onclick="abrirModalEditar('{{ $animal->id }}', '{{ $animal->numero_arete }}', '{{ $animal->nombre }}', '{{ $animal->especie }}')" 
                                                title="Editar" style="background: #e0f2fe; color: #0284c7; border: none; padding: 6px 10px; border-radius: 8px; cursor: pointer;">
                                            ✏️
                                        </button>

                                        {{-- Botón Eliminar --}}
                                        <button onclick="abrirModalEliminar('{{ $animal->id }}', '{{ $animal->numero_arete }}')" 
                                                title="Eliminar" style="background: #fee2e2; color: #dc2626; border: none; padding: 6px 10px; border-radius: 8px; cursor: pointer;">
                                            🗑️
                                        </button>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 3rem 1rem; color: #94a3b8;">
                                        <p style="font-size: 15px; font-weight: 700; color: #475569; margin: 0;">No hay animales registrados aún.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- Modal Crear --}}
    <div id="modalCrear" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 50; padding: 1rem;">
        <div style="background: #ffffff; width: 100%; max-width: 480px; border-radius: 20px; padding: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h3 style="margin: 0; font-size: 18px; font-weight: 800; color: #0f172a;">🐄 Registrar Animal</h3>
                <button onclick="document.getElementById('modalCrear').style.display='none'" style="background: transparent; border: none; font-size: 20px; cursor: pointer;">✕</button>
            </div>
            <form method="POST" action="{{ route('animales.store') }}" style="display: flex; flex-direction: column; gap: 1rem;">
                @csrf
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Número de Arete</label>
                    <input type="text" name="numero_arete" required style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Nombre</label>
                    <input type="text" name="nombre" style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Especie</label>
                    <select name="especie" style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                        <option value="Bovino">Bovino</option>
                        <option value="Equino">Equino</option>
                        <option value="Porcino">Porcino</option>
                    </select>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 0.5rem;">
                    <button type="button" onclick="document.getElementById('modalCrear').style.display='none'" style="padding: 10px 16px; border-radius: 10px; border: 1px solid #cbd5e1; background: #fff; cursor: pointer;">Cancelar</button>
                    <button type="submit" style="padding: 10px 20px; border-radius: 10px; border: none; background: #2e7d32; color: #fff; font-weight: 700; cursor: pointer;">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Editar --}}
    <div id="modalEditar" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 50; padding: 1rem;">
        <div style="background: #ffffff; width: 100%; max-width: 480px; border-radius: 20px; padding: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h3 style="margin: 0; font-size: 18px; font-weight: 800; color: #0f172a;">✏️ Editar Animal</h3>
                <button onclick="document.getElementById('modalEditar').style.display='none'" style="background: transparent; border: none; font-size: 20px; cursor: pointer;">✕</button>
            </div>
            <form id="formEditar" method="POST" action="" style="display: flex; flex-direction: column; gap: 1rem;">
                @csrf
                @method('PUT')
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Número de Arete</label>
                    <input type="text" id="edit_numero_arete" name="numero_arete" required style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Nombre</label>
                    <input type="text" id="edit_nombre" name="nombre" style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Especie</label>
                    <select id="edit_especie" name="especie" style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                        <option value="Bovino">Bovino</option>
                        <option value="Equino">Equino</option>
                        <option value="Porcino">Porcino</option>
                    </select>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 0.5rem;">
                    <button type="button" onclick="document.getElementById('modalEditar').style.display='none'" style="padding: 10px 16px; border-radius: 10px; border: 1px solid #cbd5e1; background: #fff; cursor: pointer;">Cancelar</button>
                    <button type="submit" style="padding: 10px 20px; border-radius: 10px; border: none; background: #0284c7; color: #fff; font-weight: 700; cursor: pointer;">Actualizar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Eliminar --}}
    <div id="modalEliminar" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 50; padding: 1rem;">
        <div style="background: #ffffff; width: 100%; max-width: 400px; border-radius: 20px; padding: 1.5rem; text-align: center;">
            <div style="font-size: 40px; margin-bottom: 10px;">⚠️</div>
            <h3 style="margin: 0 0 8px; font-size: 18px; font-weight: 800; color: #0f172a;">¿Eliminar este animal?</h3>
            <p style="font-size: 13px; color: #64748b; margin: 0 0 1.5rem;" id="textoEliminar">Esta acción no se puede deshacer.</p>
            
            <form id="formEliminar" method="POST" action="">
                @csrf
                @method('DELETE')
                <div style="display: flex; justify-content: center; gap: 10px;">
                    <button type="button" onclick="document.getElementById('modalEliminar').style.display='none'" style="padding: 10px 16px; border-radius: 10px; border: 1px solid #cbd5e1; background: #fff; cursor: pointer;">Cancelar</button>
                    <button type="submit" style="padding: 10px 20px; border-radius: 10px; border: none; background: #dc2626; color: #fff; font-weight: 700; cursor: pointer;">Sí, Eliminar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script JavaScript --}}
    <script>
        function abrirModalEditar(id, arete, nombre, especie) {
            document.getElementById('formEditar').action = `/animales/${id}`;
            document.getElementById('edit_numero_arete').value = arete;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_especie').value = especie;
            document.getElementById('modalEditar').style.display = 'flex';
        }

        function abrirModalEliminar(id, arete) {
            document.getElementById('formEliminar').action = `/animales/${id}`;
            document.getElementById('textoEliminar').innerText = `¿Estás segura de eliminar el animal con arete #${arete}?`;
            document.getElementById('modalEliminar').style.display = 'flex';
        }
    </script>
</x-app-layout>