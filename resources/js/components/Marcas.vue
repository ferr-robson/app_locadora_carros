<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card de busca -->
                <div class="card mb-3">
                    <!-- Card header -->
                    <div class="card-header">Busca de marcas</div><!-- /Card header -->
                    
                    <!-- Card body -->
                    <div class="card-body">
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
                    </div><!-- /Card body -->

                    <!-- Card footer -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm float-end">Pesquisar</button>
                    </div><!-- /Card footer -->
                </div><!-- /Card de busca -->

                <!-- Card listagem de marcas -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">Relação de marcas</div><!-- /Card header -->
                    
                    <!-- Card body -->
                    <div class="card-body">
                        <!-- .table -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                </tr>
                                <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table><!-- /.table -->
                    </div><!-- /Card body -->

                    <!-- Card footer -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary btn-sm float-end">Adicionar</button>
                    </div><!-- /Card footer -->
                </div><!-- /Card de listagem de marcas -->
            </div>
        </div>
    </div>
</template>

<script>
    
</script>
