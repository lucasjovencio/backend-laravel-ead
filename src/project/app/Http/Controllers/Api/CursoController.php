<?php

namespace App\Http\Controllers\Api;

use Illuminate\Validation\ValidationException;
use App\Repositories\CursoRepository;
use App\Http\Controllers\Controller;
use App\Services\Curso\CreateCursoService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    use JsonResponseTrait;
    
    public function store(Request $request,CreateCursoService $createCursoService)
    {
        try{
            return $this->jsonResponseSuccess($createCursoService->create($request),201);
        }
        catch(ValidationException $e){
            return $this->jsonResponseError($e->errors(),422);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }

    public function index(Request $request,CursoRepository $cursoRepository)
    {
        try{
            return $this->jsonResponseSuccess($cursoRepository->paginateCursos($request,2),200);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }

    public function show($curso,CursoRepository $cursoRepository)
    {
        try{
            return $this->jsonResponseSuccess($cursoRepository->showCurso($curso),200);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }
}
