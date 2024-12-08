<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear CV') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Botones de pestañas -->
                    <div class="flex mb-4">
                        <button type="button" id="tabPersonal" onclick="showTab('personal')" class="tab-button px-4 py-2 bg-blue-500 text-blue-800 rounded-l-md focus:outline-none">
                            Datos Personales
                        </button>
                        <button type="button" id="tabAddress" onclick="showTab('address')" class="tab-button px-4 py-2 bg-gray-200 text-gray-800 hover:bg-gray-300 focus:outline-none">
                            Dirección
                        </button>
                        <button type="button" id="tabEducation" onclick="showTab('education')" class="tab-button px-4 py-2 bg-gray-200 text-gray-800 hover:bg-gray-300 rounded-r-md focus:outline-none">
                            Educación
                        </button>
                    </div>

                    <!-- Formulario con datos hardcodeados -->
                    <form action="#" method="POST">
                        @csrf
                        <!-- Datos Personales -->
                        <div id="personal" class="tab-content">
                            <h3 class="font-semibold text-xl">Datos Personales</h3>
                            <!-- Campos de datos personales -->
                            <input type="text" name="first_name" value="Juan" required placeholder="Primer Nombre" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                            <input type="text" name="last_name" value="Pérez" required placeholder="Apellido" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                            <!-- Otros campos personales -->
                        </div>

                        <!-- Dirección -->
                        <div id="address" class="tab-content hidden">
                            <h3 class="font-semibold text-xl">Dirección</h3>
                            <!-- Campos de dirección -->
                            <input type="text" name="address_line" value="Calle Falsa 123" required placeholder="Dirección" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                            <input type="text" name="city" value="San José" required placeholder="Ciudad" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                            <!-- Otros campos de dirección -->
                        </div>

                        <!-- Educación -->
                        <div id="education" class="tab-content hidden">
                            <h3 class="font-semibold text-xl">Educación</h3>
                            <!-- Campos de educación -->
                            <div class="education-fields">
                                <div class="education-entry mb-4">
                                    <input type="text" name="school[]" value="Liceo Santa Cruz" required placeholder="Institución" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="degree[]" value="Bachillerato" required placeholder="Título" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="year[]" value="2023" required placeholder="Año de Estudio" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                </div>
                                <div class="education-entry mb-4">
                                    <input type="text" name="school[]" value="Liceo Bilingüe" required placeholder="Institución" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="degree[]" value="Bachillerato" required placeholder="Título" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="year[]" value="2024" required placeholder="Año de Estudio" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                </div>
                            </div>
                            <button type="button" id="addEducation" class="bg-green-500 text-white px-4 py-2 rounded-md">Agregar Otra Institución</button>
                        </div>

                        <!-- Botones para cancelar y enviar -->
                        <div class="mt-4">
                            <a href="{{ route('dashboard') }}">
                                <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">Cancelar</button>
                            </a>

                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para mostrar el panel seleccionado
        function showTab(tab) {
            // Esconde todas las secciones
            document.querySelectorAll('.tab-content').forEach(function(section) {
                section.classList.add('hidden');
            });

            // Muestra la sección seleccionada
            document.getElementById(tab).classList.remove('hidden');

            // Resalta el botón de la pestaña activa
            document.querySelectorAll('.tab-button').forEach(function(button) {
                button.classList.remove('bg-blue-500', 'text-white', 'text-blue-800');
                button.classList.add('bg-gray-200', 'text-gray-800');
            });

            // Cambia el color del texto a azul para el botón activo
            const activeButton = document.getElementById('tab' + tab.charAt(0).toUpperCase() + tab.slice(1));
            activeButton.classList.add('bg-blue-500', 'text-blue-800');
        }

        // Agregar más campos de educación
        document.getElementById('addEducation').addEventListener('click', function() {
            const newEntry = document.createElement('div');
            newEntry.classList.add('education-entry', 'mb-4');
            newEntry.innerHTML = `
                <input type="text" name="school[]" required placeholder="Institución" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                <input type="text" name="degree[]" required placeholder="Título" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                <input type="text" name="year[]" required placeholder="Año de Estudio" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
            `;
            document.querySelector('.education-fields').appendChild(newEntry);
        });

        // Botón de cancelar (redirigir o limpiar formulario)
        document.getElementById('cancelButton').addEventListener('click', function() {
            // Puedes redirigir a otra página o limpiar el formulario
            window.location.href = '/'; // Redirige a la página de inicio o cualquier otra ruta
        });

        // Mostrar el primer tab por defecto al cargar la página
        window.onload = function() {
            showTab('personal');
        };
    </script>
</x-app-layout>