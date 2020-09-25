<?php

namespace App\Services\UserTurma;

use App\Http\Resources\UserTurma as UserTurmaResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Repositories\UserTurmaRepository;
use App\Models\UserTurma as Model;
use Illuminate\Validation\Rule;
use Exception;

class CreateUserTurmaService
{
    private $model;
    private $repo;

    public function __construct(
        Model $model,
        UserTurmaRepository $repo
    )
    {
        $this->model = $model;
        $this->repo = $repo;
    }

    public function create(Object $request)
    {
        try{
            $this->validate($request);
            return new UserTurmaResource($this->model->create([
                'turmas_id'             => $request->turmas_id    ?? '',
                'users_id'              => $request->users_id   ?? '',
                'tipo'                  => $request->tipo   ?? '',
            ]));
        }catch(Exception $e){
            throw $e;
        }
    }

    private function validate(Object $request){
        Validator::make($request->all(),[
            'turmas_id'             => 'required|exists:turmas,id',
            'users_id'              => [
                'required',
                'exists:users,id',
                Rule::unique('user_turmas','users_id')->where(function($query){
                    $query->where('turmas_id',request()->turmas_id);
                })
            ],
            'tipo'                  => [
                'required',
                'in:1,2',
                Rule::unique('user_turmas','tipo')->where(function($query){
                    $query->where('turmas_id',request()->turmas_id)->where('tipo',2);
                })
            ],
        ],[
            'turmas_id.required'                 => 'A turma é obrigatória.',
            'turmas_id.exists'                   => 'A turma informada não existe.',
            'users_id.required'                  => 'O participante é obrigatório.',
            'users_id.exists'                    => 'O participante informado não existe.',
            'users_id.unique'                    => 'O participante já está na turma.',
            'tipo.required'                      => 'O tipo de participante é obrigatório.',
            'tipo.in'                            => 'Apenas as opções Aluno e Professor são permitidas.',
            'tipo.unique'                        => 'Apenas um professor é permitido na turma.',
        ])->validate();
    }
}