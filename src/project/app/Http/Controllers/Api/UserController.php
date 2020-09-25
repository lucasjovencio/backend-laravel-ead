<?php

namespace App\Http\Controllers\Api;

use Illuminate\Validation\ValidationException;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use JsonResponseTrait;
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,UserService $userService)
    {
        try{
            $this->validate($request,[
                'nome'          => 'required|max:30',
                'sobrenome'     => 'required|max:100',
                'cpfcnpj'       => 'required|min:11|max:14|cpf_cnpj|unique:users,cpfcnpj',
                'email'         => 'required|max:191|email|unique:users',
                'imagem'        => 'file|image|mimetypes:image/jpeg,image/png,image/jpg|max:2048'
            ],[
                'nome.required'                 => 'O nome é obrigatório.',
                'nome.max'                      => 'O nome excedeu 30 caracteres.',
                'sobrenome.required'            => 'A sobrenome é obrigatória.',
                'sobrenome.max'                 => 'O sobrenome excedeu 100 caracteres.',
                'email.required'                => 'O email é obrigatório.',
                'email.max'                     => 'O email excedeu 191 caracteres.',
                'email.email'                   => 'O email é inválido.',
                'email.unique'                  => 'O email é inválido.',
                'imagem.file'                   => 'A imagem é inválida.',
                'imagem.mimetypes'              => 'Apenas os tipos JPEG, JPG e PNG são válidos.',
                'imagem.max'                    => 'O tamanho máximo da imagem excedeu 2MB.',
                'cpfcnpj.required'              => 'O cpf ou cpnj é obrigatório.',
                'cpfcnpj.max'                   => 'O cpf ou cpnj excedeu 14 caracteres.',
                'cpfcnpj.min'                   => 'O cpf ou cpnj são no mínimo 11 caracteres.',
                'cpfcnpj.cpf_cnpj'              => 'O cpf ou cpnj inválido.',
                'cpfcnpj.unique'                => 'O cpf ou cpnj inválido.',
            ]);
            return $this->jsonResponseSuccess($userService->create($request),201);
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
