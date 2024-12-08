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
                            <!-- Datos hardcodeados de ejemplo -->
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">Juan Pérez</td>
                                <td class="border border-gray-300 px-4 py-2">2024-12-07</td>
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
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">Ana García</td>
                                <td class="border border-gray-300 px-4 py-2">2024-12-05</td>
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
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">Carlos Martínez</td>
                                <td class="border border-gray-300 px-4 py-2">2024-12-01</td>
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
                        </tbody>
                    </table>

                    <!-- Si no hay CVs, mostrar mensaje -->
                    <p class="text-gray-600 text-center mt-4">No tienes CVs creados aún.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>