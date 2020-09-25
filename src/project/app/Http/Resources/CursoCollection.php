<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CursoCollection extends ResourceCollection
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
                        'nome'=>$item->nome,
                        'descricao'=>$item->descricao,
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
