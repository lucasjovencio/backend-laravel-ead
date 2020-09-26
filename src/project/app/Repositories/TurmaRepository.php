<?php

namespace App\Repositories;

use App\Models\Turma as Model;
use App\Http\Resources\TurmaCollection as TurmaCollectionResource;
use App\Http\Resources\Turma as TurmaResource;

class TurmaRepository
{
    private $model;
    
    public function __construct(Model $model)
    {
        $this->model=$model;
    }
   
    public function paginateTurmas(Object $request,$paginate=5)
    {
        return new TurmaCollectionResource($this->model->with('curso')->paginate($paginate));
    }

    public function showTurma(int $turma)
    {
        return new TurmaResource($this->model->id($turma)->with('curso')->firstOrFail());
    }

}