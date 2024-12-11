<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar CV') }}
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
                        <button type="button" id="tabSkills" onclick="showTab('skills')" class="tab-button px-4 py-2 text-gray-800 hover:text-blue-600 focus:outline-none">
                            Skills
                        </button>
                        <button type="button" id="tabLanguages" onclick="showTab('languages')" class="tab-button px-4 py-2 text-gray-800 hover:text-blue-600 focus:outline-none">
                            Idiomas
                        </button>
                        <button type="button" id="tabInterests" onclick="showTab('interests')" class="tab-button px-4 py-2 text-gray-800 hover:text-blue-600 focus:outline-none">
                            Intereses
                        </button>

                    </div>

                    <!-- Formulario con datos -->
                    <form action="{{ route('curriculums.update', $curriculum->id) }}" method="POST" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- CV -->
                        <div id="cv" class="tab-content hidden">

                            <input type="text" name="cv_name" value="{{ old('cv_name', $curriculum->name) }}" required placeholder="Nombre del curriculum" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                        </div>

                        <!-- Datos Personales -->
                        <div id="personal" class="tab-content hidden">


                            <!-- Primer Nombre -->
                            <input type="text" name="first_name" value="{{ old('first_name', $curriculum->person->first_name) }}" required placeholder="Primer Nombre"
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Segundo Nombre -->
                            <input type="text" name="middle_name" value="{{ old('middle_name', $curriculum->person->middle_name) }}" required placeholder="Segundo Nombre (opcional)"
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Primer Apellido -->
                            <input type="text" name="last_name" value="{{ old('last_name', $curriculum->person->last_name) }}" required placeholder="Primer Apellido"
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Segundo Apellido -->
                            <input type="text" name="second_last_name" value="{{ old('second_last_name', $curriculum->person->second_last_name) }}" required placeholder="Segundo Apellido"
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Teléfono -->
                            <input type="tel" name="phone" value="{{ old('phone', $curriculum->person->phone) }}" required placeholder="Número de Teléfono"
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Correo Electrónico -->
                            <input type="email" name="email" value="{{ old('email', $curriculum->person->email) }}" required placeholder="Correo Electrónico"
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- LinkedIn -->
                            <input type="url" name="linkedin" value="{{ old('linkedin', $curriculum->person->linkedin) }}" placeholder="Perfil de LinkedIn (opcional)"
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Fecha de Nacimiento -->
                            <label for="birth_date" class="block text-gray-700 mb-2">Fecha de Nacimiento</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date', $curriculum->person->birth_date) }}" id="birth_date" required
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Estado Civil -->
                            <label for="marital_status" class="block text-gray-700 mb-2">Estado Civil</label>
                            <input type="text" name="marital_status" value="{{ old('marital_status', $curriculum->person->marital_status) }}" id="marital_status" required
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                            <!-- Dirección -->
                            <label for="address" class="block text-gray-700 mb-2">Dirección</label>
                            <input type="text" name="address" value="{{ old('address', $curriculum->person->address) }}" id="address" required
                                class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                        </div>

                        <!-- Educación -->
                        <div id="education" class="tab-content hidden">
                            @if( $curriculum->person->educationHistories->count() > 0)
                            <div class="education-fields">
                                @foreach ($curriculum->person->educationHistories as $index => $education)
                                <div class="education-entry mb-4">
                                    <input type="text" name="education[{{ $index }}][institution]"
                                        value="{{ old('education.' . $index . '.institution', $education->institution) }}"
                                        required placeholder="Institución" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="education[{{ $index }}][academic_degree]"
                                        value="{{ old('education.' . $index . '.academic_degree', $education->academic_degree) }}"
                                        required placeholder="Título" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="education[{{ $index }}][location]"
                                        value="{{ old('education.' . $index . '.location', $education->location) }}"
                                        required placeholder="Ubicación" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="date" name="education[{{ $index }}][start_date]"
                                        value="{{ old('education.' . $index . '.start_date', is_string($education->start_date) ? \Carbon\Carbon::parse($education->start_date)->format('Y-m-d') : $education->start_date->format('Y-m-d')) }}"
                                        required placeholder="Inicio" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="date" name="education[{{ $index }}][end_date]"
                                        value="{{ old('education.' . $index . '.end_date', is_string($education->end_date) ? \Carbon\Carbon::parse($education->end_date)->format('Y-m-d') : $education->end_date->format('Y-m-d')) }}"
                                        required placeholder="Fin" class="block mb-4 border-gray-300 p-4 rounded-md w-full">

                                </div>
                                @endforeach
                            </div>
                            @else
                            <p>No hay historial educativo disponible.</p>
                            @endif

                            <button type="button" id="addEducation" class="bg-green-500 text-white px-4 py-2 rounded-md">Agregar Otra Institución</button>
                        </div>

                        <!-- Experiencia Laboral -->
                        <div id="work_experience" class="tab-content hidden">
                            @if( $curriculum->person->workExperiences->count() > 0)
                            <div class="work-experience-fields">
                                @foreach ($curriculum->person->workExperiences as $index => $workExperience)
                                <div class="work-experience-entry mb-4">
                                    <input type="text" name="work_experience[{{ $index }}][position]"
                                        value="{{ old('work_experience.' . $index . '.position', $workExperience->position) }}"
                                        required placeholder="Puesto" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="work_experience[{{ $index }}][company]"
                                        value="{{ old('work_experience.' . $index . '.company', $workExperience->company) }}"
                                        required placeholder="Empresa" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="work_experience[{{ $index }}][location]"
                                        value="{{ old('work_experience.' . $index . '.location', $workExperience->location) }}"
                                        required placeholder="Ubicación" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="date" name="work_experience[{{ $index }}][start_date]"
                                        value="{{ old('work_experience.' . $index . '.start_date', is_string($workExperience->start_date) ? \Carbon\Carbon::parse($workExperience->start_date)->format('Y-m-d') : $workExperience->start_date->format('Y-m-d')) }}"
                                        required placeholder="Inicio" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="date" name="work_experience[{{ $index }}][end_date]"
                                        value="{{ old('work_experience.' . $index . '.end_date', is_string($workExperience->end_date) ? \Carbon\Carbon::parse($workExperience->end_date)->format('Y-m-d') : $workExperience->end_date->format('Y-m-d')) }}"
                                        placeholder="Fin (opcional)" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <textarea name="work_experience[{{ $index }}][description]"
                                        placeholder="Descripción de responsabilidades (opcional)"
                                        class="block mb-4 border-gray-300 p-4 rounded-md w-full">{{ old('work_experience.' . $index . '.description', $workExperience->description) }}</textarea>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p>No hay experiencia laboral disponible.</p>
                            @endif

                            <button type="button" id="addWorkExperience" class="bg-green-500 text-white px-4 py-2 rounded-md">Agregar Otra Experiencia</button>
                        </div>

                        <!-- Certificaciones -->
                        <div id="certifications" class="tab-content hidden">
                            @if( $curriculum->person->certifications->count() > 0)
                            <div class="certification-fields">
                                @foreach ($curriculum->person->certifications as $index => $certification)
                                <div class="certification-entry mb-4">
                                    <input type="text" name="certifications[{{ $index }}][certification]"
                                        value="{{ old('certifications.' . $index . '.certification', $certification->certification) }}"
                                        required placeholder="Certificación" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="certifications[{{ $index }}][institution]"
                                        value="{{ old('certifications.' . $index . '.institution', $certification->institution) }}"
                                        required placeholder="Institución" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="date" name="certifications[{{ $index }}][obtained_date]"
                                        value="{{ old('certifications.' . $index . '.obtained_date', is_string($certification->obtained_date) ? \Carbon\Carbon::parse($certification->obtained_date)->format('Y-m-d') : $certification->obtained_date->format('Y-m-d')) }}"
                                        required placeholder="Fecha de obtención" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p>No hay certificaciones disponibles.</p>
                            @endif

                            <button type="button" id="addCertification" class="bg-green-500 text-white px-4 py-2 rounded-md">Agregar Otra Certificación</button>
                        </div>

                        <!-- Habilidades -->
                        <div id="skills" class="tab-content hidden">
                            @if( $curriculum->person->skills->count() > 0)
                            <div class="skills-fields">
                                @foreach ($curriculum->person->skills as $index => $skill)
                                <div class="skill-entry mb-4">
                                    <input type="text" name="skills[{{ $index }}][skill]"
                                        value="{{ old('skills.' . $index . '.skill', $skill->skill) }}"
                                        required placeholder="Habilidad" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="skills[{{ $index }}][level]"
                                        value="{{ old('skills.' . $index . '.level', $skill->level) }}"
                                        required placeholder="Nivel" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p>No hay habilidades disponibles.</p>
                            @endif

                            <button type="button" id="addSkill" class="bg-green-500 text-white px-4 py-2 rounded-md">Agregar Otra Habilidad</button>
                        </div>

                        <!-- Idiomas -->
                        <div id="languages" class="tab-content hidden">
                            @if( $curriculum->person->languages->count() > 0)
                            <div class="languages-fields">
                                @foreach ($curriculum->person->languages as $index => $language)
                                <div class="languages-entry mb-4">
                                    <input type="text" name="languages[{{ $index }}][language]"
                                        value="{{ old('languages.' . $index . '.language', $language->language) }}"
                                        required placeholder="Idioma" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                    <input type="text" name="languages[{{ $index }}][level]"
                                        value="{{ old('languages.' . $index . '.level', $language->level) }}"
                                        required placeholder="Nivel" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p>No hay idiomas disponibles.</p>
                            @endif

                            <button type="button" id="addLanguage" class="bg-green-500 text-white px-4 py-2 rounded-md">Agregar Otro Idioma</button>
                        </div>

                        <!-- Intereses -->
                        <div id="interests" class="tab-content hidden">
                            @if( $curriculum->person->interests->count() > 0)
                            <div class="interest-fields">
                                @foreach ($curriculum->person->interests as $index => $interest)
                                <div class="interest-entry mb-4">
                                    <input type="text" name="interests[{{ $index }}][interest]"
                                        value="{{ old('interests.' . $index . '.interest', $interest->interest) }}"
                                        required placeholder="Interés" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p>No hay intereses disponibles.</p>
                            @endif

                            <button type="button" id="addInterest" class="bg-green-500 text-white px-4 py-2 rounded-md">Agregar Otro Interés</button>
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
        // Agregar más campos de certificaciones
        document.getElementById('addSkill').addEventListener('click', function() {
            const skillsFields = document.querySelector('.skills-fields');
            const newSkillEntry = document.createElement('div');
            newSkillEntry.classList.add('skill-entry', 'mb-4');
            newSkillEntry.innerHTML = `
        <input type="text" name="skills[${skillsFields.children.length}][skill]" required placeholder="Habilidad" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
        <input type="text" name="skills[${skillsFields.children.length}][level]" required placeholder="Nivel" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
    `;
            skillsFields.appendChild(newSkillEntry);
        });
        /// Agregar más campos para idiomas
        document.getElementById('addLanguage').addEventListener('click', function() {
            const languagesFields = document.querySelector('.languages-fields');
            const newEntryIndex = languagesFields.children.length;

            const newEntry = document.createElement('div');
            newEntry.classList.add('languages-entry', 'mb-4');
            newEntry.innerHTML = `
            <input type="text" name="languages[${newEntryIndex}][language]" required placeholder="Idioma" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
            <input type="text" name="languages[${newEntryIndex}][level]" required placeholder="Nivel" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
        `;
            languagesFields.appendChild(newEntry);
        });

        // Agregar más campos de intereses
        document.getElementById('addInterest').addEventListener('click', function() {
            const interestFields = document.querySelector('.interest-fields');
            const newEntryIndex = interestFields.children.length;

            const newEntry = document.createElement('div');
            newEntry.classList.add('interest-entry', 'mb-4');

            newEntry.innerHTML = `
        <input type="text" name="interests[${newEntryIndex}][interest]" required placeholder="Interés" class="block mb-4 border-gray-300 p-4 rounded-md w-full">
    `;
            interestFields.appendChild(newEntry);
        });
    </script>
</x-app-layout>