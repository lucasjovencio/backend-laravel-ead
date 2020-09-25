<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTurma extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'turmas_id','users_id','tipo'
    ];

    protected $appends = [
        'tipo_txt'
    ];

    public function scopeId($query,$id)
    {
        return $query->where('id',$id);
    }

    public function scopeAlunoId($query,$id)
    {
        return $query->where('users_id',$id);
    }

    public function scopeTurmaId($query,$id)
    {
        return $query->where('turmas_id',$id);
    }

    public function getTipoTxtAttribute()
    {
        switch ($this->tipo) {
            case 1:
                return 'Aluno';
            case 2:
                return 'Professor';
            default:
                return 'Indefinido';
        }
    }
    
    public function participante()
    {
        return $this->belongsTo(\App\Models\User::class,'users_id')->withTrashed();
    }
}
