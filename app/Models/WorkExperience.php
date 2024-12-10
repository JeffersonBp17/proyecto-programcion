<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;

    protected $table = 'work_experience';

    protected $fillable = [
        'person_id',
        'position',
        'company',
        'location',
        'start_date',
        'end_date',
        'description',
    ];

    // Relaciones si aplican
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }
}
