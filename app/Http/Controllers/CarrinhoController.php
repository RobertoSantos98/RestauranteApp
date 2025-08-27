<?php

namespace App\Http\Controllers;

use App\Services\CarrinhoService;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    protected $carrinhoService;

    public function __construct(CarrinhoService $carrinhoService)
    {
        $this->carrinhoService = $carrinhoService;
    }

    public function show(Request $request)
    {
        try {
            $user = $request->user();
            $carrinho = $this->carrinhoService->getCarrinhoUsuario($user->id);
            return response()->json($carrinho);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }
    }

}
