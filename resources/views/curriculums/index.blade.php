<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis CVs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('curriculums.create') }}"
                        class="inline-block bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 transition mb-4">
                        Crear Nuevo CV
                    </a>

                    <!-- Si hay CVs, mostrar la tabla -->
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Fecha de Creación</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Itera sobre los currículums -->
                            @foreach ($curriculums as $curriculum)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ $curriculum->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $curriculum->created_at->format('Y-m-d') }}</td>
                                <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                                    <a href="{{ route('curriculums.show', $curriculum->person->id) }}"
                                        class="text-blue-500 hover:underline">Ver</a>
                                    <a href="{{ route('curriculums.edit', $curriculum->id) }}"
                                        class="text-green-500 hover:underline">Editar</a>
                                    <form action="{{ route('curriculums.destroy', $curriculum->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:underline">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Si no hay CVs, mostrar mensaje -->
                    @if($curriculums->isEmpty())
                    <p class="text-gray-600 text-center mt-4">No tienes CVs creados aún.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>