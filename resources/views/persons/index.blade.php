<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Personas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold text-gray-800 mb-4">Mis Personas</h1>

                    <a href="#"
                        class="inline-block bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 transition mb-4">
                        Crear Nueva Persona
                    </a>

                    @if ($persons->isEmpty())
                    <p class="text-gray-600 text-center">No tienes personas registradas.</p>
                    @else
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Apellido</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($persons as $person)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ $person->first_name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $person->last_name }}</td>
                                <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                                    <a href="#"
                                        class="text-blue-500 hover:underline">Ver</a>
                                    <a href="#"
                                        class="text-green-500 hover:underline">Editar</a>
                                    <form action="#" method="POST">
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>