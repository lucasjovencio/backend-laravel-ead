<?php

namespace App\Repositories;

use App\Models\Aula as Model;

class AulaRepository
{
    private $model;
    
    public function __construct(Model $model)
    {
        $this->model=$model;
    }
   
}