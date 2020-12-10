<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Cadastrar Praga</div>
                    <div class="card-body">
                            <form method="post" action="<?php echo('create') ?>">
                                <div class="row">
                                    <div class="form-group col-3">
                                        <label for="nome">Nome Da Praga *</label>
                                        <input type="text" class="form-control" name="nome" required>
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
