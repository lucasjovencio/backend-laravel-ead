<?php

namespace App\Http\Controllers\Api;

use Illuminate\Validation\ValidationException;
use App\Repositories\TurmaRepository;
use App\Http\Controllers\Controller;
use App\Services\Turma\CreateTurmaService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    use JsonResponseTrait;
 
    public function store(Request $request,CreateTurmaService $createTurmaService)
    {
        try{
            return $this->jsonResponseSuccess($createTurmaService->create($request),201);
        }
        catch(ValidationException $e){
            return $this->jsonResponseError($e->errors(),422);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }

    public function index(Request $request,TurmaRepository $turmaRepository)
    {
        try{
            return $this->jsonResponseSuccess($turmaRepository->paginateUsers($request,2),200);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }

    public function show($user,TurmaRepository $turmaRepository)
    {
        try{
            return $this->jsonResponseSuccess($turmaRepository->showUser($user),200);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }
}
