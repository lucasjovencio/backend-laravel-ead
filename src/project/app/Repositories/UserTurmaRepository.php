<?php

namespace App\Repositories;

use App\Models\UserTurma as Model;
use App\Http\Resources\UserTurmaCollection as UserTurmaCollectionResource;
use App\Http\Resources\UserTurma as UserTurmaResource;

class UserTurmaRepository
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model=$model;
    }
   
    public function paginateUserTurmas(Object $request,$paginate=5)
    {
        return new UserTurmaCollectionResource($this->model->paginate($paginate));
    }

    public function showUserTurma(int $user)
    {
        return new UserTurmaResource($this->model->id($user)->firstOrFail());
    }
}