<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AulaCurso extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'aulas_id','cursos_id',
    ];
}
