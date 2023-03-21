<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credenciais = $request->all(['email', 'password']);
        
        // autenticacao (email e senha)
        // auth(<config\auth.php valor do vetor guards>)
        $token = auth('api')->attempt($credenciais);
        if($token){
            // retornar o token de autorisacao
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['erro' => 'Usuário ou senha inválido!'], 403);
        }
    }

    public function logout() {
        auth('api')->logout();
        return response()->json(['msg' => 'O logout foi realizado com sucesso!']);
    }

    public function refresh() {
        $token = auth('api')->refresh();
        return response()->json(['token' => $token]);
    }

    public function me() {
        // Retorna os dados do usuario autenticado, de acordo com os dados do token
        return response()->json(auth()->user());
    }
}
?>