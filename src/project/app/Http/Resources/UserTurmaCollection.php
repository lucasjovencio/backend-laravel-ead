<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\User;
class UserTurmaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'current_page' => $this->currentPage(),
            'data' => $this->collection->map(function($item){
                    return [
                        'id'=>$item->id,
                        'users_id'=>$item->users_id,
                        'turmas_id'=>$item->turmas_id,
                        'tipo'=>$item->tipo,
                        'tipo_txt'=>$item->tipo_txt,
                        'participante'=>new User($item->participante),
                    ];
            }),
            'pagination' => [
                'first_page_url'=>$this->resolveCurrentPath(),
                'last_page'=>$this->lastPage(),
                'last_page_url'=>$this->previousPageUrl(),
                'next_page_url'=>$this->nextPageUrl(),
                'path'=>$this->path(),
                'per_page' => $this->perPage(),
                'prev_page_url'=>$this->previousPageUrl(),
                "total"=> $this->total()
            ],
        ];
    }
}
