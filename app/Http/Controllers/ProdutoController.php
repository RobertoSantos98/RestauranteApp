<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($current_page)
    {
        $produtos = Produto::paginate(5, ['*'], 'page', $current_page);
        return response()->json($produtos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $produto = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'imagem' => 'nullable|string',
        ]);

        $produto = Produto::create($produto);
        return response()->json($produto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produto = Produto::find($id);
        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }
        return response()->json($produto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produto = Produto::find($id);
        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }
        $produto->update($request->all());
        return response()->json($produto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produto = Produto::find($id);
        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }
        $produto->delete();
        return response()->json(['message' => 'Produto removido com sucesso']);
    }
}
