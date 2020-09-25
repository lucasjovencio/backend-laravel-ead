<?php

namespace App\Services\User;

use App\Models\User as Model;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Services\StorageService;

class UserService
{
    private $model;
    private $repo;

    public function __construct(
        Model $model,
        UserRepository $repo
    )
    {
        $this->model = $model;
        $this->repo = $repo;
    }

    public function create(Object $request)
    {
        try{
            return $this->model->create([
                'nome'              => $request->nome        ?? '',
                'sobrenome'         => $request->sobrenome   ?? '',
                'cpfcnpj'           => ($request->cpfcnpj)   ? preg_replace("/\D+/", "", $request->cpfcnpj) : '',
                'imagem'            => ($request->imagem)    ? StorageService::create("users/imagem",$request->imagem)       : '',
                'email'             => $request->email       ?? '',
                'password'          => $request->password    ?? '',
            ]);
        }catch(Exception $e){
            throw $e;
        }
    }

}