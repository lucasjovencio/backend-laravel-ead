<?php

namespace App\Http\Controllers\Api;

use App\Services\AulaCurso\CreateAulaCursoService;
use Illuminate\Validation\ValidationException;
use App\Repositories\AulaCursoRepository;
use App\Http\Controllers\Controller;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class AulaCursoController extends Controller
{
    use JsonResponseTrait;
    
    public function store(Request $request,CreateAulaCursoService $createAulaCursoService)
    {
        try{
            return $this->jsonResponseSuccess($createAulaCursoService->create($request),201);
        }
        catch(ValidationException $e){
            return $this->jsonResponseError($e->errors(),422);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }

    public function index(Request $request,AulaCursoRepository $aulaCursoRepository)
    {
        try{
            return $this->jsonResponseSuccess($aulaCursoRepository->paginateAulaCursos($request),200);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }

    public function show($aulaCurso,AulaCursoRepository $aulaCursoRepository)
    {
        try{
            return $this->jsonResponseSuccess($aulaCursoRepository->showAulaCurso($aulaCurso),200);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }
}
