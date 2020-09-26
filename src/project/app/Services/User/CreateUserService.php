<?php

namespace App\Services\User;

use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Services\StorageService;
use App\Models\User as Model;
use Exception;

class CreateUserService
{
    private $model;
    private $repo;

    public function __construct(
        Model $model,
        UserRepository $repo
    )
    {
        $this->model = $model;
        $this->repo = $repo;
    }

    public function create(Object $request)
    {
        try{
            $this->validate($request);
            return new UserResource($this->model->create([
                'nome'              => $request->nome        ?? '',
                'sobrenome'         => $request->sobrenome   ?? '',
                'cpfcnpj'           => ($request->cpfcnpj)   ? preg_replace("/\D+/", "", $request->cpfcnpj) : '',
                'imagem'            => ($request->hasFile('imagem'))    ? StorageService::create("users/imagem",$request->imagem)       : '',
                'email'             => $request->email       ?? '',
                'password'          => $request->password    ? Hash::make($request->password) : '',
            ]));
        }catch(Exception $e){
            throw $e;
        }
    }

    private function validate(Object $request){
        if($request->hasFile('imagem')){
            Validator::make($request->all(),[
                'nome'          => 'required|max:30',
                'sobrenome'     => 'required|max:100',
                'password'      => 'required|max:100|min:6|confirmed',
                'cpfcnpj'       => 'required|min:11|max:14|cpf_cnpj|unique:users,cpfcnpj',
                'email'         => 'required|max:191|email|unique:users',
                'imagem'        => 'file|image|mimetypes:image/jpeg,image/png,image/jpg|max:2048'
            ],[
                'nome.required'                 => 'O nome é obrigatório.',
                'nome.max'                      => 'O nome excedeu 30 caracteres.',
                'sobrenome.required'            => 'O sobrenome é obrigatório',
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
                'password.required'             => 'A senha é obrigatória.',
                'password.min'                  => 'Minimo de 6 caracteres para senha.',
                'password.confirmed'            => 'A senha não combina com a confirmação.',
                'password.max'                  => 'A senha excedeu 100 caracteres.',
            ])->validate();
        }
        Validator::make($request->all(),[
            'nome'          => 'required|max:30',
            'sobrenome'     => 'required|max:100',
            'password'      => 'required|max:100|min:6|confirmed',
            'cpfcnpj'       => 'required|min:11|max:14|cpf_cnpj|unique:users,cpfcnpj',
            'email'         => 'required|max:191|email|unique:users',
        ],[
            'nome.required'                 => 'O nome é obrigatório.',
            'nome.max'                      => 'O nome excedeu 30 caracteres.',
            'sobrenome.required'            => 'O sobrenome é obrigatório.',
            'sobrenome.max'                 => 'O sobrenome excedeu 100 caracteres.',
            'email.required'                => 'O email é obrigatório.',
            'email.max'                     => 'O email excedeu 191 caracteres.',
            'email.email'                   => 'O email é inválido.',
            'email.unique'                  => 'O email é inválido.',
            'cpfcnpj.required'              => 'O cpf ou cpnj é obrigatório.',
            'cpfcnpj.max'                   => 'O cpf ou cpnj excedeu 14 caracteres.',
            'cpfcnpj.min'                   => 'O cpf ou cpnj são no mínimo 11 caracteres.',
            'cpfcnpj.cpf_cnpj'              => 'O cpf ou cpnj inválido.',
            'cpfcnpj.unique'                => 'O cpf ou cpnj inválido.',
            'password.required'             => 'A senha é obrigatória.',
            'password.min'                  => 'Minimo de 6 caracteres para senha.',
            'password.confirmed'            => 'A senha não combina com a confirmação.',
            'password.max'                  => 'A senha excedeu 100 caracteres.',
        ])->validate();
    }
}