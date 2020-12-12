<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Financeiro</h1>
            <div class="mt-4">
                <button class="btn btn-success btn-lg entrada">Adicionar Entrada</button>
                <button class="btn btn-danger btn-lg saida">Adicionar Saida</button>
            </div>

            <!-- Inicio do Grafico -->
            <div class="card mb-4 mt-4">
                <div class="card-header"><i class="fas fa-chart mr-1"></i>Gráfico do Entradas/Saidas do Mês</div>
                <div class="card-body">
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="30"></canvas></div>
                </div>
                <div class="card-footer small text-muted"></div>
            </div>
            <!-- fim do grafico -->

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-entradas-pendentes" role="tab" aria-controls="nav-home" aria-selected="true">Entradas Pendentes</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-saidas-pendentes" role="tab" aria-controls="nav-profile" aria-selected="false">Saidas Pendentes</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-entradas-pagas" role="tab" aria-controls="nav-profile" aria-selected="false">Entradas Pagas</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-saidas-pagas" role="tab" aria-controls="nav-profile" aria-selected="false">Saidas Pendentes</a>
                </div>
            </nav>
            <div class="card" style="margin-top:28px;">
                <h5 class="card-header">Filtros</h5>
                <div class="card-body">
                    <form method="post" action="<?php echo ('') ?>">
                        <div class="row">
                            <div class="form-group col-3">
                                <label>Data de Inicio</label>
                                <input type="date" class="form-control" id="data_inicio" name="data_de">
                            </div>
                            <div class="form-group col-3">
                                <label>Data Final</label>
                                <input type="date" class="form-control" id="data_final" name="data_ate">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary pull-right btn-filtrar">Filtrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="table-responsive tab-pane fade show active" id="nav-entradas-pendentes" role="tabpanel" aria-labelledby="nav-home-tab">
                    <br>
                    <table id="dataTable" class="table table-striped table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Cliente</th>
                                <th>Data do Vencimento</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($entradas_pendentes as $value) { ?>
                                <tr>
                                    <th scope="row"><?php echo $value['fluxo_entrada_id'] ?></th>
                                    <td><?php echo $value['cliente'] ?></td>
                                    <td><?php echo date_format(date_create($value['data_vencimento']), "d/m/Y") ?></td>
                                    <td></td>
                                    <td>R$ <?php echo $value['valor'] ?></td>
                                    <td>
                                        <a href="<?php echo ('financeiro/AlteraStatusEntrada/1/' . $value['fluxo_entrada_id']) ?>" class="btn btn-success">
                                            <span class="fas fa-dollar-sign"> </span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive tab-pane fade" id="nav-saidas-pendentes" role="tabpanel" aria-labelledby="nav-home-tab">
                    <br>
                    <table id="dataTable" class="table table-striped table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Data do Vencimento</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($saidas_pendentes as $value) { ?>
                                <tr>
                                    <th scope="row"><?php echo $value['fluxo_saida_id'] ?></th>
                                    <td><?php echo date_format(date_create($value['data_vencimento']), "d/m/Y") ?></td>
                                    <td></td>
                                    <td>R$ <?php echo $value['valor'] ?></td>
                                    <td>
                                        <a href="<?php echo ('financeiro/AlteraStatusSaida/1/' . $value['fluxo_saida_id']) ?>" class="btn btn-success">
                                            <span class="fas fa-dollar-sign"> </span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive tab-pane fade" id="nav-entradas-pagas" role="tabpanel" aria-labelledby="nav-home-tab">
                    <br>
                    <table id="dataTable" class="table table-striped table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Data de Pagamento</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($entradas_pagas as $value) { ?>
                                <tr>
                                    <th scope="row"><?php echo $value['fluxo_entrada_id'] ?></th>
                                    <td><?php echo date_format(date_create($value['data_pagamento']), "d/m/Y") ?></td>
                                    <td></td>
                                    <td>R$ <?php echo $value['valor'] ?></td>
                                    <td>
                                        <a href="<?php echo ('financeiro/AlteraStatusEntrada/0/' . $value['fluxo_entrada_id']) ?>" class="btn btn-danger">
                                            <span class="fas fa-dollar-sign"> </span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive tab-pane fade" id="nav-saidas-pagas" role="tabpanel" aria-labelledby="nav-home-tab">
                    <br>
                    <table id="dataTable" class="table table-striped table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Data de Pagamento</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($saida_pagas as $value) { ?>
                                <tr>
                                    <th scope="row"><?php echo $value['fluxo_saida_id'] ?></th>
                                    <td><?php echo date_format(date_create($value['data_pagamento']), "d/m/Y") ?></td>
                                    <td></td>
                                    <td>R$ <?php echo $value['valor'] ?></td>
                                    <td>
                                        <a href="<?php echo ('financeiro/AlteraStatusSaida/0/' . $value['fluxo_saida_id']) ?>" class="btn btn-danger">
                                            <span class="fas fa-dollar-sign"> </span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</div>

<script>
    ////////////////////////////////
    //////////////// 
    ////////////////    DATATABLES
    ////////////////
    ////////////////////////////////
    $(document).ready(function() {
        $('.dataTable').DataTable({
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                },
                "select": {
                    "rows": {
                        "_": "Selecionado %d linhas",
                        "0": "Nenhuma linha selecionada",
                        "1": "Selecionado 1 linha"
                    }
                }
            },
            theme: 'bootstrap4'

        });
    });
</SCRIPT>
