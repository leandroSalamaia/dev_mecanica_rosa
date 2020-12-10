<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Gerenciar Histórico do veiculo</h1>

            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Filtro</div>
                <div class="col-12">
                    <div class="row">
                        <div class="form-group col-5">
                            <label>Cliente*</label>
                            <select class="form-control select2" name="cliente"></select>
                        </div>
                        <div class="form-group col-5">
                            <label>Veiculos(MODELO / MARCA - PLACA)</label>
                            <select class="form-control" name="carro" id="carros" disabled></select>
                        </div>
                        <div class="form-group col-12">
                            <button class="btn btn-success pull-right" id="gerar_historico">Gerar Histórico</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer small text-muted"></div>
            </div>

            <div class="table-responsive tabela">

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
