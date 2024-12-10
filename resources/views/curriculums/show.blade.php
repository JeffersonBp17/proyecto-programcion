<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Currículo de ') }} {{ $person->first_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Información básica de la persona -->
                    <div class="mb-6">
                        <h3 class="text-2xl font-semibold text-gray-700">Detalles del Currículo</h3>
                        <div class="mt-4">
                            <p><strong class="text-gray-600">Nombre:</strong> {{ $person->first_name }}</p>
                            <p><strong class="text-gray-600">Segundo nombre:</strong> {{ $person->middle_name }}</p>
                            <p><strong class="text-gray-600">Primer apellido:</strong> {{ $person->last_name }}</p>
                            <p><strong class="text-gray-600">Segundo apellido:</strong> {{ $person->second_last_name }}</p>
                            <p><strong class="text-gray-600">Télefono:</strong> {{ $person->phone }}</p>
                            <p><strong class="text-gray-600">Correo:</strong> {{ $person->email }}</p>
                            <p><strong class="text-gray-600">Linkedin:</strong> {{ $person->linkedin }}</p>
                            <p><strong class="text-gray-600">Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($person->birth_date)->format('d/m/Y') }}</p>
                            <p><strong class="text-gray-600">Estado civil:</strong> {{ $person->marital_status }}</p>
                            <p><strong class="text-gray-600">Direccion:</strong> {{ $person->address }}</p>
                        </div>
                    </div>

                    <!-- Sección de Educación -->
                    <div class="mb-6">
                        <h4 class="text-xl font-semibold text-gray-700">Educación</h4>
                        @forelse ($person->educationHistories as $education)
                        <div class="mt-2">
                            <p><strong class="text-gray-600">{{ $education->academic_degree }}</strong> en {{ $education->institution }} desde {{ \Carbon\Carbon::parse($person->start_date)->format('d/m/Y') }} hasta {{ \Carbon\Carbon::parse($person->end_date)->format('d/m/Y') }}, {{ $education->location }}</p>
                        </div>
                        @empty
                        <p class="text-gray-500">No se ha registrado información de educación.</p>
                        @endforelse
                    </div>

                    <!-- Sección de Experiencia Laboral -->
                    <div class="mb-6">
                        <h4 class="text-xl font-semibold text-gray-700">Experiencia Laboral</h4>
                        @forelse ($person->workExperiences as $experience)
                        <div class="mt-2">
                            <p><strong class="text-gray-600">{{ $experience->position }}</strong> en {{ $experience->company }} desde {{ \Carbon\Carbon::parse($experience->start_date)->format('d/m/Y') }} hasta {{ \Carbon\Carbon::parse($experience->end_date)->format('d/m/Y') }}</p>
                            <p class="text-gray-600">{{ $experience->description }}</p>
                        </div>
                        @empty
                        <p class="text-gray-500">No se ha registrado experiencia laboral.</p>
                        @endforelse
                    </div>

                    <!-- Sección de Certificaciones -->
                    <div class="mb-6">
                        <h4 class="text-xl font-semibold text-gray-700">Certificaciones</h4>
                        @forelse ($person->certifications as $certification)
                        <div class="mt-2">
                            <p> <strong class="text-gray-600">
                                    {{ $certification->certification }}</strong> en {{ $education->institution }} el {{ \Carbon\Carbon::parse($person->obtained_date)->format('d/m/Y') }}
                            </p>
                        </div>
                        @empty
                        <p class="text-gray-500">No se han registrado certificaciones.</p>
                        @endforelse
                    </div>

                    <!-- Sección de Habilidades -->
                    <div class="mb-6">
                        <h4 class="text-xl font-semibold text-gray-700">Habilidades</h4>
                        @forelse ($person->skills as $skill)
                        <div class="mt-2">
                            <p class="text-gray-600">{{ $skill->skill }} • {{ $skill->level }}</p>
                        </div>
                        @empty
                        <p class="text-gray-500">No se han registrado habilidades.</p>
                        @endforelse
                    </div>

                    <!-- Sección de Idiomas -->
                    <div class="mb-6">
                        <h4 class="text-xl font-semibold text-gray-700">Idiomas</h4>
                        @forelse ($person->languages as $language)
                        <div class="mt-2">
                            <p class="text-gray-600">{{ $language->language }} • {{ $language->level }}</p>
                        </div>
                        @empty
                        <p class="text-gray-500">No se han registrado idiomas.</p>
                        @endforelse
                    </div>

                    <!-- Sección de Intereses -->
                    <div class="mb-6">
                        <h4 class="text-xl font-semibold text-gray-700">Intereses</h4>
                        @forelse ($person->interests as $interest)
                        <div class="mt-2">
                            <p class="text-gray-600">{{ $interest->interest }}</p>
                        </div>
                        @empty
                        <p class="text-gray-500">No se han registrado intereses.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>