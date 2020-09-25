<?php

namespace App\Services\Aula;

use App\Http\Resources\Aula as AulaResource;
use Illuminate\Support\Facades\Validator;
use App\Repositories\AulaRepository;
use App\Models\Aula as Model;
use Exception;

class CreateAulaService
{
    private $model;
    private $repo;

    public function __construct(
        Model $model,
        AulaRepository $repo
    )
    {
        $this->model = $model;
        $this->repo = $repo;
    }

    public function create(Object $request)
    {
        try{
            $this->validate($request);
            return new AulaResource($this->model->create([
                'nome'              => $request->nome        ?? '',
                'descricao'         => $request->descricao   ?? '',
            ]));
        }catch(Exception $e){
            throw $e;
        }
    }

    private function validate(Object $request){
        Validator::make($request->all(),[
            'nome'          => 'required|string|max:199',
            'descricao'     => 'required|string',
        ],[
            'nome.required'                 => 'O nome é obrigatório.',
            'nome.max'                      => 'O nome excedeu 191 caracteres.',
            'nome.string'                   => 'O nome deve ser um texto.',
            'descricao.required'            => 'A descricao é obrigatória.',
            'descricao.string'              => 'A descricao deve ser um texto.',
        ])->validate();
    }
}