<template>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <card-component titulo="Busca de marcas">
                    <template v-slot:conteudo>
                        <!-- .row -->
                        <div class="row">
                            <!-- .col -->
                            <div class="col mb-3">
                                <!-- input-container-component -->
                                <input-container-component id="inputId" titulo="ID" texto-ajuda="Opcional. Informe o ID do registro" id-help="idHelp">
                                    <input type="number" class="form-control" id="inputID" aria-describedby="idHelp" placeholder="ID">
                                </input-container-component><!-- /input-container-component -->
                            </div><!-- /.col -->
                            
                            <!-- .col -->
                            <div class="col mb-3">
                                <!-- input-container-component -->
                                <input-container-component id="inputNome" titulo="Nome" texto-ajuda="Opcional. Informe o Nome da marca" id-help="nomeHelp">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome">
                                </input-container-component><!-- /input-container-component -->
                            </div><!-- /.col -->
                        </div> <!-- /.row -->
                    </template>
                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm float-end">Pesquisar</button>
                    </template>
                </card-component>

                <card-component titulo="Relação de marcas">
                    <template v-slot:conteudo>
                        <table-component></table-component>
                    </template>
                    <template v-slot:rodape>
                        <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalMarca">Adicionar</button>
                    </template>
                </card-component>
            </div>
        </div>
        <modal-component id="modalMarca" titulo="Adicionar marca">
            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component id="novoNome" titulo="Nome" texto-ajuda="Informe o Nome da marca" id-help="novoNomeHelp">
                        <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp" placeholder="Nome">
                    </input-container-component>

                    <input-container-component id="inputImagem" titulo="Imagem" texto-ajuda="Selecione uma imagem PNG" id-help="imagemHelp">
                        <input type="file" class="form-control" id="inputImagem" aria-describedby="imagemHelp" placeholder="Selecione uma imagem">
                    </input-container-component>
                </div>
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </template>
        </modal-component>
    </div>
</template>

<script>
    export default {}    
</script>
