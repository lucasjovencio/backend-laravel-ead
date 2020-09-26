<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Curso;

class Turma extends JsonResource
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
            'nome'=>$this->nome,
            'cursos_id'=>$this->cursos_id,
            'turno'=>$this->turno,
            'turno_txt'=>$this->turno_txt,
            'curso'=> new Curso($this->curso)
        ];
    }
}
