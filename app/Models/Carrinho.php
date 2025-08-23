<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function itens(){
        return $this->hasMany(ItemProduto::class);
    }

    public function getValorTotal(){
        return $this->itens->sum(function($item){
            return $item->produto->preco * $item->quantidade;
        });
    }

}
