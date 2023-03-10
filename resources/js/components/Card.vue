<template>
    <div class="card mb-3">
        <!-- Card header -->
        <div class="card-header">.: {{titulo}}</div><!-- /Card header -->
        
        <!-- Card body -->
        <div class="card-body">
            <slot name="conteudo"></slot>
        </div><!-- /Card body -->

        <!-- Card footer -->
        <div class="card-footer">
            <slot name="rodape"></slot>
        </div><!-- /Card footer -->
    </div>
</template>

<script>
    export default {
        props: ['titulo']
    }
</script>
