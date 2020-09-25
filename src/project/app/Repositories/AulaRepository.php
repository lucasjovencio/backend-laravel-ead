<?php

namespace App\Repositories;

use App\Models\Aula as Model;
use App\Http\Resources\AulaCollection as AulaCollectionResource;
use App\Http\Resources\Aula as AulaResource;

class AulaRepository
{
    private $model;
    
    public function __construct(Model $model)
    {
        $this->model=$model;
    }
   
    public function paginateAulas(Object $request,$paginate=5)
    {
        return new AulaCollectionResource($this->model->paginate($paginate));
    }

    public function showAula(int $aula)
    {
        return new AulaResource($this->model->id($aula)->firstOrFail());
    }

}