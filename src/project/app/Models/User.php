<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome','sobrenome','cpfcnpj','imagem', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'url_imagem','nome_completo'
    ];

    public function getUrlImagemAttribute()
    {
        return asset("public/".$this->imagem);
    }

    public function getNomeCompletoAttribute()
    {
        return $this->nome." ".$this->sobrenome;
    }

    public function scopeId($query,$id)
    {
        return $query->where('id',$id);
    }
}
