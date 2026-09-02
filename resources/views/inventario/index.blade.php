<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <h2 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0; display: flex; align-items: center; gap: 8px;">
                📦 Inventario General
            </h2>
            
            <button onclick="document.getElementById('modalInventario').style.display='flex'" 
                    style="background-color: #2e7d32; color: #ffffff; font-weight: 600; padding: 10px 18px; border-radius: 12px; font-size: 14px; border: none; cursor: pointer; display: flex; align-items: center; gap: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                ➕ Agregar Ítem
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
                <div style="background: #ffffff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; align-items: center; gap: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="width: 50px; height: 50px; border-radius: 12px; background-color: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                        📦
                    </div>
                    <div>
                        <p style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; margin: 0; letter-spacing: 0.5px;">Total Productos</p>
                        <p style="font-size: 22px; font-weight: 900; color: #0f172a; margin: 2px 0 0;">{{ $inventarios->count() ?? 0 }}</p>
                    </div>
                </div>

                <div style="background: #ffffff; padding: 1.25rem; border-radius: 16px; border: 1px solid #f1f5f9; display: flex; align-items: center; gap: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="width: 50px; height: 50px; border-radius: 12px; background-color: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                        ⚠️
                    </div>
                    <div>
                        <p style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; margin: 0; letter-spacing: 0.5px;">Stock Bajo</p>
                        <p style="font-size: 22px; font-weight: 900; color: #0f172a; margin: 2px 0 0;">0 ítems</p>
                    </div>
                </div>
            </div>

            <div style="background: #ffffff; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden;">
                <div style="padding: 1.25rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0;">Listado de Productos en Insumos</h3>
                    <div style="position: relative; width: 100%; max-width: 320px;">
                        <input type="text" placeholder="🔍 Buscar producto..." 
                               style="width: 100%; box-sizing: border-box; padding: 8px 14px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 13px; outline: none;">
                    </div>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                        <thead>
                            <tr style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">
                                <th style="padding: 14px 16px;">Nombre del Ítem</th>
                                <th style="padding: 14px 16px;">Cantidad</th>
                                <th style="padding: 14px 16px; text-align: center;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($inventarios as $item)
                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                    <td style="padding: 14px 16px; font-weight: 600; color: #0f172a;">{{ $item->nombre }}</td>
                                    <td style="padding: 14px 16px;">{{ $item->cantidad }}</td>
                                    <td style="padding: 14px 16px;">
                                        <div style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                                            {{-- Editar --}}
                                            <button type="button" 
                                                    onclick="abrirModalEditar({{ $item->id }}, '{{ addslashes($item->nombre) }}', {{ $item->cantidad }})"
                                                    style="width: 32px; height: 32px; border-radius: 8px; background-color: #dbeafe; color: #2563eb; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center;"
                                                    title="Editar">
                                                ✏️
                                            </button>

                                            {{-- Eliminar --}}
                                            <button type="button" 
                                                    onclick="abrirModalEliminar({{ $item->id }}, '{{ addslashes($item->nombre) }}')"
                                                    style="width: 32px; height: 32px; border-radius: 8px; background-color: #ffe4e6; color: #e11d48; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center;"
                                                    title="Eliminar">
                                                🗑️
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" style="text-align: center; padding: 40px 16px;">
                                        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px;">
                                            <div style="font-size: 48px; opacity: 0.8;">📦</div>
                                            <p style="margin: 0; font-size: 14px; font-weight: 600; color: #64748b;">
                                                No hay ítems registrados aún.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


    <div id="modalInventario" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.5); align-items: center; justify-content: center; z-index: 50; padding: 1rem;">
        <div style="background: #ffffff; width: 100%; max-width: 450px; border-radius: 20px; padding: 1.5rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h3 style="margin: 0; font-size: 18px; font-weight: 800; color: #0f172a;">📦 Agregar al Inventario</h3>
                <button onclick="document.getElementById('modalInventario').style.display='none'" 
                        style="background: transparent; border: none; font-size: 20px; cursor: pointer; color: #64748b;">✕</button>
            </div>

            <form method="POST" action="{{ route('inventario.store') }}" style="display: flex; flex-direction: column; gap: 1rem;">
                @csrf
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Nombre del Ítem</label>
                    <input type="text" name="nombre" required placeholder="Ej: Vacuna Aftosa, Alimento Concentrado" style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;">
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Cantidad</label>
                    <input type="number" name="cantidad" min="0" required placeholder="0" style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;">
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 0.5rem;">
                    <button type="button" onclick="document.getElementById('modalInventario').style.display='none'" 
                            style="padding: 10px 16px; border-radius: 10px; border: 1px solid #cbd5e1; background: #fff; font-weight: 600; cursor: pointer; color: #475569;">Cancelar</button>
                    <button type="submit" 
                            style="padding: 10px 20px; border-radius: 10px; border: none; background: #2e7d32; color: #fff; font-weight: 700; cursor: pointer;">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalEditar" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.5); align-items: center; justify-content: center; z-index: 50; padding: 1rem;">
        <div style="background: #ffffff; width: 100%; max-width: 450px; border-radius: 20px; padding: 1.5rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                <h3 style="margin: 0; font-size: 18px; font-weight: 800; color: #0f172a;">✏️ Editar Ítem</h3>
                <button onclick="document.getElementById('modalEditar').style.display='none'" 
                        style="background: transparent; border: none; font-size: 20px; cursor: pointer; color: #64748b;">✕</button>
            </div>

            <form id="formEditar" method="POST" action="" style="display: flex; flex-direction: column; gap: 1rem;">
                @csrf
                @method('PUT')
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Nombre del Ítem</label>
                    <input type="text" id="edit_nombre" name="nombre" required style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;">
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Cantidad</label>
                    <input type="number" id="edit_cantidad" name="cantidad" min="0" required style="width: 100%; box-sizing: border-box; padding: 10px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 14px; outline: none;">
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 0.5rem;">
                    <button type="button" onclick="document.getElementById('modalEditar').style.display='none'" 
                            style="padding: 10px 16px; border-radius: 10px; border: 1px solid #cbd5e1; background: #fff; font-weight: 600; cursor: pointer; color: #475569;">Cancelar</button>
                    <button type="submit" 
                            style="padding: 10px 20px; border-radius: 10px; border: none; background: #2563eb; color: #fff; font-weight: 700; cursor: pointer;">Actualizar</button>
                </div>
            </form>
        </div>
    </div>

  
    <div id="modalEliminar" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.5); align-items: center; justify-content: center; z-index: 50; padding: 1rem;">
        <div style="background: #ffffff; width: 100%; max-width: 420px; border-radius: 20px; padding: 1.5rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2); text-align: center;">
            <div style="width: 56px; height: 56px; border-radius: 50%; background-color: #ffe4e6; color: #e11d48; display: flex; align-items: center; justify-content: center; font-size: 28px; margin: 0 auto 1rem;">
                ⚠️
            </div>

            <h3 style="margin: 0 0 0.5rem; font-size: 18px; font-weight: 800; color: #0f172a;">¿Eliminar este ítem?</h3>
            <p style="margin: 0 0 1.5rem; font-size: 14px; color: #64748b;">
                Vas a eliminar <strong id="delete_nombre" style="color: #0f172a;"></strong>. Esta acción no se puede deshacer.
            </p>

            <form id="formEliminar" method="POST" action="">
                @csrf
                @method('DELETE')
                <div style="display: flex; justify-content: center; gap: 10px;">
                    <button type="button" onclick="document.getElementById('modalEliminar').style.display='none'" 
                            style="padding: 10px 18px; border-radius: 10px; border: 1px solid #cbd5e1; background: #fff; font-weight: 600; cursor: pointer; color: #475569; font-size: 14px;">
                        Cancelar
                    </button>
                    <button type="submit" 
                            style="padding: 10px 20px; border-radius: 10px; border: none; background: #e11d48; color: #fff; font-weight: 700; cursor: pointer; font-size: 14px;">
                        Sí, eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function abrirModalEditar(id, nombre, cantidad) {
            document.getElementById('formEditar').action = '/inventario/' + id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_cantidad').value = cantidad;
            document.getElementById('modalEditar').style.display = 'flex';
        }

        function abrirModalEliminar(id, nombre) {
            document.getElementById('formEliminar').action = '/inventario/' + id;
            document.getElementById('delete_nombre').textContent = nombre;
            document.getElementById('modalEliminar').style.display = 'flex';
        }
    </script>
</x-app-layout>