<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

            <div class="card">
                <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Cadastrar Cliente</div>
                <div class="card-body">
                    <form method="post" action="<?php echo ('edit') ?>">

                        <!-- ///////////////////////////////////////
                        //////// INICIO BLOCO DO CLIENTE
                        ////////////////////////////////////// -->
                        <div class="card" style="margin-top:28px;">
                            <h5 class="card-header">Cliente</h5>
                            <div class="card-body">
                                <div class="row endereco">
                                    <div class="col-12">
                                        <div class="row">
                                            <?php if ($cliente['tipo_cliente'] == 1) : ?>
                                                <div class="form-group col-3">
                                                    <label>Nome Do Cliente *</label>
                                                    <input type="text" class="form-control obrigatorioF" id="nome" name="nome" required value="<?= $cliente['nome'] ?>">
                                                </div>
                                                <div class="form-group col-3">
                                                    <label>CPF</label>
                                                    <input type="text" class="form-control obrigatorioF cpf" id="cpf" name="cpf" required value="<?= $cliente['cpf'] ?>">
                                                </div>
                                            <?php else : ?>
                                                <div class="form-group col-3">
                                                    <label>Nome Fantasia *</label>
                                                    <input type="text" class="form-control obrigatorioJ" id="nome_fantasia" name="nome_fantasia" value="<?= $cliente['nome_fantasia'] ?>">
                                                </div>
                                                <div class="form-group col-3">
                                                    <label>CNPJ</label>
                                                    <input type="text" class="form-control obrigatorioJ cnpj" id="cnpj" name="cnpj" value="<?= $cliente['cnpj'] ?>">
                                                </div>
                                            <?php endif; ?>

                                            <div class="col-3">
                                                <label>Telefone</label>
                                                <input type="text" class="form-control telefone" id="telefone" name="telefone" value="<?= $cliente['telefone'] ?>">
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
                                        <input type="text" class="form-control cep" id="cep" name="cep" value="<?= $cliente['cep'] ?>">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="rua">Rua *</label>
                                        <input type="text" class="form-control" id="rua" name="rua" required value="<?= $cliente['rua'] ?>">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="rua">Número *</label>
                                        <input type="text" class="form-control" id="numero" name="numero" required value="<?= $cliente['numero'] ?>">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="rua">Bairro *</label>
                                        <input type="text" class="form-control" id="bairro" name="bairro" required value="<?= $cliente['bairro'] ?>">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="rua">Cidade *</label>
                                        <input type="text" class="form-control" id="cidade" name="cidade" required value="<?= $cliente['cidade'] ?>">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="rua">Complemento *</label>
                                        <input type="text" class="form-control" id="complemento" name="complemento" value="<?= $cliente['complemento'] ?>">
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
                                    <?php $contador = 0; ?>
                                    <?php foreach ($carros as $key => $car) : ?>
                                        <?php $contador++; ?>
                                        <div class="row row-carro">
                                            <div class="col-3">
                                                <label>Modelo/Marca</label>
                                                <select class="form-control select2-container modelo-marca" id="modelo-marca" name="modelo_marca[]">
                                                    <?php foreach ($modelo_marca as $key => $value) { ?>
                                                        <option class="form-control" value="<?php echo $value['modelo_id'] ?>" <?= $car['modelo_id'] == $value['modelo_id'] ? 'selected' : '' ?>><?php echo $value['marca_modelo'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <label>Ano</label>
                                                <input type=text class="form-control ano" id="ano" name="ano[]" value="<?php echo $car['ano'] ?>">
                                            </div>
                                            <div class="col-3">
                                                <label>Tipo de Combustivel</label>
                                                <select class="form-control" id="combustivel" name="combustivel[]">
                                                    <option class="form-control" value="1" <?= $car['combustivel_id'] == 1 ? 'selected' : '' ?>>Gasolina</option>
                                                    <option class="form-control" value="2" <?= $car['combustivel_id'] == 2 ? 'selected' : '' ?>>Alcool</option>
                                                    <option class="form-control" value="3" <?= $car['combustivel_id'] == 3 ? 'selected' : '' ?>>Flex</option>
                                                    <option class="form-control" value="4" <?= $car['combustivel_id'] == 4 ? 'selected' : '' ?>>Diesel</option>
                                                    <option class="form-control" value="5" <?= $car['combustivel_id'] == 5 ? 'selected' : '' ?>>GNV</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label>Placa</label>
                                                <input type="text" class="form-control" id="placa" name="placa[]" value="<?php echo $car['placa'] ?>">
                                            </div>
                                            <?php if ($contador == 1) : ?>
                                                <div class="col-1 row-btn">
                                                    <button type="button" class="btn btn-primary btn-add-carro" style="margin-top:28px;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                </div>
                                            <?php else : ?>
                                                <div class="col-1 row-btn">
                                                    <button type="button" class="btn btn-danger btn-remove-carro" style="margin-top:28px;"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
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
