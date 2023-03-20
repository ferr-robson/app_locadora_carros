<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Storage;

use App\Repositories\MarcaRepository;

class MarcaController extends Controller
{
    public function __construct(Marca $marca){
        $this->marca = $marca;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $marcaRepository = new MarcaRepository($this->marca);

        if($request->has('atributos_modelos')){
            $atributos_modelos = 'modelos:id,'.$request->atributos_modelos;
            $marcaRepository->selectAtributosRegistrosRelacionados($atributos_modelos);
        } else {
            $marcaRepository->selectAtributosRegistrosRelacionados('modelos');
        }

        if($request->has('filtro')){
            $marcaRepository->filtro($request->filtro);
        }

        if($request->has('atributos')){
            $atributos = $request->atributos;
            $marcaRepository->selectAtributos($request->atributos);
        }

        return response()->json($marcaRepository->getResultadoPaginado(3), 200);
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
        $marca = $this->marca->with('modelos')->find($id);

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

        if($request->file('imagem')){
            
        }

        // Preenchendo o objeto $marca com todos os dados do request
        $marca->fill($request->all());

        if($request->file('imagem')) {
            // Remove o arquivo antigo se houver um novo
            Storage::disk('public')->delete($marca->imagem);
            
            // Pega a imagem nova e salva ela em $imagem. Em seguida salva o arquivo e gera a urn
            $imagem = $request->file('imagem');
            $imagem_urn = $imagem->store('imagem', 'public');

            // Atualiza a imagem de $marca como sendo a nova urn
            $marca->imagem = $imagem_urn;
        }

        $marca->save();

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
        
        $img = $marca->imagem;
        
        $marca->delete();

        // Remove o arquivo de logo da imagem
        // Fazendo dessa forma, depois do delete(), impede o erro de remover uma imagem sem remover o registro
        // Esse erro, normalmente, ocorre ao tentar remover uma marca que tem FK em algum modelo
        Storage::disk('public')->delete($img);
        return ['msg' => 'A marca foi removida com sucesso!'];
    }
}
