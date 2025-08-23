<?php

namespace App\Repositories;

use App\Models\Carrinho;

class CarrinhoRepository
{
    public function findById($id){
        return Carrinho::with('itens.produto')->where('user_id', $id)->first();
    }

    public function createForUser($userId){
        return Carrinho::create(['user_id' => $userId]);
    }
}
