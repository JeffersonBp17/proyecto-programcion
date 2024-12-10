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
                        <button type="button" id="tabEducation" onclick="showTab('education')" class="tab-button px-4 py-2 text-gray-800 hover:text-blue-600 focus:outline-none">
                            Educación
                        </button>
                        <button type="button" id="tabWorkExperience" onclick="showTab('work_experience')" class="tab-button px-4 py-2 text-gray-800 hover:text-blue-600 focus:outline-none">
                            Experiencia Laboral
                        </button>
                        <button type="button" id="tabCertifications" onclick="showTab('certifications')" class="tab-button px-4 py-2 text-gray-800 hover:text-blue-600 focus:outline-none">
                            Certificaciones
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

                            <div class="education-fields">
                                <div class="education-entry mb-4">
                                    <input type="text" name="education[0][institution]" required placeholder="Institución" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="education[0][academic_degree]" required placeholder="Título" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="education[0][location]" required placeholder="Ubicación" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="date" name="education[0][start_date]" required placeholder="Inicio" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="date" name="education[0][end_date]" required placeholder="Fin" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                </div>
                            </div>
                            <button type="button" id="addEducation" class="bg-green-500 text-white px-4 py-2 rounded-md">Agregar Otra Institución</button>
                        </div>

                        <!-- Experiencia Laboral -->
                        <div id="work_experience" class="tab-content hidden">

                            <div class="work-experience-fields">
                                <div class="work-experience-entry mb-4">
                                    <input type="text" name="work_experience[0][position]" required placeholder="Puesto" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="work_experience[0][company]" required placeholder="Empresa" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="work_experience[0][location]" required placeholder="Ubicación" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="date" name="work_experience[0][start_date]" required placeholder="Inicio" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="date" name="work_experience[0][end_date]" placeholder="Fin (opcional)" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <textarea name="work_experience[0][description]" placeholder="Descripción de responsabilidades (opcional)" class="block mb-4 border-gray-300 p-4 rounded-md w-full"></textarea>
                                </div>
                            </div>
                            <button type="button" id="addWorkExperience" class="bg-green-500 text-white px-4 py-2 rounded-md">Agregar Otra Experiencia</button>
                        </div>

                        <!-- Certificaciones -->
                        <div id="certifications" class="tab-content hidden">
                            <div class="certification-fields">
                                <div class="certification-entry mb-4">
                                    <input type="text" name="certifications[0][certification]" required placeholder="Certificación" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="certifications[0][institution]" required placeholder="Institución" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="date" name="certifications[0][obtained_date]" required placeholder="Fecha de obtención" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                </div>
                            </div>
                            <button type="button" id="addCertification" class="bg-green-500 text-white px-4 py-2 rounded-md">Agregar Otra Certificación</button>
                        </div>

                        <!-- Botones -->
                        <div class="mt-4">
                            <a href="{{ route('curriculums.index') }}">
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

        /// Agregar más campos de educación
        document.getElementById('addEducation').addEventListener('click', function() {
            const educationFields = document.querySelector('.education-fields');
            const newEntryIndex = educationFields.children.length;

            const newEntry = document.createElement('div');
            newEntry.classList.add('education-entry', 'mb-4');
            newEntry.innerHTML = `
                <input type="text" name="education[${newEntryIndex}][institution]" required placeholder="Institución" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                <input type="text" name="education[${newEntryIndex}][academic_degree]" required placeholder="Título" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                <input type="text" name="education[${newEntryIndex}][location]" required placeholder="Ubicación" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                <input type="date" name="education[${newEntryIndex}][start_date]" required placeholder="Inicio" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                <input type="date" name="education[${newEntryIndex}][end_date]" required placeholder="Fin" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
            `;
            educationFields.appendChild(newEntry);
        });

        // Agregar más campos de experiencia laboral
        document.getElementById('addWorkExperience').addEventListener('click', function() {
            const workExperienceFields = document.querySelector('.work-experience-fields');
            const newEntryIndex = workExperienceFields.children.length;

            const newEntry = document.createElement('div');
            newEntry.classList.add('work-experience-entry', 'mb-4');
            newEntry.innerHTML = `
            <input type="text" name="work_experience[${newEntryIndex}][position]" required placeholder="Puesto" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
        <input type="text" name="work_experience[${newEntryIndex}][company]" required placeholder="Empresa" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
        <input type="text" name="work_experience[${newEntryIndex}][location]" required placeholder="Ubicación" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
        <input type="date" name="work_experience[${newEntryIndex}][start_date]" required placeholder="Inicio" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
        <input type="date" name="work_experience[${newEntryIndex}][end_date]" placeholder="Fin (opcional)" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
        <textarea name="work_experience[${newEntryIndex}][description]" placeholder="Descripción de responsabilidades (opcional)" class="block mb-4 border-gray-300 p-4 rounded-md w-full"></textarea>
        `;
            workExperienceFields.appendChild(newEntry);
        });
        // Agregar más campos de certificaciones
        document.getElementById('addCertification').addEventListener('click', function() {
            const certificationFields = document.querySelector('.certification-fields');
            const newEntryIndex = certificationFields.children.length;

            const newEntry = document.createElement('div');
            newEntry.classList.add('certification-entry', 'mb-4');
            newEntry.innerHTML = `
                <input type="text" name="certifications[${newEntryIndex}][certification]" required placeholder="Certificación" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                <input type="text" name="certifications[${newEntryIndex}][institution]" required placeholder="Institución" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                <input type="date" name="certifications[${newEntryIndex}][obtained_date]" required placeholder="Fecha de obtención" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
            `;
            certificationFields.appendChild(newEntry);
        });
    </script>
</x-app-layout>