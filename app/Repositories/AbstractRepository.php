<?php

namespace App\Repositories;

// Usado para tipar o parametro do construtor
use Illuminate\Database\Eloquent\Model;

class AbstractRepository {
    public function __construct(Model $model){
        $this->model = $model;
    }

    public function selectAtributosRegistrosRelacionados($atributos){
        $this->model = $this->model->with($atributos);
    }

    public function filtro($filtros){
        $filtros = explode(';', $filtros);

        foreach ($filtros as $key => $condicao) {
            $c = explode(':', $condicao);
            $this->model = $this->model->where($c[0], $c[1], $c[2]);
        }
    }

    public function selectAtributos($atributos){
        $this->model = $this->model->selectRaw($atributos);
    }

    public function getResultado(){
        return $this->model->get();
    }

    public function getResultadoPaginado($numeroRegistrosPagina){
        return $this->model->paginate($numeroRegistrosPagina);
    }
}

?>