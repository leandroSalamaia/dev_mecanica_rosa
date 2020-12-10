<div id="layoutSidenav_content" class="mt-3">
    <main>
        <form method="post" action="<?php echo ('create') ?>">
            <div class="container-fluid">
                <div class="card  mt-2">
                    <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Orçamento</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Cliente*</label>
                                <select class="form-control select2" name="cliente" required></select>
                            </div>
                            <div class="form-group col-6">
                                <label>Veiculos(MODELO / MARCA - PLACA)</label>
                                <select class="form-control" name="carro" id="carros" required></select>
                            </div>
                        </div>
                        <!-- <div class="row row-cliente">
                            <div class="col-3">
                                <label>Nome</label>
                                <input type="text" class="form-control" id="nome" disabled>
                            </div>
                            <div class="col-2">
                                <label>CPF</label>
                                <input type="text" class="form-control" id="cpf" disabled>
                            </div>
                            <div class="col-2">
                                <label>Telefone</label>
                                <input type="text" class="form-control" id="telefone" disabled>
                            </div>
                        </div> -->
                        <hr>
                        <div class="row">
                            <div class="col-3">
                                <label>Produto</label>
                                <select class="form-control nome_produto"></select>
                                <input type="hidden" id="nome_produto">
                            </div>
                            <div class="col-3">
                                <label>Valor</label>
                                <input type="text" class="form-control dinheiro" id="valor_produto">
                            </div>
                            <div class="col-2 float-right">
                                <button type="button" class="btn btn-info btn-add-produto" style="margin-top:30px;">Adicionar Produto</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <label>Serviço</label>
                                <select class="form-control nome_servico"></select>
                                <input type="hidden" id="nome_servico">
                            </div>
                            <div class="col-3">
                                <label>Valor</label>
                                <input type="text" class="form-control dinheiro" id="valor_servico">
                            </div>
                            <div class="col-2 float-right">
                                <button type="button" class="btn btn-danger btn-add-servico" style="margin-top:30px;">Adicionar Serviço</button>
                            </div>
                        </div>
                        <div class="box">
                            <div class="card box-servico mt-2">
                                <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Descrição</div>
                                <div class="card-body">
                                    <div class="col-12 bloco-descricao">
                                        <div class="row">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Código</th>
                                                        <th scope="col">Nome</th>
                                                        <th scope="col">Valor</th>
                                                        <th scope="col">Opções</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tabela_descricao">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="form-group col-3 float-right">
                                                <label>Total *</label>
                                                <input type="text" class="form-control dinheiro" name="valor_total" id="valor_total" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer small text-muted">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row float-right">
                            <button type="submit" class="btn btn-success float-right">Salvar</button>
                        </div>
                    </div>
                </div>
        </form>
    </main>
</div>
