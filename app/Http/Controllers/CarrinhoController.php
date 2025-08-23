<?php

namespace App\Http\Controllers;

use App\Services\CarrinhoService;


class CarrinhoController extends Controller
{
    protected $carrinhoService;

    public function __construct(CarrinhoService $carrinhoService)
    {
        $this->carrinhoService = $carrinhoService;
    }

    public function show(string $id)
    {
        $carrinho = $this->carrinhoService->getCarrinhoUsuario($id);
        return response()->json($carrinho);
    }

}
