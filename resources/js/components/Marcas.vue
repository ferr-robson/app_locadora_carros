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
            <template v-slot:alertas>
                <alert-component tipo="success"></alert-component>
                <alert-component tipo="danger"></alert-component>
            </template>

            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component id="novoNome" titulo="Nome" texto-ajuda="Informe o Nome da marca" id-help="novoNomeHelp">
                        <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp" placeholder="Nome" v-model="nomeMarca">
                    </input-container-component>
                </div>

                <div class="form-group">
                    <input-container-component id="inputImagem" titulo="Imagem" texto-ajuda="Selecione uma imagem PNG" id-help="imagemHelp">
                        <input type="file" class="form-control" id="inputImagem" aria-describedby="imagemHelp" placeholder="Selecione uma imagem" @change="carregarImagem($event)">
                    </input-container-component>
                </div>
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="salvar()">Salvar</button>
            </template>
        </modal-component>
    </div>
</template>

<script>
    export default {
        computed: {
            token() {
                let token = document.cookie.split(';').find(indice => {
                    return indice.includes('token=');
                });

                token = 'Bearer ' + token.split('=')[1];

                return token;
            }
        },
        data() {
            return {
                urlBase: 'http://localhost:8000/api/v1/marca',
                nomeMarca: '',
                arquivoImagem: []
            }
        }, 
        methods: {
            carregarImagem(e) {
                this.arquivoImagem = e.target.files;
            },
            salvar(){
                //console.log(this.nomeMarca, this.arquivoImagem[0]);
                
                // Criando algo similar ao form-data do PostMan, com um objeto de FormData
                // Inserindo o nome da marca e a imagem ao form-data
                let formData = new FormData();
                formData.append('nome', this.nomeMarca);
                formData.append('imagem', this.arquivoImagem[0]);

                // Configuracao da requisicao
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                // Usando a biblioteca axios para fazer a requisicao http para o backend
                // post(<caminho>,<dados>,<configuracao da requisicao>)
                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        console.log(response);
                    })
                    .catch(errors => {
                        console.log(errors);
                    })
            }
        }
    }    
</script>
