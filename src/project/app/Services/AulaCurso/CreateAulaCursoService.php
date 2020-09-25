<?php

namespace App\Services\AulaCurso;

use App\Http\Resources\AulaCurso as AulaCursoResource;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Repositories\AulaCursoRepository;
use App\Models\AulaCurso as Model;
use Illuminate\Validation\Rule;
use Exception;

class CreateAulaCursoService
{
    private $model;
    private $repo;

    public function __construct(
        Model $model,
        AulaCursoRepository $repo
    )
    {
        $this->model = $model;
        $this->repo = $repo;
    }

    public function create(Object $request)
    {
        try{
            $this->validate($request);
            return new AulaCursoResource($this->model->create([
                'aulas_id'              => $request->aulas_id    ?? '',
                'cursos_id'             => $request->cursos_id   ?? '',
            ]));
        }catch(Exception $e){
            throw $e;
        }
    }

    private function validate(Object $request){
        Validator::make($request->all(),[
            'aulas_id'          => [
                'required',
                'exists:aulas,id',
                Rule::unique('aula_cursos','aulas_id')->where(function($query){
                    $query->where('cursos_id',request()->cursos_id);
                })
            ],
            'cursos_id'         => 'required|exists:cursos,id',
        ],[
            'aulas_id.required'                 => 'A aula é obrigatória.',
            'aulas_id.exists'                   => 'A aula informada não existe.',
            'aulas_id.unique'                   => 'A aula já está registrada no curso.',
            'cursos_id.required'                => 'O curso é obrigatório.',
            'cursos_id.exists'                  => 'O curso informado não existe.',
        ])->validate();
    }
}