<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\ItemProduto;
use Illuminate\Http\Request;

class ItemProdutoController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $carrinho = Carrinho::FirstOrCreate(['user_id' => $request->user()->id]);
            
        $item = ItemProduto::updateOrCreate(    
            [
            'user_id' => $carrinho->id,
            'produto_id' => $request->produto_id
        ],[
            'quantidade'=>$request->quantidade
        ]);

        return response()->json($item);


    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantidade'=>'required|integer|min:1'
        ]);

        $item = ItemProduto::findOrFail($id);
        $item->quantidade = $request->quantidade;
        $item->save();

        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = ItemProduto::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item removido']);
    }
}
