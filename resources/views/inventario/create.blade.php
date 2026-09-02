<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Agregar Item al Inventario
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                @can('gestionar inventario')
                    <form method="POST" action="{{ route('inventario.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombre"
                                   class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Cantidad</label>
                            <input type="number" name="cantidad"
                                   class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                        </div>

                        <div class="flex gap-3">
                            <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Guardar
                            </button>
                            <a href="{{ route('inventario.index') }}"
                               class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
                                Cancelar
                            </a>
                        </div>
                    </form>
                @else
                    <p class="text-red-500">No tienes permiso para agregar items.</p>
                @endcan

            </div>
        </div>
    </div>
</x-app-layout>