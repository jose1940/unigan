<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <h2 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0; display: flex; align-items: center; gap: 8px;">
                🩺 Registros Médicos y Salud Animal
            </h2>
            <button onclick="document.getElementById('modalRegistro').style.display='flex'"
                    style="background-color: #2e7d32; color: #ffffff; font-weight: 600; padding: 10px 18px; border-radius: 12px; font-size: 14px; border: none; cursor: pointer; display: flex; align-items: center; gap: 6px;">
                ➕ Nuevo Registro Médico
            </button>
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

            <div style="background: #ffffff; border-radius: 16px; border: 1px solid #f1f5f9; overflow: hidden;">
                <div style="padding: 1.25rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0;">Historial Clínico Sanitario</h3>
                    <input type="text" placeholder="🔍 Buscar por arete o diagnóstico..."
                           style="width: 100%; max-width: 320px; padding: 8px 14px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 13px; outline: none;">
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
                                <th style="padding: 14px 16px; text-align: center;">Acción</th>
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
                                    <td style="padding: 14px 16px;">
                                        <div style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                            @can('editar registros medicos')
                                                <button type="button"
                                                        onclick="abrirModalEditar({{ $registro->id }}, '{{ $registro->animal_id }}', '{{ $registro->tipo_atencion }}', '{{ $registro->fecha }}', '{{ addslashes($registro->diagnostico) }}')"
                                                        style="width: 32px; height: 32px; border-radius: 8px; background-color: #dbeafe; color: #2563eb; border: none; cursor: pointer;">
                                                    ✏️
                                                </button>
                                            @endcan
                                            @hasrole('propietario|administrador|veterinario')
                                                <button type="button"
                                                        onclick="abrirModalEliminar({{ $registro->id }}, 'el registro médico del arete #{{ $registro->animal->numero_arete ?? $registro->animal_id }}')"
                                                        style="width: 32px; height: 32px; border-radius: 8px; background-color: #ffe4e6; color: #e11d48; border: none; cursor: pointer;">
                                                    🗑️
                                                </button>
                                            @endhasrole
                                        </div>
                                    </td>
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

    {{-- Modal Nuevo Registro --}}
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
                               onchange="calcularFechaProxima(this.value, 'fecha_proxima_texto', 'fecha_proxima_valor')"
                               style="width: 100%; box-sizing: border-box; padding: 9px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;">
                    </div>
                </div>

                {{-- 👇 CLAVE: input hidden que envía la fecha al servidor --}}
                <div style="font-size: 12px; color: #64748b;">
                    Próxima atención estimada: <strong id="fecha_proxima_texto" style="color:#0f172a;">--</strong>
                    <input type="hidden" name="fecha_proxima" id="fecha_proxima_valor">
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
                               onchange="calcularFechaProxima(this.value, 'edit_fecha_proxima_texto', 'edit_fecha_proxima_valor')"
                               style="width: 100%; box-sizing: border-box; padding: 9px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;">
                    </div>
                </div>

                {{-- 👇 CLAVE: input hidden que envía la fecha al servidor --}}
                <div style="font-size: 12px; color: #64748b;">
                    Próxima atención estimada: <strong id="edit_fecha_proxima_texto" style="color:#0f172a;">--</strong>
                    <input type="hidden" name="fecha_proxima" id="edit_fecha_proxima_valor">
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

    <script>
        function calcularFechaProxima(fechaValor, idTexto, idHidden) {
            if (!fechaValor) return;
            const [year, month, day] = fechaValor.split('-').map(Number);
            const fecha = new Date(year, month - 1, day);
            fecha.setMonth(fecha.getMonth() + 1);
            const yyyy = fecha.getFullYear();
            const mm = String(fecha.getMonth() + 1).padStart(2, '0');
            const dd = String(fecha.getDate()).padStart(2, '0');
            const fechaFormateada = `${yyyy}-${mm}-${dd}`;
            document.getElementById(idTexto).innerText = fechaFormateada;
            document.getElementById(idHidden).value = fechaFormateada;
        }

        function abrirModalEditar(id, animalId, tipoAtencion, fecha, diagnostico) {
            document.getElementById('formEditar').action = '/registros-medicos/' + id;
            document.getElementById('edit_animal_id').value = animalId;
            document.getElementById('edit_tipo_atencion').value = tipoAtencion;
            document.getElementById('edit_fecha').value = fecha;
            document.getElementById('edit_diagnostico').value = diagnostico;
            calcularFechaProxima(fecha, 'edit_fecha_proxima_texto', 'edit_fecha_proxima_valor');
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

        // Calcular fecha próxima al cargar el modal
        document.getElementById('fecha').dispatchEvent(new Event('change'));
    </script>

</x-app-layout>