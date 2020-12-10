<style>
    a {
        margin-right: 10px;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Gerenciar os Orçamentos</h1>

            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Orçamentos</div>
                <div class="card-body"><a href="<?php echo site_url('/orcamento/create') ?>" class="btn btn-success btn-lg">Adicionar Orçamento</a></canvas></div>
                <div class="card-footer small text-muted"></div>
            </div>

            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-table mr-1"></i>Tabela de Orçamentos</div>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-pendentes" role="tab" aria-controls="nav-home" aria-selected="true">Pendentes</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-finalizados" role="tab" aria-controls="nav-profile" aria-selected="false">Finalizados</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="table-responsive tab-pane fade show active" id="nav-pendentes" role="tabpanel" aria-labelledby="nav-home-tab">
                            <br>
                            <table id="dataTable" class="table table-striped table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Cliente</th>
                                        <th>Veiculo</th>
                                        <th>Data do Orçamento</th>
                                        <th>Valor</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orcamento as $orcamentos) { ?>
                                        <?php if ($orcamentos['status_execucao'] == 0) : ?>
                                            <tr>
                                                <th scope="row"><?php echo $orcamentos['orcamento_id'] ?></th>
                                                <td><?php echo $orcamentos['cliente'] ?></td>
                                                <td><?php echo $orcamentos['carro'] ?></td>
                                                <td><?php echo date_format(date_create($orcamentos['data_criacao']), "d/m/Y") ?></td>
                                                <td>R$ <?php echo $orcamentos['total'] ?></td>
                                                <td>
                                                    <a href="<?php echo ('orcamento/edit/' . $orcamentos['orcamento_id']) ?>">
                                                        <span class="fa fa-edit"> </span>
                                                    </a>
                                                    <a href="<?php echo ('orcamento/imprimirOrcamento/' . $orcamentos['orcamento_id']) ?>">
                                                        <span class="fa fa-print mr-1"> </span>
                                                    </a>
                                                    <a href="<?php echo ('orcamento/alterarStatusOrcamento/' . $orcamentos['orcamento_id']) . '/1' ?>">
                                                        <span class="fa fa-clipboard-check mr-1"> </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive tab-pane fade" id="nav-finalizados" role="tabpanel" aria-labelledby="nav-home-tab">
                            <br>
                            <table id="dataTable" class="table table-striped table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Cliente</th>
                                        <th>Veiculo</th>
                                        <th>Data do Orçamento</th>
                                        <th>Valor</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orcamento as $orcamentos) { ?>
                                        <?php if ($orcamentos['status_execucao'] == 1) : ?>
                                            <tr>
                                                <th scope="row"><?php echo $orcamentos['orcamento_id'] ?></th>
                                                <td><?php echo $orcamentos['cliente'] ?></td>
                                                <td><?php echo $orcamentos['carro'] ?></td>
                                                <td><?php echo date_format(date_create($orcamentos['data_criacao']), "d/m/Y") ?></td>
                                                <td>R$ <?php echo $orcamentos['total'] ?></td>
                                                <td>
                                                    <a href="<?php echo ('orcamento/edit/' . $orcamentos['orcamento_id']) ?>">
                                                        <span class="fa fa-edit"> </span>
                                                    </a>
                                                    <a href="<?php echo ('orcamento/imprimirOrcamento/' . $orcamentos['orcamento_id']) ?>">
                                                        <span class="fa fa-print mr-1"> </span>
                                                    </a>
                                                    <a href="<?php echo ('orcamento/alterarStatusOrcamento/' . $orcamentos['orcamento_id']) . '/0' ?>">
                                                        <span class="fa fa-clipboard-check mr-1"> </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer small text-muted"></div>
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
