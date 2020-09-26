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
    
    public function scopeId($query,$id)
    {
        return $query->where('id',$id);
    }

    public function scopeAula($query,$id)
    {
        return $query->where('aulas_id',$id);
    }

    public function scopeCurso($query,$id)
    {
        return $query->where('cursos_id',$id);
    }

    public function aula()
    {
        return $this->belongsTo(\App\Models\Aula::class,'aulas_id')->withTrashed();
    }
}
