<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; flex-wrap: wrap; gap: 10px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <a href="{{ route('dashboard') }}"
                   style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; border-radius: 10px; background: #ffffff; border: 1px solid #cbd5e1; color: #475569; font-weight: 600; font-size: 13px; text-decoration: none; box-shadow: 0 1px 2px rgba(0,0,0,0.05); transition: all 0.2s;"
                   onmouseover="this.style.background='#f1f5f9'; this.style.color='#1e293b';"
                   onmouseout="this.style.background='#ffffff'; this.style.color='#475569';">
                    ← Volver al Panel
                </a>
                <h2 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0;">
                    🐄 Gestión de Animales
                </h2>
            </div>
            @can('crear animales')
            <button onclick="document.getElementById('modalCrear').style.display='flex'"
                    style="background-color: #2e7d32; color: #ffffff; font-weight: 600; padding: 10px 18px; border-radius: 12px; font-size: 14px; border: none; cursor: pointer; display: flex; align-items: center; gap: 6px;">
                ➕ Registrar Animal
            </button>
            @endcan
        </div>
    </x-slot>

    <div style="padding: 2rem 0; background-color: #f8fafc; min-height: 100vh;">
        <div style="max-width: 1280px; margin: 0 auto; padding: 0 1.5rem;">

            @if(session('success'))
                <div style="background-color: #d1fae5; color: #065f46; padding: 12px 16px; border-radius: 10px; margin-bottom: 1.5rem; font-size: 14px; font-weight: 600;">
                    {{ session('success') }}
                </div>
            @endif

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
                                <th style="padding: 14px 16px;">Especie</th>
                                <th style="padding: 14px 16px;">Peso (kg)</th>
                                <th style="padding: 14px 16px;">Edad</th>
                                <th style="padding: 14px 16px;">Fecha Compra</th>
                                <th style="padding: 14px 16px; text-align: center;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($animales as $animal)
                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                    <td style="padding: 14px 16px; font-weight: 700;">
                                        {{ $animal->numero_arete ? '#'.$animal->numero_arete : '—' }}
                                    </td>
                                    <td style="padding: 14px 16px;">{{ $animal->nombre ?? 'Sin nombre' }}</td>
                                    <td style="padding: 14px 16px;">{{ $animal->especie }}</td>
                                    <td style="padding: 14px 16px;">
                                        @if($animal->peso)
                                            <span style="font-weight: 600; color: #0f172a;">{{ $animal->peso }} kg</span>
                                        @else
                                            <span style="color: #94a3b8;">—</span>
                                        @endif
                                    </td>
                                    <td style="padding: 14px 16px;">
                                        @if($animal->fecha_nacimiento)
                                            @php
                                                $nacimiento = \Carbon\Carbon::parse($animal->fecha_nacimiento);
                                                $años = (int) $nacimiento->diffInYears(now());
                                                $meses = (int) $nacimiento->copy()->addYears($años)->diffInMonths(now());
                                            @endphp
                                            <span style="color: #0f172a;">
                                                @if($años > 0)
                                                    {{ $años }} año{{ $años != 1 ? 's' : '' }}
                                                @endif
                                                @if($meses > 0)
                                                    {{ $meses }} mes{{ $meses != 1 ? 'es' : '' }}
                                                @endif
                                                @if($años == 0 && $meses == 0)
                                                    Recién nacido
                                                @endif
                                            </span>
                                        @else
                                            <span style="color: #94a3b8;">—</span>
                                        @endif
                                    </td>
                                    <td style="padding: 14px 16px; color: #475569;">
                                        {{ $animal->fecha_compra ? \Carbon\Carbon::parse($animal->fecha_compra)->format('d/m/Y') : '—' }}
                                    </td>
                                    <td style="padding: 14px 16px; text-align: center;">
                                       <div style="display: flex; justify-content: center; gap: 8px;">
    @can('editar animales')
    <button onclick="abrirModalEditar('{{ $animal->id }}', '{{ $animal->numero_arete }}', '{{ $animal->nombre }}', '{{ $animal->especie }}', '{{ $animal->peso }}', '{{ $animal->fecha_nacimiento }}', '{{ $animal->fecha_compra }}')"
            title="Editar" style="background: #e0f2fe; color: #0284c7; border: none; padding: 6px 10px; border-radius: 8px; cursor: pointer;">
        ✏️
    </button>
    @endcan
    @can('eliminar animales')
    <button onclick="abrirModalEliminar('{{ $animal->id }}', '{{ $animal->numero_arete }}')"
            title="Eliminar" style="background: #fee2e2; color: #dc2626; border: none; padding: 6px 10px; border-radius: 8px; cursor: pointer;">
        🗑️
    </button>
    @endcan
</div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center; padding: 3rem 1rem;">
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
        <div style="background: #ffffff; width: 100%; max-width: 480px; border-radius: 20px; padding: 1.5rem; max-height: 90vh; overflow-y: auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h3 style="margin: 0; font-size: 18px; font-weight: 800; color: #0f172a;">🐄 Registrar Animal</h3>
                <button onclick="document.getElementById('modalCrear').style.display='none'" style="background: transparent; border: none; font-size: 20px; cursor: pointer;">✕</button>
            </div>
            <form method="POST" action="{{ route('animales.store') }}" style="display: flex; flex-direction: column; gap: 1rem;">
                @csrf

                {{-- 1. Especie primero --}}
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Especie</label>
                    <select name="especie" id="crear_especie" onchange="toggleArete('crear')"
                            style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                        <option value="">-- Selecciona la especie --</option>
                        <option value="Bovino">Bovino</option>
                        <option value="Equino">Equino</option>
                        <option value="Porcino">Porcino</option>
                    </select>
                </div>

                {{-- 2. Arete solo para Bovino y Porcino --}}
                <div id="crear_arete_campo" style="display: none;">
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">
                        Número de Arete <span style="color:#94a3b8; font-weight:400;">(opcional)</span>
                    </label>
                    <input type="text" name="numero_arete" id="crear_numero_arete"
                           placeholder="Ej: 07, 123..."
                           style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                </div>

                {{-- 3. Nombre --}}
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Nombre</label>
                    <input type="text" name="nombre"
                           style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">⚖️ Peso (kg)</label>
                        <input type="number" name="peso" min="0" step="0.1" placeholder="Ej: 350.5"
                               style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">🎂 Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento"
                               style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                    </div>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">🛒 Fecha de Compra</label>
                    <input type="date" name="fecha_compra"
                           style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 0.5rem;">
                    <button type="button" onclick="document.getElementById('modalCrear').style.display='none'"
                            style="padding: 10px 16px; border-radius: 10px; border: 1px solid #cbd5e1; background: #fff; cursor: pointer;">Cancelar</button>
                    <button type="submit"
                            style="padding: 10px 20px; border-radius: 10px; border: none; background: #2e7d32; color: #fff; font-weight: 700; cursor: pointer;">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Editar --}}
    <div id="modalEditar" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 50; padding: 1rem;">
        <div style="background: #ffffff; width: 100%; max-width: 480px; border-radius: 20px; padding: 1.5rem; max-height: 90vh; overflow-y: auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h3 style="margin: 0; font-size: 18px; font-weight: 800; color: #0f172a;">✏️ Editar Animal</h3>
                <button onclick="document.getElementById('modalEditar').style.display='none'" style="background: transparent; border: none; font-size: 20px; cursor: pointer;">✕</button>
            </div>
            <form id="formEditar" method="POST" action="" style="display: flex; flex-direction: column; gap: 1rem;">
                @csrf
                @method('PUT')

                {{-- 1. Especie primero --}}
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Especie</label>
                    <select id="edit_especie" name="especie" onchange="toggleArete('edit')"
                            style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                        <option value="Bovino">Bovino</option>
                        <option value="Equino">Equino</option>
                        <option value="Porcino">Porcino</option>
                    </select>
                </div>

                {{-- 2. Arete solo para Bovino y Porcino --}}
                <div id="edit_arete_campo" style="display: none;">
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">
                        Número de Arete <span style="color:#94a3b8; font-weight:400;">(opcional)</span>
                    </label>
                    <input type="text" id="edit_numero_arete" name="numero_arete"
                           style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                </div>

                {{-- 3. Nombre --}}
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Nombre</label>
                    <input type="text" id="edit_nombre" name="nombre"
                           style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">⚖️ Peso (kg)</label>
                        <input type="number" id="edit_peso" name="peso" min="0" step="0.1"
                               style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">🎂 Fecha de Nacimiento</label>
                        <input type="date" id="edit_fecha_nacimiento" name="fecha_nacimiento"
                               style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                    </div>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">🛒 Fecha de Compra</label>
                    <input type="date" id="edit_fecha_compra" name="fecha_compra"
                           style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none;">
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 0.5rem;">
                    <button type="button" onclick="document.getElementById('modalEditar').style.display='none'"
                            style="padding: 10px 16px; border-radius: 10px; border: 1px solid #cbd5e1; background: #fff; cursor: pointer;">Cancelar</button>
                    <button type="submit"
                            style="padding: 10px 20px; border-radius: 10px; border: none; background: #0284c7; color: #fff; font-weight: 700; cursor: pointer;">Actualizar</button>
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
                    <button type="button" onclick="document.getElementById('modalEliminar').style.display='none'"
                            style="padding: 10px 16px; border-radius: 10px; border: 1px solid #cbd5e1; background: #fff; cursor: pointer;">Cancelar</button>
                    <button type="submit"
                            style="padding: 10px 20px; border-radius: 10px; border: none; background: #dc2626; color: #fff; font-weight: 700; cursor: pointer;">Sí, Eliminar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleArete(modal) {
            const especie = document.getElementById(modal + '_especie').value;
            const campo = document.getElementById(modal + '_arete_campo');
            const input = document.getElementById(modal + '_numero_arete');

            if (especie === 'Bovino' || especie === 'Porcino') {
                campo.style.display = 'block';
            } else {
                campo.style.display = 'none';
                if (input) input.value = '';
            }
        }

        function abrirModalEditar(id, arete, nombre, especie, peso, fechaNacimiento, fechaCompra) {
            document.getElementById('formEditar').action = `/animales/${id}`;
            document.getElementById('edit_especie').value = especie;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_peso').value = peso;
            document.getElementById('edit_fecha_nacimiento').value = fechaNacimiento;
            document.getElementById('edit_fecha_compra').value = fechaCompra;
            toggleArete('edit');
            document.getElementById('edit_numero_arete').value = arete;
            document.getElementById('modalEditar').style.display = 'flex';
        }

        function abrirModalEliminar(id, arete) {
            document.getElementById('formEliminar').action = `/animales/${id}`;
            document.getElementById('textoEliminar').innerText = `¿Estás seguro de eliminar el animal con arete #${arete}?`;
            document.getElementById('modalEliminar').style.display = 'flex';
        }
    </script>
</x-app-layout>