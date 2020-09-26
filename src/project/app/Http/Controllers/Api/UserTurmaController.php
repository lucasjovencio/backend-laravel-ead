<?php

namespace App\Http\Controllers\Api;

use Illuminate\Validation\ValidationException;
use App\Repositories\UserTurmaRepository;
use App\Http\Controllers\Controller;
use App\Services\UserTurma\CreateUserTurmaService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class UserTurmaController extends Controller
{
    use JsonResponseTrait;
 
    public function store(Request $request,CreateUserTurmaService $createUserTurmaService)
    {
        try{
            return $this->jsonResponseSuccess($createUserTurmaService->create($request),201);
        }
        catch(ValidationException $e){
            return $this->jsonResponseError($e->errors(),422);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }

    public function index(Request $request,UserTurmaRepository $userTurmaRepository)
    {
        try{
            return $this->jsonResponseSuccess($userTurmaRepository->paginateUserTurmas($request),200);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }

    public function show($user,UserTurmaRepository $userTurmaRepository)
    {
        try{
            return $this->jsonResponseSuccess($userTurmaRepository->showUserTurma($user),200);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }

    public function turma($turma,UserTurmaRepository $userTurmaRepository)
    {
        try{
            return $this->jsonResponseSuccess($userTurmaRepository->showTurma($turma),200);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }
    
}
