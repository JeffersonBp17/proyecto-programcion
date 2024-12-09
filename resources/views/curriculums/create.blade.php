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
                        <button type="button" id="tabCv" onclick="showTab('cv')" class="tab-button px-4 py-2 text-gray-800 hover:text-blue-600 focus:outline-none">
                            CV
                        </button>
                        <button type="button" id="tabPersonal" onclick="showTab('personal')" class="tab-button px-4 py-2 text-gray-800 hover:text-blue-600 focus:outline-none">
                            Datos Personales
                        </button>
                        <!-- <button type="button" id="tabAddress" onclick="showTab('address')" class="tab-button px-4 py-2 text-gray-800 hover:text-blue-600 focus:outline-none">
                            Dirección
                        </button> -->
                        <button type="button" id="tabEducation" onclick="showTab('education')" class="tab-button px-4 py-2 text-gray-800 hover:text-blue-600 focus:outline-none">
                            Educación
                        </button>
                    </div>

                    <!-- Formulario con datos -->
                    <form action="{{ route('curriculums.store') }}" method="POST">
                        @csrf

                        <!-- CV -->
                        <div id="cv" class="tab-content hidden">

                            <input type="text" name="cv_name" value="Curriculum 2024" required placeholder="Nombre del curriculum" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                        </div>

                        <!-- Datos Personales -->
                        <div id="personal" class="tab-content hidden">


                            <!-- Primer Nombre -->
                            <input type="text" name="first_name" required placeholder="Primer Nombre"
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Segundo Nombre -->
                            <input type="text" name="middle_name" placeholder="Segundo Nombre (opcional)"
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Primer Apellido -->
                            <input type="text" name="last_name" required placeholder="Primer Apellido"
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Segundo Apellido -->
                            <input type="text" name="second_last_name" required placeholder="Segundo Apellido"
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Teléfono -->
                            <input type="tel" name="phone" required placeholder="Número de Teléfono"
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Correo Electrónico -->
                            <input type="email" name="email" required placeholder="Correo Electrónico"
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- LinkedIn -->
                            <input type="url" name="linkedin" placeholder="Perfil de LinkedIn (opcional)"
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Fecha de Nacimiento -->
                            <label for="birth_date" class="block text-gray-700 mb-2">Fecha de Nacimiento</label>
                            <input type="date" name="birth_date" id="birth_date" required
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Estado Civil -->
                            <label for="marital_status" class="block text-gray-700 mb-2">Estado Civil</label>
                            <input type="text" name="marital_status" id="marital_status" required
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Dirección -->
                            <label for="address" class="block text-gray-700 mb-2">Dirección</label>
                            <input type="text" name="address" id="address" required
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                        </div>

                        <!-- Educación -->
                        <div id="education" class="tab-content hidden">
                            <h3 class="font-semibold text-xl">Educación</h3>
                            <div class="education-fields">
                                <div class="education-entry mb-4">
                                    <input type="text" name="school[]" value="Liceo Santa Cruz" required placeholder="Institución" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="degree[]" value="Bachillerato" required placeholder="Título" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                </div>
                            </div>
                            <button type="button" id="addEducation" class="bg-green-500 text-white px-4 py-2 rounded-md">Agregar Otra Institución</button>
                        </div>

                        <!-- Botones -->
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
        // Mostrar el tab activo y actualizar estilos
        function showTab(tab) {
            // Ocultar todas las secciones
            document.querySelectorAll('.tab-content').forEach(section => {
                section.classList.add('hidden');
            });

            // Mostrar la sección seleccionada
            document.getElementById(tab).classList.remove('hidden');

            // Actualizar estilos de las pestañas
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('text-blue-600');
                button.classList.add('text-gray-800');
            });

            const activeButton = document.getElementById('tab' + tab.charAt(0).toUpperCase() + tab.slice(1));
            activeButton.classList.remove('text-gray-800');
            activeButton.classList.add('text-blue-600');
        }

        // Mostrar el primer tab por defecto
        window.onload = function() {
            showTab('cv');
        };

        // Agregar más campos de educación
        // document.getElementById('addEducation').addEventListener('click', function() {
        //     const newEntry = document.createElement('div');
        //     newEntry.classList.add('education-entry', 'mb-4');
        //     newEntry.innerHTML = `
        //         <input type="text" name="school[]" required placeholder="Institución" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
        //         <input type="text" name="degree[]" required placeholder="Título" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
        //     `;
        //     document.querySelector('.education-fields').appendChild(newEntry);
        // });
    </script>
</x-app-layout>