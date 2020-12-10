<script>
    $(document).on('click', '.btn-add-produto', function() {
        if ($('.nome_produto').select2('val') == null) {
            alert('Selecione um Produto!');
            return false;
        } else {
            $('#tabela_descricao').append(`
                <tr>
                    <th scope="row">${$('.nome_produto').select2('val')}</th>
                    <td>${$('#nome_produto').val()}</td>
                    <td>${$('#valor_produto').val()}</td>
                    <td><button type="button" class="btn btn-danger btn-remove-row-table"><i class="fa fa-times" aria-hidden="true"></i></button></td>
                    <input type="hidden" name="codigo_produto[]" value="${$('.nome_produto').select2('val')}">
                    <input type="hidden" name="valor_produto[]" class="valor_tabela" value="${$('#valor_produto').val()}">
                </tr>
            `);
        }
        calcular_total();
    });

    $(document).on('click', '.btn-add-servico', function() {
        if ($('.nome_servico').select2('val') == null) {
            alert('Selecione um Servico!');
            return false;
        } else {
            $('#tabela_descricao').append(`
                <tr>
                    <th scope="row">${$('.nome_servico').select2('val')}</th>
                    <td>${$('#nome_servico').val()}</td>
                    <td>${$('#valor_servico').val()}</td>
                    <td><button type="button" class="btn btn-danger btn-remove-row-table"><i class="fa fa-times" aria-hidden="true"></i></button></td>
                    <input type="hidden" name="codigo_servico[]" value="${$('.nome_servico').select2('val')}">
                    <input type="hidden" name="valor_servico[]" class="valor_tabela" value="${$('#valor_servico').val()}">
                </tr>
            `);
        }
        calcular_total();
    });

    $(document).on('click', '.btn-remove-row-table', function() {
        $(this).parent().parent().remove();
        calcular_total();
    });

    function calcular_total() {
        var soma = 0;
        $('.valor_tabela').each(function() {
            var valorItem = converterValorMonetario($(this).val());

            if (!isNaN(valorItem))
                soma += parseFloat(valorItem);
        });

        console.log(new Intl.NumberFormat('pt-BR', {
            style: 'decimal',
            currency: 'BRL',
            minimumFractionDigits: 2,
        }).format(soma));

        $('#valor_total').val(new Intl.NumberFormat('pt-BR', {
            style: 'decimal',
            currency: 'BRL',
            minimumFractionDigits: 2,
        }).format(soma));
    }

    function converterValorMonetario(value) {
        value = value.toString();
        if (value.indexOf('.') !== -1 && value.indexOf(',') !== -1) {
            return parseFloat(value.replace(/\./gi, '').replace(/,/gi, '.'))
        } else {
            return parseFloat(value.replace(',', '.'));
        }
    }

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

    $(".nome_produto").select2({
        minimumInputLength: 3,
        minimumResultsForSearch: 10,
        theme: 'bootstrap4',
        ajax: {
            url: "<?php echo site_url('/orcamento/ajaxGetProdutos') ?>",
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
                            text: item.nome,
                            id: item.componentes_id,
                            valor: item.valor
                        }
                    })
                };
            },
        },
        templateSelection: function(data) {
            $('#valor_produto').val(data.valor);
            $('#nome_produto').val(data.text);
            return data.text;
        }
    });

    $(".nome_servico").select2({
        minimumInputLength: 3,
        minimumResultsForSearch: 10,
        theme: 'bootstrap4',
        ajax: {
            url: "<?php echo site_url('/orcamento/ajaxGetServicos') ?>",
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
                            text: item.nome,
                            id: item.servico_id,
                            valor: item.valor
                        }
                    })
                };
            },
        },
        templateSelection: function(data) {
            $('#valor_servico').val(data.valor);
            $('#nome_servico').val(data.text);
            return data.text;
        }
    });
</script>
