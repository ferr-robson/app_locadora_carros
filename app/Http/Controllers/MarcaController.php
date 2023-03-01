<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MarcaController extends Controller
{
    public function __construct(Marca $marca){
        $this->marca = $marca;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // O validate() retorna os dados para a rota imediatamente anterior ao controlador
        // Como a api nao armazena qual eh a rota, o retorno eh feito para a rota raiz do progama
        $request->validate($this->marca->rules(), $this->marca->feedback());
        // Para que isso nao gere um erro, o cliente deve informar, no cabecalho da requisicao, que ele sabe lidar com json
        // No PostMan, basta colocar no header a key Accept e o value application/json

        $marcas = $this->marca->all();
        return $marcas;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->marca->rules(), $this->marca->feedback());

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens', 'public');

        $marca = $this->marca->create([
            'nome' => $request->nome,
            'imagem' => $imagem_urn,
        ]);
        
        return response()->json($marca, 201);
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $marca = $this->marca->find($id);

        if($marca === null){
            return response()->json(['erro' => 'O recurso pesquisado nao existe.'], 404);
            // Status code HTTP 404 (not found)
        }
        return $marca;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $marca = $this->marca->find($id);

        if($marca === null){
            return response()->json(['erro' => 'O recurso pesquisado nao existe. Impossivel atualizar.'], 404);
        }

        if($request->method() === 'PATCH'){
            $regrasDinamicas = array();

            foreach($marca->rules() as $input => $regra){

                // Verifica se o campo aparece no $request
                if(array_key_exists($input, $request->all())){
                    // Se aparece no $request, cria uma posicao no array com aquele nome ($imput) e atribui a regra ao campo
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $marca->feedback());
        } else {
            $request->validate($marca->rules(), $marca->feedback());
        }

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens', 'public');

        $marca->update([
            'nome' => $request->nome,
            'imagem' => $imagem_urn,
        ]);

        return response()->json($marca, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $marca = $this->marca->find($id);

        if($marca === null){
            return response()->json(['erro' => 'O recurso pesquisado nao existe. Impossivel remover.'], 404);
        }

        $marca->delete();
        return ['msg' => 'A marca foi removida com sucesso!'];
    }
}
