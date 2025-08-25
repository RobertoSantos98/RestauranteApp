<?php

namespace App\Repositories;

use App\Models\User;

class UsuarioRepository
{
    public function getAll($skip, $regPerPage){
        return User::skip($skip)->take($regPerPage)->orderByDesc('id')->get();
    }

    public function postUser(array $data){
        return User::create($data);
    }

    public function getById($id){
        return User::findOrFail($id);
    }

    public function UpdateUser($data){
        $user = User::findOrFail($data['id']);
        $user->update($data);
        return $user;
    }

    public function deleteUser($id)
    {
        $user = User::destroy($id);
    }

}
