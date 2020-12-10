<script>
    $(document).on('click', '.entrada', function() {
        $('#modal_entrada').modal('show');
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

        $.ajax({
            url: "<?php echo site_url('/financeiro/ajaxSeteEntrada') ?>",
            method: 'POST',
            dataType: 'json',
            data: {
                status_pagamento: $('#status_pagamento').val(),
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
                } else {
                    alert('Falha ao cadastrar!')
                }
            }
        })
    });
</script>
