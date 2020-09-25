<?php

namespace App\Repositories;

use App\Models\User as Model;
use App\Http\Resources\UserCollection as UserCollectionResource;
use App\Http\Resources\User as UserResource;
class UserRepository
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model=$model;
    }
   
    public function paginateUsers(Object $request,$paginate=5)
    {
        return new UserCollectionResource($this->model->paginate($paginate));
    }

    public function showUser(int $user)
    {
        return new UserResource($this->model->id($user)->firstOrFail());
    }
}