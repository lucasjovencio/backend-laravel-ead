<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'sobrenome'=>$this->sobrenome,
            'nome_completo'=>$this->nome_completo,
            'cpfcnpj'=>$this->cpfcnpj,
            'imagem'=>$this->url_imagem,
            'email'=>$this->email,
        ];
    }
}
