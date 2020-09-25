<?php

namespace App\Repositories;

use App\Models\AulaCurso as Model;
use App\Http\Resources\AulaCurso as AulaCursoResource;
use App\Http\Resources\AulaCursoCollection as AulaCursoCollectionResource;

class AulaCursoRepository
{
    private $model;
    
    public function __construct(Model $model)
    {
        $this->model=$model;
    }
   
    public function paginateAulaCursos(Object $request,$paginate=5)
    {
        return new AulaCursoCollectionResource($this->model->paginate($paginate));
    }

    public function showAulaCurso(int $curso)
    {
        return new AulaCursoResource($this->model->id($curso)->firstOrFail());
    }

}