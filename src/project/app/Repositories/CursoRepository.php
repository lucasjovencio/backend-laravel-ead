<?php

namespace App\Repositories;

use App\Models\Curso as Model;
use App\Http\Resources\CursoCollection as CursoCollectionResource;
use App\Http\Resources\Curso as CursoResource;

class CursoRepository
{
    private $model;
    
    public function __construct(Model $model)
    {
        $this->model=$model;
    }
   
    public function paginateCursos(Object $request,$paginate=5)
    {
        return new CursoCollectionResource($this->model->paginate($paginate));
    }

    public function showCurso(int $curso)
    {
        return new CursoResource($this->model->id($curso)->firstOrFail());
    }

}