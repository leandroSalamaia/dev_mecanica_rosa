<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Cadastrar Produto</div>
                <div class="card-body">
                    <form method="post" action="<?php echo ('create') ?>">
                        <div class="row">
                            <div class="form-group col-3">
                                <label>Nome*</label>
                                <input type="text" class="form-control" name="nome" required>
                            </div>
                            <div class="col-3">
                                <label>Valor</label>
                                <input type="text" class="form-control dinheiro" name="valor" id="valor_produto">
                            </div>
                        </div>
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
