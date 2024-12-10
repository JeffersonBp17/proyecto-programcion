<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'second_last_name',
        'phone',
        'email',
        'linkedin',
        'birth_date',
        'marital_status',
        'address',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con los registros de historial educativo
    public function educationHistories()
    {
        return $this->hasMany(EducationHistory::class);
    }

    // Relación con WorkExperience
    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class, 'person_id');
    }

    // Relacion con Certifacaciones
    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }

    /**
     * Relación con el modelo Skill.
     * Una persona puede tener muchas habilidades (skills).
     */
    public function skills()
    {
        return $this->hasMany(Skill::class, 'person_id');
    }

    public function curriculum()
    {
        return $this->hasOne(Curriculum::class, 'person_id');
    }

    public function languages()
    {
        return $this->hasMany(Language::class, 'person_id');
    }

    public function interests()
    {
        return $this->hasMany(Interest::class, 'person_id');
    }
}
