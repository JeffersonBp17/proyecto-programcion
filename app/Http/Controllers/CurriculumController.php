<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use App\Models\WorkExperience;
use App\Models\EducationHistory;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
