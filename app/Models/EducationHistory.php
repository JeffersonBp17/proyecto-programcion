<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationHistory extends Model
{
    use HasFactory;
    protected $table = 'education_histories';
    protected $fillable = [
        'person_id',
        'academic_degree',
        'institution',
        'location',
        'start_date',
        'end_date',
    ];

    // Relaciones
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
