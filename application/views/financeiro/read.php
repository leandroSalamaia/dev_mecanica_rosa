<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Financeiro</h1>
            <div class="mt-4">
                <button class="btn btn-success btn-lg entrada">Adicionar Entrada</button>
                <button class="btn btn-danger btn-lg">Adicionar Saida</button>
            </div>

            <div class="card mb-4 mt-4">
                <div class="card-header"><i class="fas fa-table mr-1"></i></div>
                <div class="card-body">

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
