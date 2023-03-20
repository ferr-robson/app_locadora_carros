<template>
    <div>
        <!-- .table -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" v-for="t, key in titulos" :key="key">{{t.titulo}}</th>
                    <th v-if="visualizar.visivel || atualizar || remover.visivel"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="obj, chave in dadosFiltrados" :key="chave">
                    <td v-for="valor, chaveValor in obj" :key="chaveValor">
                        <span v-if="titulos[chaveValor].tipo == 'texto'">
                            {{valor}}
                        </span>

                        <span v-if="titulos[chaveValor].tipo == 'data'">
                            {{valor}}
                        </span>

                        <span v-if="titulos[chaveValor].tipo == 'imagem'">
                            <img :src="'/storage/'+valor" width="30" height="30">
                        </span>
                    </td>
                    <td v-if="visualizar.visivel || atualizar || remover.visivel">
                        <button v-if="visualizar.visivel" class="btn btn-outline-primary btn-sm" :data-bs-toggle="visualizar.dataBSToggle" :data-bs-target="visualizar.dataBSTarget" @click="setStore(obj)">Visualizar</button>

                        <button v-if="atualizar" class="btn btn-outline-primary btn-sm">Atualizar</button>

                        <button v-if="remover.visivel" class="btn btn-outline-danger btn-sm" :data-bs-toggle="remover.dataBSToggle" :data-bs-target="remover.dataBSTarget" @click="setStore(obj)">Remover</button>
                    </td>
                </tr>
            </tbody>
        </table><!-- /.table -->
    </div>
</template>

<script>
    export default {
        props: ['dados', 'titulos', 'visualizar', 'atualizar', 'remover'],
        methods: {
            setStore(obj){
                this.$store.state.item = obj;
            }
        },
        computed: {
            dadosFiltrados() {
                // Retorna um array com as chaves do array titulos
                let campos = Object.keys(this.titulos);

                let dadosFiltrados = [];

                this.dados.map((item, chave) => {
                    
                    let itemFiltrado = {};
                    campos.forEach(campo => {
                        itemFiltrado[campo] = item[campo]; // Usando a sintax de array para atribuir valor a um obj
                    })

                    dadosFiltrados.push(itemFiltrado);
                })

                return dadosFiltrados;
            }
        }
    }
</script>
