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
}
