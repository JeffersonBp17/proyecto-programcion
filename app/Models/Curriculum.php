<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;
    protected $table = 'curriculums';
    protected $fillable = [
        'name',
        'user_id',
        'person_id'
    ];

    // Relación con la tabla 'users' (un currículum pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con la tabla 'persons' (un currículum pertenece a una persona)
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
