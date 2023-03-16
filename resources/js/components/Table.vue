<template>
    <!-- .table -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" v-for="titulo, key in titulos" :key="key">{{titulo}}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="dado in dados" :key="dado.id">
                <th scope="row">{{dado.id}}</th>
                <td>{{dado.nome}}</td>
                
                <!-- recuperando as imagens -->
                <td><img :src="'/storage/'+dado.imagem" width="30" height="30"></td>
            </tr>
        </tbody>
    </table><!-- /.table -->
</template>

<script>
    export default {
        props: ['dados', 'titulos']
    }
</script>
