<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemProduto extends Model
{
    protected $fillable =[
        'carrinho_id',
        'produto_id',
        'quantidade'
    ];

    public function carrinho(){
        return $this->belongsTo(Carrinho::class);
    }

    public function produto(){
        return $this->belongsTo(Produto::class);
    }

}
