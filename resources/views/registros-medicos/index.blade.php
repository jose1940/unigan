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
                <h2 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0; display: flex; align-items: center; gap: 8px;">
                    🩺 Registros Médicos y Salud Animal
                </h2>
            </div>
            @role('veterinario')
            <button onclick="document.getElementById('modalRegistro').style.display='flex'"
                    style="background-color: #2e7d32; color: #ffffff; font-weight: 600; padding: 10px 18px; border-radius: 12px; font-size: 14px; border: none; cursor: pointer; display: flex; align-items: center; gap: 6px;">
                ➕ Nuevo Registro Médico
            </button>
            @endrole
        </div>
    </x-slot>

    <div style="padding: 2rem 0; background-color: #f8fafc; min-height: 100vh;">
        <div style="max-width: 1280px; margin: 0 auto; padding: 0 1.5rem;">

            @if(session('success'))
                <div style="background-color: #d1fae5; color: #065f46; padding: 12px 16px; border-radius: 10px; margin-bottom: 1.5rem; font-size: 14px; font-weight: 600;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; margin-bottom: 1.5rem;">
                <div style="background: #ffffff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 50px; height: 50px; border-radius: 12px; background-color: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                        🩺
                    </div>
                    <div>
                        <p style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; margin: 0;">Total Atenciones</p>
                        <p style="font-size: 22px; font-weight: 900; color: #0f172a; margin: 2px 0 0;">{{ $registros->count() ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div style="background: #ffffff; border-radius: 16px; border: 1px solid #f1f5f9; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <div style="padding: 1.25rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0;">Historial de Atenciones</h3>
                    <div style="position: relative; width: 100%; max-width: 320px;">
                        <form action="{{ route('registros-medicos.index') }}" method="GET" style="margin: 0;">
                            <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="🔍 Buscar registro médico..."
                                   style="width: 100%; box-sizing: border-box; padding: 8px 14px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 13px; outline: none;">
                        </form>
                    </div>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                        <thead>
                            <tr style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">
                                <th style="padding: 14px 16px;">Fecha</th>
                                <th style="padding: 14px 16px;">Próxima Atención</th>
                                <th style="padding: 14px 16px;">Animal</th>
                                <th style="padding: 14px 16px;">Tipo Atención</th>
                                <th style="padding: 14px 16px;">Diagnóstico / Tratamiento</th>
                                <th style="padding: 14px 16px;">Atendido Por</th>
                                @role('veterinario')
                                <th style="padding: 14px 16px; text-align: center;">Acción</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($registros as $registro)
                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                    <td style="padding: 14px 16px;">{{ $registro->fecha }}</td>
                                    <td style="padding: 14px 16px;">
                                        @if($registro->fecha_proxima)
                                            <span style="background:#d1fae5; color:#065f46; padding:3px 8px; border-radius:6px; font-size:12px; font-weight:600;">
                                                {{ $registro->fecha_proxima }}
                                            </span>
                                        @else
                                            <span style="color:#94a3b8;">N/A</span>
                                        @endif
                                    </td>
                                    <td style="padding: 14px 16px; font-weight: 700; color: #0f172a;">
                                        #{{ $registro->animal->numero_arete ?? $registro->animal_id }}
                                    </td>
                                    <td style="padding: 14px 16px;">{{ $registro->tipo_atencion }}</td>
                                    <td style="padding: 14px 16px;">{{ $registro->diagnostico ?? 'N/A' }}</td>
                                    <td style="padding: 14px 16px;">{{ $registro->atendido_por }}</td>
                                    @role('veterinario')
                                    <td style="padding: 14px 16px;">
                                        <div style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                            <button type="button"
                                                    onclick="abrirModalEditar({{ $registro->id }}, '{{ $registro->animal_id }}', '{{ $registro->tipo_atencion }}', '{{ $registro->fecha }}', '{{ $registro->fecha_proxima ?? '' }}', '{{ addslashes($registro->diagnostico) }}')"
                                                    style="width: 32px; height: 32px; border-radius: 8px; background-color: #dbeafe; color: #2563eb; border: none; cursor: pointer;">
                                                ✏️
                                            </button>
                                            <button type="button"
                                                    onclick="abrirModalEliminar({{ $registro->id }}, 'el registro médico del arete #{{ $registro->animal->numero_arete ?? $registro->animal_id }}')"
                                                    style="width: 32px; height: 32px; border-radius: 8px; background-color: #ffe4e6; color: #e11d48; border: none; cursor: pointer;">
                                                🗑️
                                            </button>
                                        </div>
                                    </td>
                                    @endrole
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center; padding: 40px 16px;">
                                        <div style="font-size: 48px; opacity: 0.8;">📋</div>
                                        <p style="margin: 0; font-size: 14px; font-weight: 600; color: #64748b;">No hay registros médicos guardados.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Agregar --}}
    @role('veterinario')
    <div id="modalRegistro" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 50; padding: 1rem;">
        <div style="background: #ffffff; width: 100%; max-width: 520px; border-radius: 20px; padding: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h3 style="margin: 0; font-size: 18px; font-weight: 800; color: #0f172a;">🩺 Nueva Atención Médica</h3>
                <button onclick="document.getElementById('modalRegistro').style.display='none'"
                        style="background: transparent; border: none; font-size: 20px; cursor: pointer; color: #64748b;">✕</button>
            </div>
            <form method="POST" action="{{ route('registros-medicos.store') }}" style="display: flex; flex-direction: column; gap: 1rem;">
                @csrf
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Seleccionar Animal (Arete)</label>
                    <select name="animal_id" required style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;">
                        <option value="">-- Selecciona el animal --</option>
                        @foreach($animales as $animal)
                            <option value="{{ $animal->id }}">
                                🐄 Arete #{{ $animal->numero_arete }} {{ !empty($animal->nombre) ? '- '.$animal->nombre : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Tipo de Atención</label>
                        <select name="tipo_atencion" style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;">
                            <option value="Consulta General">Consulta General</option>
                            <option value="Vacunación">Vacunación</option>
                            <option value="Desparasitación">Desparasitación</option>
                            <option value="Tratamiento">Tratamiento</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Fecha</label>
                        <input type="date" name="fecha" id="fecha" value="{{ date('Y-m-d') }}" required
                               style="width: 100%; box-sizing: border-box; padding: 9px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;">
                    </div>
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">📅 Próxima Atención</label>
                    <input type="date" name="fecha_proxima" id="fecha_proxima_valor"
                           style="width: 100%; box-sizing: border-box; padding: 9px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;">
                    <p style="font-size: 11px; color: #94a3b8; margin: 4px 0 0;">Opcional — elige la fecha que necesites</p>
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Diagnóstico / Observaciones</label>
                    <textarea name="diagnostico" rows="3" placeholder="Escribe el estado del animal o tratamiento recetado..."
                              style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;"></textarea>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 0.5rem;">
                    <button type="button" onclick="document.getElementById('modalRegistro').style.display='none'"
                            style="padding: 10px 16px; border-radius: 10px; border: 1px solid #cbd5e1; background: #fff; font-weight: 600; cursor: pointer; color: #475569;">Cancelar</button>
                    <button type="submit"
                            style="padding: 10px 20px; border-radius: 10px; border: none; background: #2e7d32; color: #fff; font-weight: 700; cursor: pointer;">Guardar Registro</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Editar --}}
    <div id="modalEditar" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 50; padding: 1rem;">
        <div style="background: #ffffff; width: 100%; max-width: 520px; border-radius: 20px; padding: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h3 style="margin: 0; font-size: 18px; font-weight: 800; color: #0f172a;">✏️ Editar Registro Médico</h3>
                <button onclick="document.getElementById('modalEditar').style.display='none'"
                        style="background: transparent; border: none; font-size: 20px; cursor: pointer; color: #64748b;">✕</button>
            </div>
            <form id="formEditar" method="POST" action="" style="display: flex; flex-direction: column; gap: 1rem;">
                @csrf
                @method('PUT')
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Seleccionar Animal (Arete)</label>
                    <select id="edit_animal_id" name="animal_id" required style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;">
                        @foreach($animales as $animal)
                            <option value="{{ $animal->id }}">
                                🐄 Arete #{{ $animal->numero_arete }} {{ !empty($animal->nombre) ? '- '.$animal->nombre : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Tipo de Atención</label>
                        <select id="edit_tipo_atencion" name="tipo_atencion" style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;">
                            <option value="Consulta General">Consulta General</option>
                            <option value="Vacunación">Vacunación</option>
                            <option value="Desparasitación">Desparasitación</option>
                            <option value="Tratamiento">Tratamiento</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Fecha</label>
                        <input type="date" id="edit_fecha" name="fecha" required
                               style="width: 100%; box-sizing: border-box; padding: 9px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;">
                    </div>
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">📅 Próxima Atención</label>
                    <input type="date" id="edit_fecha_proxima_valor" name="fecha_proxima"
                           style="width: 100%; box-sizing: border-box; padding: 9px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Diagnóstico / Observaciones</label>
                    <textarea id="edit_diagnostico" name="diagnostico" rows="3"
                              style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;"></textarea>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 0.5rem;">
                    <button type="button" onclick="document.getElementById('modalEditar').style.display='none'"
                            style="padding: 10px 16px; border-radius: 10px; border: 1px solid #cbd5e1; background: #fff; font-weight: 600; cursor: pointer; color: #475569;">Cancelar</button>
                    <button type="submit"
                            style="padding: 10px 20px; border-radius: 10px; border: none; background: #2563eb; color: #fff; font-weight: 700; cursor: pointer;">Actualizar Registro</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Eliminar --}}
    <div id="modalEliminar" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); align-items: center; justify-content: center; z-index: 50; padding: 1rem;">
        <div style="background: #ffffff; width: 100%; max-width: 440px; border-radius: 24px; padding: 2.25rem 1.5rem 1.75rem; text-align: center;">
            <div style="font-size: 48px; margin-bottom: 1rem;">⚠️</div>
            <h3 style="margin: 0 0 0.5rem; font-size: 20px; font-weight: 800; color: #0f172a;">¿Eliminar este ítem?</h3>
            <p style="margin: 0 0 1.75rem; font-size: 14px; color: #64748b;">
                Vas a eliminar <strong id="nombreItemEliminar" style="color: #0f172a;"></strong>. Esta acción no se puede deshacer.
            </p>
            <form id="formEliminar" method="POST" action="" style="display: flex; justify-content: center; gap: 12px;">
                @csrf
                @method('DELETE')
                <button type="button" onclick="cerrarModalEliminar()"
                        style="flex: 1; padding: 10px 18px; border-radius: 12px; border: 1px solid #e2e8f0; background: #ffffff; color: #475569; font-weight: 600; cursor: pointer;">
                    Cancelar
                </button>
                <button type="submit"
                        style="flex: 1; padding: 10px 18px; border-radius: 12px; border: none; background: #e11d48; color: #ffffff; font-weight: 700; cursor: pointer;">
                    Sí, eliminar
                </button>
            </form>
        </div>
    </div>
    @endrole

    <script>
        function abrirModalEditar(id, animalId, tipoAtencion, fecha, fechaProxima, diagnostico) {
            document.getElementById('formEditar').action = '/registros-medicos/' + id;
            document.getElementById('edit_animal_id').value = animalId;
            document.getElementById('edit_tipo_atencion').value = tipoAtencion;
            document.getElementById('edit_fecha').value = fecha;
            document.getElementById('edit_fecha_proxima_valor').value = fechaProxima;
            document.getElementById('edit_diagnostico').value = diagnostico;
            document.getElementById('modalEditar').style.display = 'flex';
        }

        function abrirModalEliminar(id, nombreItem) {
            document.getElementById('formEliminar').action = '/registros-medicos/' + id;
            document.getElementById('nombreItemEliminar').innerText = nombreItem;
            document.getElementById('modalEliminar').style.display = 'flex';
        }

        function cerrarModalEliminar() {
            document.getElementById('modalEliminar').style.display = 'none';
        }
    </script>

</x-app-layout>