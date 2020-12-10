<script>
    Mask()

    function Mask() {
        $('#cpf').mask('000.000.000-00', {
            reverse: true
        });
        $('#cnpj').mask('00.000.000/0000-00', {
            reverse: true
        });
        $('#cep').mask('00000-000');
        $('#telefone').mask('(00) 9 0000-0000');
        $('.ano').mask('0000');
    }

    $(document).on('click', '.btn-add-telefone', function() {
        var clone = $(".row-telefone:first").clone();
        $(clone).find("input:text").val("").end();
        $(clone).find("button").remove();
        $(clone).find('.row-btn').append('<button type="button" class="btn btn-danger btn-remove-telefone" style="margin-top:28px;"><i class="fa fa-times" aria-hidden="true"></i></button>');
        $(clone).appendTo(".bloco-telefone");
        Mask();
    });

    $(document).on('click', '.btn-remove-telefone', function() {
        $(this).parent().parent().remove();
    });

    $(document).on('click', '.btn-add-email', function() {
        var clone = $(".row-email:first").clone();
        $(clone).find("input:text").val("").end();
        $(clone).find("button").remove();
        $(clone).find('.row-btn').append('<button type="button" class="btn btn-danger btn-remove-email" style="margin-top:28px;"><i class="fa fa-times" aria-hidden="true"></i></button>');
        $(clone).appendTo(".bloco-email");
        $('#telefone').mask('(00) 9 0000-0000');
    });

    $(document).on('click', '.btn-remove-email', function() {
        $(this).parent().parent().remove();
    });

    $(document).on('click', '.btn-add-carro', function() {
        $(".modelo-marca").select2('destroy');

        var clone = $(".row-carro:first").clone();
        $(clone).find("input:text").val("").end();
        $(clone).find("button").remove();
        $(clone).find('.row-btn').append('<button type="button" class="btn btn-danger btn-remove-carro" style="margin-top:28px;"><i class="fa fa-times" aria-hidden="true"></i></button>');
        $(clone).appendTo(".bloco-carro");
        $('#telefone').mask('(00) 9 0000-0000');

        $(".select2-container").select2({
            theme: 'bootstrap4',
            placeholder: '...Selecione',
            minimumInputLength: 3,
            allowClear: true
        });
    });

    $(document).on('click', '.btn-remove-carro', function() {
        $(this).parent().parent().remove();
    });

    $(document).on('click', '.juridico', function() {
        $('.obrigatorioF').removeAttr('required');
        $('.obrigatorioJ').attr('required', 'required')
    });

    $(document).on('click', '.fisico', function() {
        $('.obrigatorioJ').removeAttr('required');
        $('.obrigatorioF').attr('required', 'required')
    });




    ///////////////////////////////////////////
    ////////////////////
    //////////////////// BUSCA CEP
    ////////////////////
    ///////////////////////////////////////////
    $(document).ready(function() {
        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#ibge").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {
            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');
            //Verifica se campo cep possui valor informado.
            if (cep != "") {
                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#uf").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });

        // $(".select2-container").select2();

        $(".select2-container").select2({
            theme: 'bootstrap4',
            placeholder: '...Selecione',
            minimumInputLength: 3,
            allowClear: true
        });

    });

    function dinamicSelect() {
        $(':input[name=modelo_marca]').select2({
            theme: 'bootstrap4',
            placeholder: '...Selecione',
            minimumInputLength: 3
        });
    }
</script>
