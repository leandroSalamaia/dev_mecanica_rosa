<script>
    $(document).on('click', '.entrada', function() {
        $('#modal_entrada').modal('show');
    });

    $(document).on('click', '.saida', function() {
        $('#modal_saida').modal('show');
    });

    $(document).on('change', '#status_pagamento', function() {
        if ($(this).val() == 1) {
            $('#data_pagamento').removeAttr('disabled')
            $('#forma_pagamento').removeAttr('disabled')
        } else {
            $('#data_pagamento').attr('disabled', true)
            $('#forma_pagamento').attr('disabled', true)
        }
    });

    $(document).on('change', '#status_pagamento_saida', function() {
        if ($(this).val() == 1) {
            $('#data_pagamento_saida').removeAttr('disabled')
            $('#forma_pagamento_saida').removeAttr('disabled')
        } else {
            $('#data_pagamento_saida').attr('disabled', true)
            $('#forma_pagamento_saida').attr('disabled', true)
        }
    });

    $("#cliente").select2({
        minimumInputLength: 3,
        minimumResultsForSearch: 10,
        theme: 'bootstrap4',
        ajax: {
            url: "<?php echo site_url('/financeiro/ajaxGetClientes') ?>",
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
                            id: item.cliente_id,
                        }
                    })
                };
            },
        },
        templateSelection: function(data) {
            return data.text;
        }
    });

    $(document).on('click', '.btn-salvar-entrada', function() {
        if ($('#data_vencimento').val() == '') {
            alert('Data de Vencimento é Obrigatória!')
            return false;
        }

        if ($('#valor').val() == '') {
            alert('Valor é Obrigatório!')
            return false;
        }

        $('#pre-loader').addClass('pre-loader')
        $.ajax({
            url: "<?php echo site_url('/financeiro/ajaxSeteEntrada') ?>",
            method: 'POST',
            dataType: 'json',
            data: {
                status_pagamento: $('#status_pagamento').val(),
                tipo_pagamento: $('#tipo_pagamento').val(),
                data_vencimento: $('#data_vencimento').val(),
                data_pagamento: $('#data_pagamento').val(),
                forma_pagamento: $('#forma_pagamento').val(),
                valor: $('#valor').val(),
                cliente: $('#cliente').select2('val'),
                multiplicador: $('#multiplicador').val(),
                marcar_todos_pagos: $('#marcar_todos_pagos').val()
            },
            success: function(respose) {
                if (respose) {
                    $('#status_pagamento').val('')
                    $('#data_vencimento').val('')
                    $('#data_pagamento').val('')
                    $('#valor').val('')
                    $('#cliente').select2('val')
                    $('#multiplicador').val('')
                    alert('Cadastrado com sucesso!')
                    $('#modal_saida').modal('hide');
                } else {
                    alert('Falha ao cadastrar!')
                }
            }
        }).done(function() {
            $('#pre-loader').removeClass('pre-loader');
            $('#modal_entrada').modal('hide');
            ajax.reload()
        });
    });

    $(document).on('click', '.btn-salvar-saida', function() {
        if ($('#data_vencimento_saida').val() == '') {
            alert('Data de Vencimento é Obrigatória!')
            return false;
        }

        if ($('#valor_saida').val() == '') {
            alert('Valor é Obrigatório!')
            return false;
        }

        $('#pre-loader').addClass('pre-loader')
        $.ajax({
            url: "<?php echo site_url('/financeiro/ajaxSetSaida') ?>",
            method: 'POST',
            dataType: 'json',
            data: {
                status_pagamento: $('#status_pagamento_saida').val(),
                tipo_pagamento: $('#tipo_pagamento_saida').val(),
                data_vencimento: $('#data_vencimento_saida').val(),
                data_pagamento: $('#data_pagamento_saida').val(),
                forma_pagamento: $('#forma_pagamento_saida').val(),
                valor: $('#valor_saida').val()
            },
            success: function(respose) {
                if (respose) {
                    $('#status_pagamento_saida').val('')
                    $('#data_vencimento_saida').val('')
                    $('#data_pagamento_saida').val('')
                    $('#valor_saida').val('')
                    alert('Cadastrado com sucesso!')
                    $('#modal_saida').modal('hide');
                } else {
                    alert('Falha ao cadastrar!')
                }
            }
        }).done(function() {
            $('#pre-loader').removeClass('pre-loader');
            $('#modal_entrada').modal('hide');
            ajax.reload()
        });
    });

    // Bar Chart Example
    var ctx = document.getElementById("myBarChart");
    let valores_grafico = [];
    let label = [];
    let valores_entrada = [];
    let valores_saida = [];

    $('#pre-loader').addClass('pre-loader')
    $.ajax({
        url: "<?php echo site_url('/financeiro/ajaxGetChart') ?>",
        method: 'POST',
        dataType: 'json',
        data: {

        },
        success: function(respose) {
            if (respose) {
                valores_grafico = respose
            } else {
                alert('Falha ao cadastrar!')
            }
        }
    }).done(function() {
        $('#pre-loader').removeClass('pre-loader');
        valores_grafico.map((item) => {
            label.push(item.data_entrada);
            valores_entrada.push(item.valor_entrada);
            valores_saida.push(item.valor_saida);
        });

        console.log(label)

        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [...label],
                datasets: [{
                        // backgroundColor: "rgba(73, 228, 104, 0.33))",
                        borderColor: "rgba(73, 228, 104, 0.96)",
                        data: [...valores_entrada]
                    },
                    {
                        fillColor: "red",
                        borderColor: "rgba(228, 73, 73, 0.96)",
                        data: [...valores_saida]
                    }
                ]
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 12
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            maxTicksLimit: 12
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });

    });
</script>
