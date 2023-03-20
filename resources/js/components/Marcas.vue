<template>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Card de filtros de busca -->
                <card-component titulo="Busca de marcas">
                    <template v-slot:conteudo>
                        <!-- .row -->
                        <div class="row">
                            <!-- .col -->
                            <div class="col mb-3">
                                <!-- input-container-component -->
                                <input-container-component id="inputId" titulo="ID" texto-ajuda="Opcional. Informe o ID do registro" id-help="idHelp">
                                    <input type="number" class="form-control" id="inputID" aria-describedby="idHelp" placeholder="ID" v-model="busca.id">
                                </input-container-component>
                                <!-- /input-container-component -->
                            </div>
                            <!-- /.col -->
                            
                            <!-- .col -->
                            <div class="col mb-3">
                                <!-- input-container-component -->
                                <input-container-component id="inputNome" titulo="Nome" texto-ajuda="Opcional. Informe o Nome da marca" id-help="nomeHelp">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome" v-model="busca.nome">
                                </input-container-component>
                                <!-- /input-container-component -->
                            </div>
                            <!-- /.col -->
                        </div> 
                        <!-- /.row -->
                    </template>
                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm float-end" @click="pesquisar()">Pesquisar</button>
                    </template>
                </card-component> 
                <!-- / Card de filtro de busca -->

                <!-- Card de listagem de marcas -->
                <card-component titulo="Relação de marcas">
                    <template v-slot:conteudo>
                        <!--<table-component :dados="marcas" :titulos="['id', 'nome', 'imagem']"></table-component>-->
                        <table-component 
                            :dados="marcas.data"
                            :visualizar="{ visivel: true, dataBSToggle: 'modal', dataBSTarget: '#modalVisualizar' }"
                            :atualizar="true"
                            :remover="{ visivel: true, dataBSToggle: 'modal', dataBSTarget: '#modalRemover' }"
                            :titulos="{
                                id: {titulo: 'ID', tipo: 'texto'},
                                nome: {titulo: 'Nome', tipo: 'texto'},
                                imagem: {titulo: 'Imagem', tipo: 'imagem'},
                                created_at: {titulo: 'Data de criação', tipo: 'data'}
                            }">
                        </table-component>
                    </template>
                    <template v-slot:rodape>
                        <div class="row">
                            <div class="col-10">
                                <paginate-component>
                                    <li v-for="l, key in marcas.links" :key="key" 
                                        :class="l.active ? 'page-item active' : 'page-item'" 
                                        @click="paginacao(l)"
                                    >
                                        <a class="page-link" v-html="l.label"></a>
                                    </li>
                                </paginate-component>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalMarca">Adicionar</button>
                            </div>
                        </div>
                    </template>
                </card-component> 
                <!-- / Card de listagem de marcas -->

            </div>
        </div>

        <!-- Modal de remocao de marcas -->
        <modal-component id="modalRemover" :titulo="$store.state.item.nome">
            <template v-slot:alertas></template> 
            <template v-slot:conteudo>
                <input-container-component titulo="ID">
                    <input type="text" class="form-control" :value="$store.state.item.id" disabled>
                </input-container-component>

                <img :src="'/storage/' + $store.state.item.imagem" v-if="$store.state.item.imagem">
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger" @click="console.log('remover')">Remover</button>
            </template>
        </modal-component> 
        <!-- / Modal de remocao de marcas -->

        <!-- Modal de visualizacao de marcas -->
        <modal-component id="modalVisualizar" :titulo="$store.state.item.nome">
            <template v-slot:alertas></template> 
            <template v-slot:conteudo>
                <input-container-component titulo="ID">
                    <input type="text" class="form-control" :value="$store.state.item.id" disabled>
                </input-container-component>
                
                <input-container-component titulo="Nome">
                    <input type="text" class="form-control" :value="$store.state.item.nome" disabled>
                </input-container-component>

                <input-container-component titulo="Data de criação">
                    <input type="text" class="form-control" :value="$store.state.item.created_at" disabled>
                </input-container-component>
                
                <img :src="'/storage/' + $store.state.item.imagem" v-if="$store.state.item.imagem">
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </template>
        </modal-component> 
        <!-- / Modal de visualizacao de marcas -->

        <!-- Modal de adicao de marca -->
        <modal-component id="modalMarca" titulo="Adicionar marca">
            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Cadastro realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
                <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar cadastrar a marca" v-if="transacaoStatus == 'erro'"></alert-component>
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
        <!-- / Modal de adicao de marcas -->
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
                urlPaginacao: '',
                urlFiltro: '',
                nomeMarca: '',
                arquivoImagem: [],
                transacaoStatus: '',
                transacaoDetalhes: {},
                marcas: { data: [] }, // crio um objeto com o atributo data como sendo um array vazio. Dessa forma, nao tenho mais problemas com a funcao map em Table.vue apontando para undefined
                busca: {id: '', nome: ''}
            }
        },
        methods: {
            pesquisar() {
                let filtro = '';

                for(let chave in this.busca) {
                    if(this.busca[chave]){
                        if(filtro != ''){
                            filtro += ';';
                        }
                        filtro += chave + ':like:' + this.busca[chave];
                    }
                }
                
                if(filtro != ''){
                    this.urlPaginacao = 'page=1'; // Sempre voltar para a pag 1 ao fazer uma busca
                    this.urlFiltro = '&filtro=' + filtro;
                } else { // Se nao for passado nenhum filtro, settar this.urlFiltro com vazio e carregar a lista sem parametros de filtro
                    this.urlFiltro = '';
                }

                this.carregarLista();
            },
            paginacao(l){
                // Soh passa para a paginacao ao lado, se a URL dela for valida (l.url != null)
                if(l.url) {
                    // Nao altera mais a this.urlBase, apenas a paginacao
                    this.urlPaginacao = l.url.split('?')[1];
                    this.carregarLista(); // Recarregando a lista com base na nova URL
                }
            },
            carregarLista() {
                let config = {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                // Nao passar a this.urlBase. Esse valor deve permanecer statico, sempre
                let url = this.urlBase + '?' + this.urlPaginacao + this.urlFiltro;
                axios.get(url, config)
                    .then(response => {
                        this.marcas = response.data;
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
            carregarImagem(e) {
                this.arquivoImagem = e.target.files
            },
            salvar() {
                let formData = new FormData();
                formData.append('nome', this.nomeMarca)
                formData.append('imagem', this.arquivoImagem[0])

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        this.transacaoStatus = 'adicionado'
                        this.transacaoDetalhes = {
                            mensagem: 'ID do registro: ' + response.data.id
                        }
                    })
                    .catch(errors => {
                        this.transacaoStatus = 'erro'
                        this.transacaoDetalhes = {
                            mensagem: errors.response.data.message,
                            dados: errors.response.data.errors
                        }
                    })
            }
        },
        mounted() { // Eh chamado quando a pagina eh `montada`
            this.carregarLista();
        }
    }
</script>
