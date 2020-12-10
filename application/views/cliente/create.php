<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

            <div class="card">
                <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Cadastrar Cliente</div>
                <div class="card-body">
                    <form method="post" action="<?php echo ('create') ?>">

                        <!-- ///////////////////////////////////////
                        //////// INICIO BLOCO DO CLIENTE
                        ////////////////////////////////////// -->
                        <div class="card" style="margin-top:28px;">
                            <h5 class="card-header">Cliente</h5>
                            <div class="card-body">
                                <div class="row endereco">
                                    <div class="col-12">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#fisica"><span class="fisico">Fisico</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#juridica"><span class="juridico">Juridico</span></a>
                                            </li>
                                        </ul>
                                        <div class="tab-content clearfix" style="margin-top: 20px;">
                                            <div id="fisica" class="tab-pane active">
                                                <div class="row">
                                                    <div class="form-group col-3">
                                                        <label>Nome Do Cliente *</label>
                                                        <input type="text" class="form-control obrigatorioF" id="nome" name="nome" required>
                                                    </div>
                                                    <div class="form-group col-3">
                                                        <label>CPF</label>
                                                        <input type="text" class="form-control obrigatorioF cpf" id="cpf" name="cpf" required>
                                                    </div>
                                                    <div class="col-3">
                                                        <label>Telefone</label>
                                                        <input type="text" class="form-control telefone" id="telefone" name="telefone">
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="juridica" class="tab-pane">
                                                <div class="row">
                                                    <div class="form-group col-3">
                                                        <label>Nome Fantasia *</label>
                                                        <input type="text" class="form-control obrigatorioJ" id="nome_fantasia" name="nome_fantasia">
                                                    </div>
                                                    <div class="form-group col-3">
                                                        <label>CNPJ</label>
                                                        <input type="text" class="form-control obrigatorioJ cnpj" id="cnpj" name="cnpj">
                                                    </div>
                                                    <div class="col-3">
                                                        <label>Telefone</label>
                                                        <input type="text" class="form-control telefone" id="telefone" name="telefone">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ///////////////////////////////////////
                        //////// FIM BLOCO DO CLIENTE
                        ////////////////////////////////////// -->

                        <!-- ///////////////////////////////////////
                        //////// INICIO BLOCO DE ENDEREÇO
                        ////////////////////////////////////// -->
                        <div class="card" style="margin-top:28px;">
                            <h5 class="card-header">Endereço</h5>
                            <div class="card-body">
                                <div class="row endereco">
                                    <div class="form-group col-3">
                                        <label for="rua">CEP *</label>
                                        <input type="text" class="form-control cep" id="cep" name="cep">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="rua">Rua *</label>
                                        <input type="text" class="form-control" id="rua" name="rua" required>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="rua">Número *</label>
                                        <input type="text" class="form-control" id="numero" name="numero" required>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="rua">Bairro *</label>
                                        <input type="text" class="form-control" id="bairro" name="bairro" required>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="rua">Cidade *</label>
                                        <input type="text" class="form-control" id="cidade" name="cidade" required>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="rua">Complemento *</label>
                                        <input type="text" class="form-control" id="complemento" name="complemento">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ///////////////////////////////////////
                        //////// FIM BLOCO DE ENDEREÇO
                        ////////////////////////////////////// -->

                        <!-- ///////////////////////////////////////
                        //////// INICIO DO BLOCO DE CARRO
                        ////////////////////////////////////// -->
                        <div class="card mt-3">
                            <h5 class="card-header">Carros</h5>
                            <div class="card-body">
                                <div class="bloco-carro">
                                    <div class="row row-carro">
                                        <div class="col-3">
                                            <label>Modelo/Marca</label>
                                            <select class="form-control select2-container modelo-marca" id="modelo-marca" name="modelo_marca[]">
                                                <?php foreach ($modelo_marca as $key => $value) { ?>
                                                    <option class="form-control" value="<?php echo $value['modelo_id'] ?>"><?php echo $value['marca_modelo'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <label>Ano</label>
                                            <input type=text class="form-control ano" id="ano" name="ano[]">
                                        </div>
                                        <div class="col-3">
                                            <label>Tipo de Combustivel</label>
                                            <select class="form-control" id="combustivel" name="combustivel[]">
                                                <option class="form-control" value="1">Gasolina</option>
                                                <option class="form-control" value="2">Alcool</option>
                                                <option class="form-control" value="3">Flex</option>
                                                <option class="form-control" value="4">Diesel</option>
                                                <option class="form-control" value="5">GNV</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label>Placa</label>
                                            <input type="text" class="form-control" id="placa" name="placa[]">
                                        </div>
                                        <div class="col-1 row-btn">
                                            <button type="button" class="btn btn-primary btn-add-carro" style="margin-top:28px;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ///////////////////////////////////////
                        //////// FIM DO BLOCO DE CARRO
                        ////////////////////////////////////// -->
                </div>
                <div class="card-footer small text-muted">
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
</div>
