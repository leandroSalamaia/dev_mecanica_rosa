<script>
    $(".select2").select2({
        minimumInputLength: 3,
        minimumResultsForSearch: 10,
        theme: 'bootstrap4',
        ajax: {
            url: "<?php echo site_url('/orcamento/ajaxGetClientes') ?>",
            method: 'POST',
            dataType: "json",
            data: function(params) {
                var queryParameters = {
                    term: params.term
                }
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.nome + ' / ' + item.cpf_cnpj,
                            id: item.cliente_id,
                            nome: item.nome,
                            cpf_cnpj: item.cpf_cnpj,
                            telefone: item.telefone
                        }
                    })
                };
            },
        },
        templateSelection: function(data) {
            $('#nome').val(data.nome);
            $('#cpf').val(data.cpf_cnpj);
            $('#telefone').val(data.telefone);
            $.ajax({
                url: "<?php echo site_url('/orcamento/ajaxGetCarrosCliente') ?>",
                method: 'POST',
                dataType: 'json',
                data: {
                    id: data.id
                },
                success: function(respose) {
                    if (respose) {
                        $('#carros').html('');
                        $('#carros').removeAttr('disabled');
                        $.each(respose, function(index, value) {
                            $('#carros').append(`
                                <option value="${value.cliente_carro_id}"> ${value.modelo} / ${value.marca} - ${value.placa}</option>
                            `);
                        });
                    }
                }
            })
            return data.text;
        }
    });

    $(document).on('click', '#gerar_historico', function() {
        $.ajax({
            url: "<?php echo site_url('/historico_veiculo/ajaxGetHistorico') ?>",
            method: 'POST',
            dataType: 'json',
            data: {
                id: $('#carros').val()
            },
            success: function(respose) {
                if (respose) {
                    $('.tabela').html('');
                    // console.log(respose)
                    $.each(respose.orcamentos_validos, function(i, orcamento) {
                        var componentesArray = [];
                        var ServicosArray = [];
                        $.each(respose.componentes, function(j, componentes) {
                            if (j == orcamento.orcamento_id) {
                                $.each(componentes, function(f, valor) {
                                    componentesArray.push('<tr><td>' + valor.nome + '</td></tr>')
                                });
                            }
                        });
                        $.each(respose.servicos, function(j, servicos) {
                            if (j == orcamento.orcamento_id) {
                                $.each(servicos, function(f, valor) {
                                    ServicosArray.push('<tr><td>' + valor.nome + '</td></tr>')
                                });

                            }
                        });
                        console.log(componentesArray)
                        var data = new Date(orcamento.data_criacao);
                        var data_formatada = Intl.DateTimeFormat('pt-BR').format(data)
                        $('.tabela').append(`
                            <div class="card mb-4">
                                <div class="card-header"><i class="fas fa-table mr-1"></i>${data_formatada}</div>
                                    <div class="card-body ${orcamento.orcamento_id}">
                                    <table id="dataTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Descrição</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                ${componentesArray}
                                                ${ServicosArray}
                                        </tbody>
                                    </table>
                                    </div>
                                <div class="card-footer small text-muted"></div>
                            </div>
                        `);

                    });
                }
            }
        })
    });
</script>
