<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <form method="post" action="<?php echo ('edit') ?>">
                <div class="card">
                    <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Editar Cliente</div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="componentes_id" value="<?= $componentes['componentes_id'] ?>" required>
                            <div class="form-group col-3">
                                <label for="nome">Nome *</label>
                                <input type="text" class="form-control" name="nome" value="<?= $componentes['nome'] ?>" required>
                            </div>
                            <div class="col-3">
                                <label>Valor</label>
                                <input type="text" class="form-control dinheiro" name="valor" id="valor_produto" value="<?= $componentes['valor'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer small text-muted">
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
