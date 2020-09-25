<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Turma extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cursos_id','turno','nome'
    ];

    protected $appends = [
        'turno_txt'
    ];

    public function scopeId($query,$id)
    {
        return $query->where('id',$id);
    }

    public function getTurnoTxtAttribute()
    {
        switch ($this->turno) {
            case 1:
                return 'Manhã';
            case 2:
                return 'Tarde';
            case 3: 
                return 'Noite';
            default:
                return 'Indefinido';
        }
    }
}
