<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Skill;
use App\Models\Person;
use App\Models\Interest;
use App\Models\Language;
use Barryvdh\DomPDF\PDF;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Models\WorkExperience;
use App\Models\EducationHistory;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Auth;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener los currículums del usuario autenticado
        $curriculums = Auth::user()->curriculums()->with('person')->get();

        return view('curriculums.index', compact('curriculums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('curriculums.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // Validar los datos del formulario
        $validatedData = $request->validate([
            // Datos de la persona
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'second_last_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'linkedin' => 'nullable|url|max:255',
            'birth_date' => 'required|date',
            'marital_status' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            // Datos del currículum
            'cv_name' => 'required|string|max:255',
            // Validar educación como un array de registros
            'education.*.academic_degree' => 'required|string|max:255',
            'education.*.institution' => 'required|string|max:255',
            'education.*.location' => 'required|string|max:255',
            'education.*.start_date' => 'required|date',
            'education.*.end_date' => 'nullable|date',
            // Validar experiencias laborales como un array de registros
            'work_experience.*.position' => 'required|string|max:255',
            'work_experience.*.company' => 'required|string|max:255',
            'work_experience.*.location' => 'required|string|max:255',
            'work_experience.*.start_date' => 'required|date',
            'work_experience.*.end_date' => 'nullable|date',
            'work_experience.*.description' => 'nullable|string',
            // Validar ecertificaciones como un array de registros
            'certifications.*.certification' => 'required|string|max:255',
            'certifications.*.institution' => 'required|string|max:255',
            'certifications.*.obtained_date' => 'required|date',
            // Validar ecertificaciones como un array de registros
            'skills.*.skill' => 'required|string|max:255',
            'skills.*.level' => 'required|string|max:255',
            // Validación de idiomas
            'languages.*.language' => 'required|string|max:255',
            'languages.*.level' => 'required|string|max:255',
            // Validar intereses como un array de registros
            'interests.*.interest' => 'required|string|max:255',
        ]);

        // Crear la persona y guardar los datos
        $person = Person::create([
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'],
            'last_name' => $validatedData['last_name'],
            'second_last_name' => $validatedData['second_last_name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'linkedin' => $validatedData['linkedin'],
            'birth_date' => $validatedData['birth_date'],
            'marital_status' => $validatedData['marital_status'],
            'address' => $validatedData['address'],
            'user_id' => Auth::id(), // ID del usuario logueado
        ]);

        // Crear el currículum y asociarlo al usuario logueado
        $curriculum = Curriculum::create([
            'name' => $validatedData['cv_name'],
            'user_id' => Auth::id(), // ID del usuario logueado
            'person_id' => $person->id, // ID de la persona recién creada
        ]);

        // dd($validatedData['education']);


        // Guardar los registros de educación
        foreach ($validatedData['education'] as $education) {
            EducationHistory::create([
                'person_id' => $person->id,
                'academic_degree' => $education['academic_degree'],
                'institution' => $education['institution'],
                'location' => $education['location'],
                'start_date' => $education['start_date'],
                'end_date' => $education['end_date'],
            ]);
        }

        // Guardar los registros de experiencia laboral
        foreach ($validatedData['work_experience'] as $experience) {
            WorkExperience::create([
                'person_id' => $person->id,
                'position' => $experience['position'],
                'company' => $experience['company'],
                'location' => $experience['location'],
                'start_date' => $experience['start_date'],
                'end_date' => $experience['end_date'],
                'description' => $experience['description'] ?? null,
            ]);
        }

        // Guardar certificaciones
        foreach ($validatedData['certifications'] as $certification) {
            Certification::create([
                'person_id' => $person->id,
                'certification' => $certification['certification'],
                'institution' => $certification['institution'],
                'obtained_date' => $certification['obtained_date'],
            ]);
        }

        // Guardar las habilidades
        foreach ($validatedData['skills'] as $skill) {
            Skill::create([
                'person_id' => $person->id,
                'skill' => $skill['skill'],
                'level' => $skill['level'],
            ]);
        }

        // Guardar idiomas
        foreach ($validatedData['languages'] as $language) {
            Language::create([
                'person_id' => $person->id,
                'language' => $language['language'],
                'level' => $language['level'],
            ]);
        }

        // Guardar los registros de intereses
        foreach ($validatedData['interests'] as $interest) {
            Interest::create([
                'person_id' => $person->id,
                'interest' => $interest['interest'],
            ]);
        }


        // dd($education);

        // Redirigir con un mensaje de éxito
        return redirect()->route('curriculums.index')
            ->with('success', 'Currículum creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $person = Person::with([
            'curriculum',
            'educationHistories',
            'workExperiences',
            'certifications',
            'skills',
            'languages',
            'interests'
        ])->find($id);

        if ($person) {
            return view('curriculums.show', compact('person'));
        } else {
            return redirect()->route('curriculums.index')->with('error', 'Persona no encontrada');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Buscar el currículum con los datos relacionados (persona, educación, experiencia, etc.)
        $curriculum = Curriculum::with([
            'person',
            'person.educationHistories',
            'person.workExperiences',
            'person.certifications',
            'person.skills',
            'person.languages',
            'person.interests'
        ])->find($id);

        // dd($curriculum->person->educationHistories->count());
        // dd($curriculum->educationHistories);

        // Si el currículum no existe, redirigir con un mensaje de error
        if (!$curriculum) {
            return redirect()->route('curriculums.index')->with('error', 'Currículum no encontrado.');
        }

        // Pasar el currículum a la vista de edición
        return view('curriculums.edit', compact('curriculum'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            // Validación similar a la de 'store'
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'second_last_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'linkedin' => 'nullable|url|max:255',
            'birth_date' => 'required|date',
            'marital_status' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'cv_name' => 'required|string|max:255',
            'education.*.academic_degree' => 'required|string|max:255',
            'education.*.institution' => 'required|string|max:255',
            'education.*.location' => 'required|string|max:255',
            'education.*.start_date' => 'required|date',
            'education.*.end_date' => 'nullable|date',
            'work_experience.*.position' => 'required|string|max:255',
            'work_experience.*.company' => 'required|string|max:255',
            'work_experience.*.location' => 'required|string|max:255',
            'work_experience.*.start_date' => 'required|date',
            'work_experience.*.end_date' => 'nullable|date',
            'work_experience.*.description' => 'nullable|string',
            'certifications.*.certification' => 'required|string|max:255',
            'certifications.*.institution' => 'required|string|max:255',
            'certifications.*.obtained_date' => 'required|date',
            'skills.*.skill' => 'required|string|max:255',
            'skills.*.level' => 'required|string|max:255',
            'languages.*.language' => 'required|string|max:255',
            'languages.*.level' => 'required|string|max:255',
            'interests.*.interest' => 'required|string|max:255',
        ]);

        // Buscar el currículum y persona asociados al ID
        $curriculum = Curriculum::with('person')->find($id);

        if (!$curriculum) {
            return redirect()->route('curriculums.index')->with('error', 'Currículum no encontrado.');
        }

        // Actualizar los datos de la persona
        $person = $curriculum->person;
        $person->update([
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'],
            'last_name' => $validatedData['last_name'],
            'second_last_name' => $validatedData['second_last_name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'linkedin' => $validatedData['linkedin'],
            'birth_date' => $validatedData['birth_date'],
            'marital_status' => $validatedData['marital_status'],
            'address' => $validatedData['address'],
        ]);

        // Actualizar el currículum
        $curriculum->update([
            'name' => $validatedData['cv_name'],
        ]);

        // Eliminar y volver a crear los registros de educación, experiencia laboral, etc.
        // Esto es necesario porque los datos pueden haber cambiado (añadido o eliminado elementos)
        $person->educationHistories()->delete();
        foreach ($validatedData['education'] as $education) {
            EducationHistory::create([
                'person_id' => $person->id,
                'academic_degree' => $education['academic_degree'],
                'institution' => $education['institution'],
                'location' => $education['location'],
                'start_date' => $education['start_date'],
                'end_date' => $education['end_date'],
            ]);
        }

        $person->workExperiences()->delete();
        foreach ($validatedData['work_experience'] as $experience) {
            WorkExperience::create([
                'person_id' => $person->id,
                'position' => $experience['position'],
                'company' => $experience['company'],
                'location' => $experience['location'],
                'start_date' => $experience['start_date'],
                'end_date' => $experience['end_date'],
                'description' => $experience['description'] ?? null,
            ]);
        }

        $person->certifications()->delete();
        foreach ($validatedData['certifications'] as $certification) {
            Certification::create([
                'person_id' => $person->id,
                'certification' => $certification['certification'],
                'institution' => $certification['institution'],
                'obtained_date' => $certification['obtained_date'],
            ]);
        }

        $person->skills()->delete();
        foreach ($validatedData['skills'] as $skill) {
            Skill::create([
                'person_id' => $person->id,
                'skill' => $skill['skill'],
                'level' => $skill['level'],
            ]);
        }

        $person->languages()->delete();
        foreach ($validatedData['languages'] as $language) {
            Language::create([
                'person_id' => $person->id,
                'language' => $language['language'],
                'level' => $language['level'],
            ]);
        }

        $person->interests()->delete();
        foreach ($validatedData['interests'] as $interest) {
            Interest::create([
                'person_id' => $person->id,
                'interest' => $interest['interest'],
            ]);
        }

        // Redirigir con un mensaje de éxito
        return redirect()->route('curriculums.index')->with('success', 'Currículum actualizado exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el currículum por su ID
        $curriculum = Curriculum::with(['person'])->find($id);

        if (!$curriculum) {
            return redirect()->route('curriculums.index')->with('error', 'Currículum no encontrado.');
        }

        // Iniciar la transacción
        try {
            DB::beginTransaction();

            // Obtener la persona asociada al currículum
            $person = $curriculum->person;

            if ($person) {
                // Eliminar relaciones asociadas a la persona
                $person->educationHistories()->delete();
                $person->workExperiences()->delete();
                $person->certifications()->delete();
                $person->skills()->delete();
                $person->languages()->delete();
                $person->interests()->delete();

                // Eliminar la persona
                $person->delete();
            }

            // Eliminar el currículum
            $curriculum->delete();

            // Confirmar la transacción
            \DB::commit();

            return redirect()->route('curriculums.index')->with('success', 'Currículum eliminado exitosamente.');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            \DB::rollBack();

            return redirect()->route('curriculums.index')->with('error', 'Hubo un problema al eliminar el currículum.');
        }
    }

    public function generateCurriculum($id)
    {
        // Obtener los datos de la persona y sus relaciones
        $person = Person::with([
            'educationHistories',
            'workExperiences',
            'certifications',
            'skills',
            'languages',
            'interests'
        ])->findOrFail($id);

        // Cargar la vista de la persona
        $pdf = FacadePdf::loadView('curriculums.print', compact('person'));

        // Retornar el PDF generado
        return $pdf->download('curriculum_' . $person->first_name . '.pdf');
    }
}
