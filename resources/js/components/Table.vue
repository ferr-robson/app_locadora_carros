<template>
    <!-- .table -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" v-for="titulo, key in titulos" :key="key" class="text-uppercase">{{titulo}}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="obj in dados" :key="obj.id">
                <template v-for="(valor, chave) in obj">
                    <td v-if="titulos.includes(chave)" :key="chave">
                        <span v-if="chave != 'imagem'">
                            {{valor}}
                        </span>
                        <span v-else>
                            <img :src="'/storage/'+valor" width="30" height="30">
                        </span>
                    </td>
                </template>
            </tr>
        </tbody>
    </table><!-- /.table -->
</template>

<script>
    export default {
        props: ['dados', 'titulos']
    }
</script>
