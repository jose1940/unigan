<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Usuarios
        </h2>
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
                                    @role('propietario')
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