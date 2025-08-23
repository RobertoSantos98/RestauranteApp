<?php

namespace App\Services;

use App\Repositories\CarrinhoRepository;

class CarrinhoService
{
    protected $carrinhoRepository;

    public function __construct(CarrinhoRepository $repository)
    {
        $this->carrinhoRepository = $repository;
    }

    public function getCarrinhoUsuario($id)
    {
        $carrinho = $this->carrinhoRepository->findById($id);

        if(!$carrinho){
            $carrinho = $this->carrinhoRepository->createForUser($id);
        }

        return $carrinho;
    }
}
