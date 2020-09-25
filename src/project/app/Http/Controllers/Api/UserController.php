<?php

namespace App\Http\Controllers\Api;

use Illuminate\Validation\ValidationException;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Services\User\CreateUserService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use JsonResponseTrait;
 
    public function store(Request $request,CreateUserService $createUserService)
    {
        try{
            return $this->jsonResponseSuccess($createUserService->create($request),201);
        }
        catch(ValidationException $e){
            return $this->jsonResponseError($e->errors(),422);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }

    public function index(Request $request,UserRepository $userRepository)
    {
        try{
            return $this->jsonResponseSuccess($userRepository->paginateUsers($request,2),200);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }

    public function show($user,UserRepository $userRepository)
    {
        try{
            return $this->jsonResponseSuccess($userRepository->showUser($user),200);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }
}
