<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        try {
            $user = $this->userService->getAllUsers($request);
            return response()->json($user, 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => 'Um erro ocorreu ao tentar buscar Usuário.'], 500);
        }
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        try {
            $user = $this->userService->createUser($data);
            return response()->json($user, 201);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => 'Um erro ocorreu ao tentar criar Usuário.',
                'message' => $ex->getMessage(),
                'trace' => $ex->getTrace()
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $user = $this->userService->getUserById($id);
            return response()->json($user, 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => 'Um erro ocorreu ao tentar buscar Usuário.'], 500);
        }
    }

    public function update(StoreUpdateUserRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $user = $this->userService->updateUser($id, $data);
            return response()->json($user, 200);
        } catch (\Exception $ex) {
            return response()->json(['error' => 'Um erro ocorreu ao tentar atualizar Usuário.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $this->userService->deleteUser($id);
            return response()->json([
                'message' => 'Usuário deletado com sucesso!'
            ], 200);
        } catch (\Exception $ex) {

            return response()->json([
                'message' => 'Falha ao Deletar Usuário!'
            ], 400);
        }
    }
}
