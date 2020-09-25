<?php

namespace App\Services\Turma;

use App\Http\Resources\Turma as TurmaResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Repositories\TurmaRepository;
use App\Models\Turma as Model;
use Exception;

class CreateTurmaService
{
    private $model;
    private $repo;

    public function __construct(
        Model $model,
        TurmaRepository $repo
    )
    {
        $this->model = $model;
        $this->repo = $repo;
    }

    public function create(Object $request)
    {
        try{
            $this->validate($request);
            return new TurmaResource($this->model->create([
                'nome'              => $request->nome           ?? '',
                'turno'             => $request->turno          ?? 1,
                'cursos_id'         => $request->cursos_id      ?? '',
            ]));
        }catch(Exception $e){
            throw $e;
        }
    }

    private function validate(Object $request){
        Validator::make($request->all(),[
            'nome'        => 'required|max:30',
            'cursos_id'   => 'required|exists:cursos,id',
            'turno'       => 'required|in:1,2,3',
        ],[
            'nome.required'                     => 'O nome da turma é obrigatória.',
            'nome.max'                          => 'O nome da turma excedeu 30 caracteres.',
            'cursos_id.required'                => 'O curso é obrigatório.',
            'cursos_id.exists'                  => 'O curso informado não existe.',
            'turno.required'                    => 'O curso é obrigatório.',
            'turno.in'                          => 'Apenas as opções Manhã, Tarde e Noite são permitidas.',
        ])->validate();
    }
}