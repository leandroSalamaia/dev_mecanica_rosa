<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Gerenciar os Clientes</h1>

            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Clientes</div>
                <div class="card-body"><a href="<?php echo site_url('/cliente/create') ?>" class="btn btn-success btn-lg">Adicionar Cliente</a></canvas></div>
                <div class="card-footer small text-muted"></div>
            </div>

            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-table mr-1"></i>Tabela de Clientes</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nome Cliente</th>
                                    <th>CPF/CNPJ</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cliente as $clientes) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $clientes['id'] ?></th>
                                        <td><?php echo $clientes['nome'] ?></td>
                                        <td><?php echo $clientes['cpf_cnpj'] ?></td>
                                        <td>
                                            <a href="<?php echo ('cliente/edit/' . $clientes['id']) ?>">
                                                <span class="fa fa-edit"> </span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        </canvas>
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
        $('#dataTable').DataTable({
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
