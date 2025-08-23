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
        try {
            $carrinho = $this->carrinhoService->getCarrinhoUsuario($id);
            return response()->json($carrinho);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }
    }

}
