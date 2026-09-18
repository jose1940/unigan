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
                    👥 Gestión de Usuarios
                </h2>
            </div>
            @can('gestionar usuarios')
            <a href="{{ route('usuarios.create') }}"
               style="background-color: #2e7d32; color: #ffffff; font-weight: 600; padding: 10px 18px; border-radius: 12px; font-size: 14px; text-decoration: none; display: flex; align-items: center; gap: 6px;">
                ➕ Nuevo Usuario
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @can('gestionar usuarios')
                <a href="{{ route('usuarios.create') }}"
                   class="mb-4 inline-block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                    + Nuevo Usuario
                </a>
            @endcan

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($usuarios ?? [] as $usuario)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $usuario->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $usuario->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $usuario->getRoleNames()->first() ?? 'Sin rol' }}
                                </td>
                                <td class="px-6 py-4 text-sm flex gap-2">
                                    @can('gestionar usuarios')
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                           class="text-blue-600 hover:underline">Editar</a>
                                    @endcan
                                    @role('super_admin')
                                        <form method="POST" action="{{ route('usuarios.destroy', $usuario->id) }}">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:underline"
                                                    onclick="return confirm('¿Eliminar usuario?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    @endrole
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-500" colspan="4">
                                    No hay usuarios registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>