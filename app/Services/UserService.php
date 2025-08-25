<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function getAllUsers($request)
    {

        $currentPage = $request->get('current_page') ?? 1;
        $regPerPage = 3;

        $skip = ($currentPage - 1) *$regPerPage;

        $users = $this->usuarioRepository->getAll($skip, $regPerPage);

        return $users;
    }

    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->usuarioRepository->postUser($data);
    }

    public function getUserById($id)
    {
        return $this->usuarioRepository->getById($id);
    }

    public function UpdateUser($id, $data){

        $user = $this->getUserById($id);

        if(!$user){
            throw new \Exception('Usuário não encontrado.');
        }

        return $this->usuarioRepository->UpdateUser($id, $data);
    }

    public function deleteUser($id)
    {
        $user = $this->getUserById($id);

        if (!$user) {
            throw new \Exception('Usuário não encontrado.');
        }

        return $this->usuarioRepository->deleteUser($id);
    }

}
