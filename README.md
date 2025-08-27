
# RestauranteApp

API backend desenvolvida em **Laravel**, projeto de exemplo para gerenciamento de carrinho de compras com autenticação via Laravel Sanctum.
FrontEnd Feito em ReactNative: https://github.com/RobertoSantos98/DesafioGlobalTecnologies

##  Visão Geral

- Usuários podem gerenciar um **carrinho de compras**, adicionar produtos, atualizar quantidades e visualizar o total.
- A API utiliza **Laravel Sanctum** para autenticação via token **Bearer**.
- Implementação pura Laravel (sem Repositories ou Services), utilizando **Controllers limpos e Models com lógica adequada**.
- Domínio "User" criado junto a filosofia de clean arquitecture, separando Repository, Service (Regras de negócio) e Controller.

---

##  Requisitos

- PHP >= 8.3
- Laravel 12
- MySQL (ou outro banco SQL configurável via `.env`)
- Composer
- Laragon (ou XAMPP, WAMP, etc.)
- Postman (para testes API)

-Utilizei o Laragon para iniciar todos os Servers. 

---

##  Configuração Inicial

```bash
git clone https://github.com/RobertoSantos98/RestauranteApp.git
cd RestauranteApp

composer install
cp .env.example .env

# Configure as variáveis no .env (database, APP_URL, etc.)
php artisan key:generate

php artisan migrate
````

---

## Autenticação com Sanctum

1. No `.env`, defina:

   ```env
   SANCTUM_STATEFUL_DOMAINS=localhost
   SESSION_DRIVER=cookie
   ```

2. No `User.php`, inclua:

   ```php
   use Laravel\Sanctum\HasApiTokens;

   class User extends Authenticatable
   {
       use HasApiTokens, HasFactory, Notifiable;
       // ...
   }
   ```

3. Rotas protegidas (`routes/api.php`):

   ```php
   Route::middleware('auth:sanctum')->group(function () {
       Route::get('/carrinho', [CarrinhoController::class, 'show']);
       Route::post('/carrinho/item', [ItemProdutoController::class, 'store']);
       Route::put('/carrinho/item/{id}', [ItemProdutoController::class, 'update']);
       Route::delete('/carrinho/item/{id}', [ItemProdutoController::class, 'destroy']);
   });
   ```

4. Fluxo de token via Postman:

   * **Login**:

     ```json
     POST /api/auth
     {
       "email": "...",
       "password": "..."
     }
     ```

     Retorna um `token` (Bearer).
   * Use esse token no header `Authorization: Bearer <token>` para acessar os endpoints acima.

---

## Endpoints da API

* `GET /api/carrinho`
  Retorna os dados do carrinho do usuário autenticado (itens + valor\_total).

* `POST /api/carrinho/item`
  Adiciona ou atualiza um item no carrinho:

  ```json
  {
    "produto_id": 2,
    "quantidade": 3
  }
  ```

* `PUT /api/carrinho/item/{id}`
  Atualiza a quantidade do item existente:

  ```json
  {
    "quantidade": 5
  }
  ```

* `DELETE /api/carrinho/item/{id}`
  Remove o item do carrinho.

---

## Model Carrinho com lógica de valor total

No `Carrinho.php`:

```php
public function getValorTotalAttribute()
{
    return $this->itens->sum(fn($item) => $item->produto->preco * $item->quantidade);
}
```

Valor calculado dinamicamente, sem precisar armazenar no banco.

---

## Testes com Postman

1. Faça login e obtenha o token.
2. Use o token para chamar `GET /api/carrinho`: deve retornar o carrinho vazio ou criado automaticamente.
3. Teste os endpoints `/carrinho/item` para adicionar, atualizar ou remover itens.
4. Verifique se o campo `valor_total` está correto.

5. Se for preciso, adicionar -> "Accept":"application/json" no headers em qualquer post para API.

---

## Futuras Melhorias

* Adotar **Repositories e Services** para maior organização. (como feito para o Dominio User)
* Implementar **cache** nos endpoints de listagem.
* Adicionar **validação adicional** (ex.: estoque de produtos).

---

## Licença

Projeto de aprendizado — livre para uso e adaptação.
