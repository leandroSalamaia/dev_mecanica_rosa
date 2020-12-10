<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        .cabecalho {
            width: 100%;
        }

        .logo {
            max-width: 200px;
        }

        .titulo {
            text-align: center;
        }

        .total {
            text-align: right;
        }

        .table-wrapper {
            width: 100%;
        }

        .fl-table {
            border-radius: 5px;
            font-size: 12px;
            font-weight: normal;
            border: none;
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
            white-space: nowrap;
            background-color: white;
        }

        .fl-table td,
        .fl-table th {
            text-align: center;
            padding: 8px;
        }

        .fl-table td {
            border-right: 1px solid #f8f8f8;
            font-size: 14px;
        }

        .fl-table thead th {
            background: #e6e6e6;
            font-size: 15px;
        }


        .fl-table thead th:nth-child(odd) {
            background: #e6e6e6;
        }

        .fl-table tr:nth-child(even) {
            background: #F8F8F8;
        }
    </style>

</head>

<body>
    <div class="cabecalho">
        <table class="cabecalho">
            <thead>
                <tr>
                    <th>

                    </th>
                    <th>

                    </th>
                </tr>
            </thead>
            <tbody id="tabela_descricao">
                <tr>
                    <td>
                        <img src="<?= base_url('assets/img/logo.png') ?>" class="logo">
                    </td>
                    <td>
                        <h2>Mecânica Rosa</h2>
                        <h4>Rua Visc. de Porto Alegre, 982</h4>
                        <h4>Madureira - Ponta Grossa - PR</h4>
                        <h4>(42) 3028 - 1891</h4>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="titulo">
            <h1>Orçamento</h1>
        </div>

        <table class="cabecalho">
            <thead>
                <tr>
                    <th>

                    </th>
                    <th>

                    </th>
                </tr>
            </thead>
            <tbody id="tabela_descricao">
                <tr>
                    <td>
                        <h3>Nome: <?= $orcamento['cliente'] ?></h3>
                        <h3>Carro: <?= $orcamento['carro'] ?></h3>
                    </td>
                </tr> -->
            </tbody>
        </table>
    </div>
    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Produto/Serviço</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody id="tabela_descricao">
                <?php foreach ($produtos as $produto) { ?>
                    <tr>
                        <th scope="row"><?php echo $produto['componentes_id'] ?></th>
                        <td><?php echo $produto['nome'] ?></td>
                        <td>R$ <?php echo $produto['valor'] ?></td>
                    </tr>
                <?php } ?>
                <?php foreach ($servicos as $servico) { ?>
                    <tr>
                        <th scope="row"><?php echo $servico['servico_id'] ?></th>
                        <td><?php echo $servico['nome'] ?></td>
                        <td>R$ <?php echo $servico['valor'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="total">
        <h2>Total R$: <?= $orcamento['total'] ?></h2>
    </div>

</body>

</html>
