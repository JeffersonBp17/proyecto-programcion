<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $table = 'certificationS';

    protected $fillable = [
        'person_id',
        'certification',
        'institution',
        'obtained_date',
    ];

    /**
     * Relación con la tabla Person.
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
