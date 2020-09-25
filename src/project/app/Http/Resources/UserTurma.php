<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTurma extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'users_id'=>$this->users_id,
            'participante'=> new User($this->participante),
            'turmas_id'=>$this->turmas_id,
            'tipo'=>$this->tipo,
            'tipo_txt'=>$this->tipo_txt,
        ];
    }
}
