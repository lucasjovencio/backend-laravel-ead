<?php

namespace App\Http\Controllers\Api;

use Illuminate\Validation\ValidationException;
use App\Repositories\AulaRepository;
use App\Http\Controllers\Controller;
use App\Services\Aula\CreateAulaService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;


class AulaController extends Controller
{
    use JsonResponseTrait;
    
    public function store(Request $request,CreateAulaService $createAulaService)
    {
        try{
            return $this->jsonResponseSuccess($createAulaService->create($request),201);
        }
        catch(ValidationException $e){
            return $this->jsonResponseError($e->errors(),422);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }

    public function index(Request $request,AulaRepository $aulaRepository)
    {
        try{
            return $this->jsonResponseSuccess($aulaRepository->paginateAulas($request),200);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }

    public function show($aula,AulaRepository $aulaRepository)
    {
        try{
            return $this->jsonResponseSuccess($aulaRepository->showAula($aula),200);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }

    public function select(Request $request,AulaRepository $aulaRepository)
    {
        try{
            return $this->jsonResponseSuccess($aulaRepository->select($request),200);
        }
        catch(\Exception $e){
            return $this->jsonResponseError($e->getMessage(),500);
        }
    }
}
