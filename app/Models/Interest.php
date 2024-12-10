<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;
    protected $table = 'interests';
    protected $fillable = ['person_id', 'interest'];
    // Relación con la tabla person
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
