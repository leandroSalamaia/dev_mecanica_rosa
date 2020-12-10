<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Editar Cliente</div>
                    <div class="card-body">
                            <form method="post" action="<?php echo('edit') ?>">
                            <div class="row">
                            <div class="form-group col-3">
                                        <label for="nome">Nome Da Praga*</label>
                                        <input type="text" class="form-control" name="nome" value="<?php echo $praga[0]['nome'] ?>" required>
                                        <input type="hidden"  name="praga_id" value="<?php echo $praga[0]['praga_id'] ?>" >
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
