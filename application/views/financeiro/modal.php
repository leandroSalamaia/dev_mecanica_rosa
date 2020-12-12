<div class="modal" tabindex="-1" role="dialog" id="modal_entrada">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Entrada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <label>Status de Pagamento</label>
                        <select class="form-control" id="status_pagamento">
                            <option value="0">Pendente</option>
                            <option value="1">Pago</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label>Tipo de Pagamento</label>
                        <select class="form-control" id="tipo_pagamento">
                            <?php foreach ($entrada as $key => $value) { ?>
                                <option value="<?= $value['fluxo_tipo_pagamento_id'] ?>"><?= $value['nome'] ?>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <label>Data de Vencimento *</label>
                        <input type=date class="form-control" id="data_vencimento">
                    </div>
                    <div class="col-4">
                        <label>Data de Pagamento</label>
                        <input type=date class="form-control" id="data_pagamento" disabled>
                    </div>
                    <div class="col-4">
                        <label>Forma de Pagamento</label>
                        <select class="form-control" id="forma_pagamento" disabled>
                            <?php foreach ($formas_pagamento as $key => $value) { ?>
                                <option value="<?= $value['forma_pagamento_id'] ?>"><?= $value['nome'] ?>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <label>Valor *</label>
                        <input type=text class="form-control dinheiro" id="valor">
                    </div>
                    <div class="col-12">
                        <label>Cliente</label>
                        <select class="form-control" id="cliente">
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Multiplicador</label>
                        <input type=number class="form-control" id="multiplicador" min="1" value="1">
                    </div>
                    <div class="col-4">
                        <label>Marcar Todos como Pago</label>
                        <select class="form-control" id="marcar_todos_pagos">
                            <option value="false">Não</option>
                            <option value="true">Sim</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-success btn-salvar-entrada">Salvar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="modal_saida">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Saída</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <label>Status de Pagamento</label>
                        <select class="form-control" id="status_pagamento_saida">
                            <option value="0">Pendente</option>
                            <option value="1">Pago</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label>Tipo de Pagamento</label>
                        <select class="form-control" id="tipo_pagamento_saida">
                            <?php foreach ($saida as $key => $value) { ?>
                                <option value="<?= $value['fluxo_tipo_pagamento_id'] ?>"><?= $value['nome'] ?>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <label>Data de Vencimento *</label>
                        <input type=date class="form-control" id="data_vencimento_saida">
                    </div>
                    <div class="col-4">
                        <label>Data de Pagamento</label>
                        <input type=date class="form-control" id="data_pagamento_saida" disabled>
                    </div>
                    <div class="col-6">
                        <label>Valor *</label>
                        <input type=text class="form-control dinheiro" id="valor_saida">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-success btn-salvar-saida">Salvar</button>
            </div>
        </div>
    </div>
</div>
