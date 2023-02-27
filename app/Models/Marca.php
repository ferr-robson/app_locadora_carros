<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'imagem'];

    public function rules(){
        return [
            // Estou desconsiderando o id da marca atual, pois, no update, o nome pode nao ser alterado e acabar causando erros
            'nome' => 'required|unique:marcas,nome,'. $this->id .'|min:3',
            'imagem' => 'required',
        ];
    }
    /*
     * Parametros do unique:
     * 1) tabela
     * 2) nome da coluna
     * 3) id do registro que sera desconsiderado na pesquisa
     */

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'O nome da marca já existe no banco',
            'nome.min' => 'O nome deve ter no mínimo 3 caracteres',
        ];
    }
}
